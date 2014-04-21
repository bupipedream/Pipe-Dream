# Pipe Dream

Pipe Dream is the student-run newspaper at Binghamton University. These are the WordPress files, theme, and plugins that power the website.


## Setting up a development environment

There are a few steps to take before you can begin developing. This guide expects some basic knowledge of web servers and WordPress. Feel free to open issues on GitHub with questions.

This guide is also designed for Pipe Dream developers and expects that you already have a WordPress website on a production server.


### Required software

These are the applications needed to run the Pipe Dream website locally:

* **Apache, MySQL, PHP** - You need to run a web server on your machine. [MAMP](https://www.mamp.info/en/) makes it easy to install these on a Mac and Windows.
* **Git** - The version control system we use.


### Get started

Here's how to do set things up:


#### 1. Create a new database

WordPress needs its' own database before you can install it. We use `bupipedream` as the database name for the Pipe Dream database. It's easiest to call it the same as the production database. 

Visit `localhost:8888/phpMyAdmin/` to create a database with MAMP.


#### 2. Clone this repository

Use `git clone` to clone the repository into your web server's public folder. 

If you're using MAMP on a Mac you can clone the repositoy in `/Applications/MAMP/htdocs/` using `git clone git@github.com:bupipedream/Pipe-Dream.git /Applications/MAMP/htdocs/bupipedream`.


#### 3. Generate a WordPress config.php file

Open the website in your web browser and enter the database credentials. If you'ure using MAMP and followed the previous instruction, you would go to `localhost:8888/bupipedream/` to visit your website. 

These are the database configuration values:

* **Database Name** - The value entered in the first step.
* **User Name** - Depends on your setup but it's `root` on MAMP.
* **Password** - Depends on your setup but it's `root` on MAMP.
* **Database Host** - This will usually be `localhost`.
* **Table Prefix** - Be sure to use the same prefix as the production database. We use `pd_` at Pipe Dream.

Read the step below before filling out the next page.


#### 4. Clone the production database and image uploads

The WordPress install will ask you to set a site title, user name, and some other things. You only need to do this if you don't have an existing WordPress website. 

Otherwise, we recommend exporting your existing WordPress database and uploads and importing them into your current project. You can do that with the `wpSiteSync` script that we've provided in `lib/wpSiteSync`. 

1. Rename `lib/wpSiteSync/config-sample.sh` to `lib/wpSiteSync/config.sh`.
2. Edit the empty values. 
3. To run the script, `cd` to your site's root directory and run `sh lib/wpSiteSync/wpSiteSync.sh`. 

It's a poorly written script so I apologize in advance. You may have to make modifications if you're not on a Mac and using MAMP. Feel free to send pull requests.

This step can take a long time depending on how many photos you have.


#### 5. Update the Permalinks structure

Visit your website and click on a link. Chances are that all of your links are broken. 

Log into the WordPress admin panel and go to the "Permalinks" page. Set the custom structure to `/%category%/%post_id%/%postname%/`and the category base to `browse`. This will update the `.htaccess` file on your WordPress installation.

---

Your local WordPress install should now mirror the production server. 


## Writing code

The Pipe Dream theme lives in `wp-content/themes/bupipedream`. All modifications to the code should be made to the theme or as a plugin. Editing the "WordPress Core" will only lead to problems down the road as WordPress updates will break all changes.

Updates to WordPress and plugins should be done locally, tested, committed, then pushed to Git and deployed.


## Deploying your changes

Deploys are easy with Git and Capistrano.


### Git

Learn the basics of Git so you can pull, commit, push, and fix basic merge conflicts.


### Capistrano

We use [Capistrano](https://github.com/capistrano/capistrano) at Pipe Dream to deploy to our Linode VPS. 

The repistory uses Capistrano version 3.1 and has a few files to get you started. After installing Capistrano, you should:

1. Edit `config/deploy-sample.rb` and rename to `config/deploy.rb`.
2. Edit `config/deploy/production-sample.rb` and rename to `config/deploy/production.rb`.

To deploy the website, run `capistrano production deploy`. This command will fetch the latest changes from GitHub and put it on the server.