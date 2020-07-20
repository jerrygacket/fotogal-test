Install:

    git clone https://github.com/jerrygacket/fotogal-test.git
    cd fotogal-test
    composer update
    -- make config/db_local.php with your db config
    php yii migrate
    -- setup virtual host with server_root = project_dir/web
    -- go to http://virtualhostname and you see a login form if everything is ok

demo users:

    admin 123456
    user 123456
