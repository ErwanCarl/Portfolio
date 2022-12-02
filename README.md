# P5 Openclassrooms - Blog - Erwan Carlini

---------------

## Starting project


### Requirements

- PHP : 8.1.0
- MySQL 8.0.30
- Composer
- Symfony CLI

### Packages Installation

First, clone project then install all composer packages with command line : ``composer install``

### Import database

To get all necessaries datas, in your PhpMyAdmin, import blogpost-db.sql in database folder from root directory.

### Configuration settings

Then, we need to set two configuration files to start the project correctly.  

* #### ModelSample file in src/model

  * Step 1 : Rename the file ModelSample.php into Model.php  
  * Step 2 : Modify the line 16 `$this->connection = new PDO('mysql:host=localhost;dbname=dbname;charset=utf8', 'username', 'password'); ` > You have to replace the dbname by the name of your database, the username and the password by yours to log in your phpMyAdmin.  

* #### ConfigMailSample file in src/config

  * Step 1 : Rename the file ConfigMailSample.php into ConfigMail.php  
  * Step 2 : You will have to replace host, username and password values in the variables by your mailer host and logs in order to succeed the mail sending in the project features  

### Admin features

Then, if you want to use all features in the project, you can give yourselves the admin role by putting the value admin in the 'user' table, column 'role' on your account row.  

## Libraries use list

* Pecee Simple Router  
* PhpMailer  
* Symfony server to get the https required to send mails correctly 

