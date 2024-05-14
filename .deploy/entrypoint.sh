#!/bin/sh
echo "🎬 entrypoint.sh: [$(whoami)] [PHP $(php -r 'echo phpversion();')]"
# chmod 777 -R $LARAVEL_PATH/bootstrap
# chmod 777 -R $LARAVEL_PATH/storage

# find $LARAVEL_PATH/bootstrap -type d -exec chmod 755 {} \;
# find $LARAVEL_PATH/bootstrap -type f -exec chmod 755 {} \;

# find $LARAVEL_PATH/storage -type d -exec chmod 755 {} \;
# find $LARAVEL_PATH/storage -type f -exec chmod 755 {} \;


composer dump-autoload --no-interaction --no-dev --optimize

echo "🎬 artisan commands"

# 💡 Group into a custom command e.g. php artisan app:on-deploy
php artisan migrate --no-interaction --force
# php artisan websocket:serve
echo "🎬 start supervisord"

# 💡 Group into a custom command e.g. php artisan app:on-deploy
# php artisan migrate --no-interaction --force
php artisan storage:link
php artisan cache:clear
php artisan config:cache
php artisan config:clear
php artisan optimize
sed -i  's/abort_unless(request()->hasValidSignature(), 401);//g' ../vendor/livewire/livewire/src/Controllers/FileUploadHandler.php


supervisord -c $LARAVEL_PATH/.deploy/config/supervisor.conf
