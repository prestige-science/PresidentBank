# web-atm
A demo ATM web application made with Laravel 5.4

# Installation
1. Install composer and bower
2. cd into the project root and run 'composer update'
3. cd into the 'public_html' folder and run 'bower update'
4. cd into project root and cp '.env.example' to '.env'
5. While in project root, run 'php artisan key:generate' to generate an encryption key (automatically stored in .env)
6. Setup a MySQL database and set the credentials in .env (this is the only change required)
7. In project root, run 'php artisan migrate --seed' to create tables, a view and seed data
