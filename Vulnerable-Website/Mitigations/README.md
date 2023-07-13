# Vulnerable Website Mitigations

In our setup, a vulnerable website is listening on port 51130 and is connected to a database. The mitigated files, which have been secured against vulnerabilities, can be found in the `html` folder.

## SQL Injection

To mitigate the SQL Injection vulnerability, implement input sanitization techniques. Modify the `/var/www/html/index.php` file with the following code snippet:

```php
if (preg_match('/[^a-zA-Z0-9-_-]+/', $id) || preg_match('/[^a-zA-Z0-9-_-]+/', $pw)) {
    exit("<script>alert('Input with special characters not allowed!'); location.href='/index.php';</script>");
}
```

The code snippet uses regular expressions to check if the `id` and `pw` variables contain any special characters. If special characters are found, an alert is displayed, and the user is redirected back to the `index.php` page.

## Broken Access Control

### Deny Access to Database Directory

To mitigate the Broken Access Control vulnerability in our setup:

Modify the `/etc/apache2/apache.conf` file and add the following configuration to deny access to the `/var/www/html/__db__/` directory:

```
<Directory /var/www/html/__db__/>
    Require all denied
</Directory>
```

This configuration ensures that users are completely denied access to the database files within the `/var/www/html/__db__/` directory.

### Implement Session Management

1. Update the `/var/www/html/index.php` file with the following code snippet to implement session management:

    ```php
    <?php
        session_start();
        // ...
        if (...) {
            $_SESSION["login_success"] = true;
        } else {
            $_SESSION["login_success"] = false;
        }
    ?>
    ```

    This code snippet initiates a session and sets the `login_success` session variable to either true or false based on the authentication result.

2. Implement authorized access enforcement in the `/var/www/html/control.php` file by adding the following code snippet:

    ```php
    <?php
        session_start();
        if ($_SESSION['login_success'] === true) {
            $open = $_POST['open'];
            if ($open === 'open') {
                system("echo create | nc 127.0.0.1 9999");
            }
        } elseif ($_SESSION['login_success'] === false) {
            exit("<script>alert('Unauthorized access!'); location.href='/index.php';</script>");
        }
    ?>
    ```

    This code snippet verifies the `login_success` session variable to ensure that only authenticated users with a successful login can execute actions such as opening the vault.

## General Mitigation Techniques

For more information on web application security best practices and to learn about the OWASP Top 10 vulnerabilities, visit the [OWASP Top 10 website](https://owasp.org/www-project-top-ten/).