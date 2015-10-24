set :application, "Volunteasy"
set :domain,      "hackmcr.papernweb.com"
set :deploy_to,   "/var/www/html"
set :app_path,    "app"

set :repository,  "git@github.com:QasAshraf/cuddly-duck.git"
set :scm,         :git
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`

set :model_manager, "doctrine"
# Or: `propel`

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :keep_releases,  3
set :deploy_via, :remote_cache
set :user, "root"
set :use_sudo,      true
set :use_composer, true

set :shared_files,      ["app/config/parameters.yml"]
set :shared_children,     [app_path + "/logs", web_path + "/uploads", "vendor", app_path + "/sessions"]

set :writable_dirs,       ["app/cache", "app/logs"]
set :webserver_user,      "www-data"
set :permission_method,   :chown
set :use_set_permissions, true

# Be more verbose by uncommenting the following line
logger.level = Logger::MAX_LEVEL

before "deploy:restart", "deploy:set_permissions"
after "deploy:create_symlink", "symfony:doctrine:schema:update"
