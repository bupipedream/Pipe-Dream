# config valid only for Capistrano 3.1
lock '3.1.0'

set :application, '' # enter the name of your application (bupipedream)
set :repo_url, '' # the github url (git@github.com:bupipedream/Pipe-Dream.git)

set :deploy_to, '' # path on the server that capistrano will deploy to (/var/www/bupipedream.com)
set :keep_releases, 20

# these files are not part of the repository since they will be
# different on every system. therefore, we put them in the gitignore
# and into a "shared" folder on the server. capistrano will symlink
# these linked files and folders into the correct place in the wordpress
# directory with each deploy.
set :linked_files, %w{.htaccess wp-config.php wp-content/advanced-cache.php wp-content/wp-cache-config.php wp-content/debug.log sitemap.xml sitemap.xml.gz}
set :linked_dirs, %w{wp-content/uploads wp-content/cache wp-content/backups wp-content/blogs.dir wp-content/upgrade wp-content/backup-db openx }

namespace :deploy do
end