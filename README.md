# P5 Openclassrooms - Blog - Erwan Carlini

---------------

## Starting project
------

### Requirements

- PHP : 8.1.0
- MySQL 8.0.30

### Packages Installation

First, clone project then install all composer packages with command line : ``composer install``

### Import database

To get all necessaries datas, in your PhpMyAdmin, import blogpost-db.sql in database folder from root directory.

### Configuration settings

Then, we need to set two configuration files to start the project correctly.  

#### ModelSample file in src/model

* Step 1 : Rename the file ModelSample.php into Model.php  
* Step 2 : Modify the line 16 `$this->connection = new PDO('mysql:host=localhost;dbname=dbname;charset=utf8', 'username', 'password'); ` 
You have to replace the dbname by the name of your database, the username and the password by yours to log in your phpMyAdmin.  

#### ConfigMailSample file in src/config

* Step 1 : Rename the file ConfigMailSample.php into ConfigMail.php  
* Step 2 : You will have to replace host, username and password values in the variables by your mailer host and logs in order to succeed the mail sending in the project features  

### Admin features

Then, if you want to use all features in the project, you can give yourselves the admin role by putting the value admin in the 'user' table, column 'role' on your account line.  

## Libraries use list
------

* Pecee Simple Router  
* PhpMailer  
* Symfony server to get the https required to send mails correctly  
* Composer  
* Vendor / Autoload  

<p align="center"><a href="https://symfony.com" target="_blank">
    <img src="https://symfony.com/logos/symfony_black_02.svg">
</a></p>

The [Symfony binary][1] is a must-have tool when developing Symfony applications
on your local machine. It provides:

* The best way to [create new Symfony applications][2];
* A powerful [local web server][3] to develop your projects with support for [TLS certificates][4];
* A tool to [check for security vulnerabilities][5];
* Seamless integration with [Platform.sh][6].

Installation
------------

Read the installation instructions on [symfony.com][7].

Signature Verification
----------------------

Symfony binaries are signed using [cosign][8], which is part of [sigstore][9].
Signatures can be verified as follows (OS and architecture omitted for clarity):

```console
$ COSIGN_EXPERIMENTAL=1 cosign verify-blob --signature symfony-cli.sig symfony-cli
tlog entry verified with uuid: "2b7ca2bfb7ee09114a15d60761c2a0a8c97f07cc20c02e635a92ba137a08a6de" index: 1261963
Verified OK
```

The above uses the (currently experimental) [keyless signing][10] method.
Alternatively, one can verify the signature by also providing the certificate:

```console
$ cosign verify-blob --cert symfony-cli.pem --signature symfony-cli.sig symfony-cli
Verified OK
```

Security Issues
---------------

If you discover a security vulnerability, please follow our [disclosure procedure][11].

[1]: https://symfony.com/download
[2]: https://symfony.com/doc/current/setup.html#creating-symfony-applications
[3]: https://symfony.com/doc/current/setup/symfony_server.html
[4]: https://symfony.com/doc/current/setup/symfony_server.html#enabling-tls
[5]: https://symfony.com/doc/current/setup.html#security-checker
[6]: https://symfony.com/cloud
[7]: https://symfony.com/download
[8]: https://github.com/SigStore/cosign
[9]: https://www.sigstore.dev/
[10]: https://github.com/sigstore/cosign/blob/main/KEYLESS.md
[11]: https://symfony.com/security
