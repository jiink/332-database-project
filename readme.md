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

### MySQL
