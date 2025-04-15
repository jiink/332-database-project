# CPSC 332 Database Project

## Local setup (Ubuntu)

First, set up MySQL. Then, set up the webserver.

### MySQL

Setting up MySQL was not fun. Here's what to do:

Install MySQL server (and client, I guess)

`sudo apt update`

`sudo apt install mysql-server mysql-client`

Then run this:

`sudo mysql_secure_installation`

If it asks you about password stuff, say yes.

If it asks you to remove anonymous users, disabling remote login, removing test
databases, or reloading privilege tables, say yes to all of that.

Now you should be able to enter the MySQL command line interface with this command:

`sudo mysql`

Here you can practice creating databses and querying them.

But what we want to do here is set up a username and password for the PHP code to use. Don't just copy paste this command, read it:

`CREATE USER 'cs332s3'@'localhost' IDENTIFIED BY 'THE_PASSWORD_GOES_HERE';`
`GRANT ALL PRIVILEGES ON cs332s3.* TO 'cs332s3'@'localhost';`
`FLUSH PRIVILEGES;`

This makes a a new user called "cs332s3" and sets its password to "THE_PASSWORD_GOES_HERE".

It then gives it privilges to use the database, then it refreshes things.

Replace "THE_PASSWORD_GOES_HERE" with the password of your choice. I think it needs to be >8 chars and have a number and special character.

This is the same password that will be in `config.php` for it to use to access the database.

Then you can exit the MySQL command line:

`exit;`

Finally, just for good luck, restart the MySQL server:

`sudo systemctl restart mysql`

#### Database initialization

You also need to initialize the database so there is some data to work off of.

There's a file called `initialize_db.sql` which will do that. Here's how to use it:

1. Open your terminal.
1. `cd` to this project's directory.
1. Enter the MySQL command line with `mysql -u cs332s3 -p`
1. Type the command `source initialize_db.sql;`

Then, you should see "Query OK" messages. You can check for yourself if it worked
by using `SHOW DATABASES;`, `USE cs332s3l; SHOW TABLES;`, etc.

### Webserver 

Install the stuff you need

`sudo apt update`

`sudo apt install php libapache2-mod-php php-mysql`

`sudo apt install apache2`

`sudo systemctl restart apache2`

Now, with apache running, you can go in your browser to http://localhost (http, NOT https!) and you can see apache's startup page.

Apache lets you view stuff in `/var/www/html/`, but this project is in a different directory.

Instead of copying everything to `/var/www/html/`, we can create a "symbolic link". Here's an example, adjust the command to your needs, don't just copy paste it:

`sudo ln -s ~/database/332-database-project /var/www/html/myproject`

This makes it so if you go to http://localhost/myproject, you'll see the index.html of this repo.

Now go try it out and make a query. If you run into an error, you can check the logs with this command on Ubuntu:

`sudo tail -n 50 /var/log/apache2/error.log`

