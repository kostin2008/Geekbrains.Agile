php artisan db:seed SeederPlant
php artisan migrate:rollback --step 1
php artisan migrate
php artisan cache:clear
