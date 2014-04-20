# Pipe Dream

Pipe Dream is the student-run newspaper at Binghamton University. These are the WordPress files, theme, and plugins that power the website.


## Setting up a development environment

These are the applications needed to run the Pipe Dream website locally.

* **Apache, MySQL, PHP** - You need to run a server on your machine. [MAMP](https://www.mamp.info/en/) (Mac/Windows) makes it easy to install these.
* **Git** - The version control system we use.

This guide will assume that you already have a website with articles on a production server.

Here's how to do set things up:

1. **Create a new table in the database** - We use `bupipedream` for the Pipe Dream database but it can be anything. It's easiest to call it the same as the production database. Visit `localhost:8888/phpMyAdmin/` to do this on MAMP.
2. **Clone the repository** - Use `git clone` to clone the repository into Apache's public folder. If you're using MAMP on a Mac, for example, you could clone the repositoy in `/Applications/MAMP/htdocs/` using `git clone git@github.com:bupipedream/Pipe-Dream.git /Applications/MAMP/htdocs/bupipedream`.
3. **Generate a WordPress config.php file** - Open the website in your web browser and enter the database credentials. If you'ure using MAMP and followed the previous instruction, you would go to `localhost:8888/bupipedream/` to visit your website. These are the database configuration values:
    * **Database Name** - The value entered in the first step.
    * **User Name** - Depends on your setup but it's `root` on MAMP.
    * **Password** - Depends on your setup but it's `root` on MAMP.
    * **Database Host** - This will usually be `localhost`.
    * **Table Prefix** - Be sure to use the same prefix as the production database. We use `pd_` at Pipe Dream.
4. **Clone the production database and image uploads**
5. **Update the Permalinks structure** - Chances are that all of your links are broken. Log into the WordPress admin panel and go to the "Permalinks" page. Set the custom structure to `/%category%/%post_id%/%postname%/`and the category base to `browse`. This will update the `.htaccess` file on your WordPress installation.