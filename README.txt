To Create A fresh Application
-------
composer update
php artisan migrate:fresh
php artisan module:seed Auth
php artisan module:seed AccountManagement
php artisan module:seed Lot
php artisan passport:install
php artisan key:generate
    
To Create Swagger Doc : run commond 
--------------------------
php artisan l5-swagger:generate
   
   

