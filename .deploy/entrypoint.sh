#!/bin/sh

echo "🎬 entrypoint.sh: [$(whoami)] [PHP $(php -r 'echo phpversion();')]"
chmod 777 -R $LARAVEL_PATH/bootstrap
chmod 777 -R $LARAVEL_PATH/storage

composer dump-autoload --no-interaction --no-dev --optimize

echo "🎬 artisan commands"

# 💡 Group into a custom command e.g. php artisan app:on-deploy
php artisan migrate --no-interaction --force
# php artisan websocket:serve
echo "🎬 start supervisord"

supervisord -c $LARAVEL_PATH/.deploy/config/supervisor.conf
