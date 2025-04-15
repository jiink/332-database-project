# CPSC 332 Database Project

## Local setup (Ubuntu)

### Webserver 

Install the stuff you need

`sudo apt update`

`sudo apt install php libapache2-mod-php php-mysql`

`sudo apt install apache2`

`sudo systemctl restart apache2`

Now, with apache running, you can go in your browser to http://localhost (http, NOT https!) and you can see apache's startup page.

apache lets you view stuff in `/var/www/html/`

Let's make it so apache lets you try this web page out.

Instead of copying everything to `/var/www/html/`, we can create a "symbolic link". Here's an example, adjust the command to your needs, don't just copy paste it:

`sudo ln -s ~/database/332-database-project /var/www/html/myproject`

This makes it so if you go to http://localhost/myproject, you'll see the index.html of this repo.

If this is your first time setting this up, chances are that you'll run into an error when you make a query with the webpage. See the next section for how to set up MySQL for this.

### MySQL

Setting up MySQL was not fun. Here's what to do:

Install MySQL server (and client, I guess)

`sudo apt install mysql-server mysql-client`

Then run this:

`sudo mysql_secure_installation`

If it asks you about password stuff, say yes.

If it asks you to remove anonymous users, disabling remote login, removing test
databases, or reloading privilege tables, say yes to all of that.

Now you should be able to enter the MySQL command line interface with this command:

`sudo mysql`

Here you can practice creating databses and querying them.

But what we want to do here is set up a password for the PHP file to use. Don't just copy paste this command, read it:

`ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'your_new_password';`

This sets the password for the user called "root" to be "your_new_password". 

Replace "your_new_password" with the password of your choice. I think it needs to be >8 chars and have a number and special character.

This is the same password that will be in the php file for it to use to access the database.

So after you enter that password command, you should see this output:

`Query OK, 0 rows affected (0.01 sec)`

If that's the case, then you need to run this:

`FLUSH PRIVILEGES;`

Then you can exit the MySQL command line:

`exit;`

Finally, just for good luck, restart the MySQL server:

`sudo systemctl restart mysql`

Now the PHP file should be able to access the databse, assuming it has the same username and password you set with the `ALTER USER` command.

You can test it for yourself in the terminal by opening the MySQL command line, not with `sudo mysql` like before, but with `mysql -u root -p` and then entering the password you came up with.

