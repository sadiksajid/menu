#!/bin/sh

echo "🎬 entrypoint.sh: [$(whoami)] [PHP $(php -r 'echo phpversion();')]"

composer dump-autoload --no-interaction --no-dev --optimize

echo "🎬 artisan commands"
chmod 777 -R $LARAVEL_PATH/bootstrap/cache
chmod 777 -R $LARAVEL_PATH/storage
# 💡 Group into a custom command e.g. php artisan app:on-deploy
php artisan migrate --no-interaction --force
# php artisan websocket:serve
echo "🎬 start supervisord"

supervisord -c $LARAVEL_PATH/.deploy/config/supervisor.conf
