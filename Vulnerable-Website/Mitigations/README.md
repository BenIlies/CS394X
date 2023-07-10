# Vulnerable Website Mitigations

In our setup, vulnerable website is listening on port 51130 and with a database. The mitigated files can be found in the `html` folder.
## Mitigations

### SQL Injection

To mitigate the SQL Injection vulnerability, implement input sanitization techniques. Modify the `/var/www/html/index.php` file with the following code snippet:

```php
if (preg_match('/[^a-zA-Z0-9-_-]+/', $id) || preg_match('/[^a-zA-Z0-9-_-]+/', $pw)) {
    exit("<script>alert('Input with special characters not allowed!'); location.href='/index.php';</script>");
}
```

The code snippet uses regular expressions to check if the `id` and `pw` variables contain any special characters. If special characters are found, an alert is displayed, and the user is redirected back to the `index.php` page.

### Broken Access Control

- [ ] **To be updated:** Provide mitigation techniques for Broken Access Control vulnerability.

### General Mitigation Techniques

For more information on web application security best practices and to learn about the OWASP Top 10 vulnerabilities, visit the [OWASP Top 10 website](https://owasp.org/www-project-top-ten/).