# Personal Finances
A simple pwa to manage personal finances - developed using Laravel9, Inertia.js and Vue3

## How to run
Requires: PHP8, Node18, Composer

1. Clone the repo


2. Install php dependences
`composer install`


3. Install node dependencies 
`npm install`


4. Compile the assets
`npm run dev`

    P.S: If there is a error, just compile the assets again

5. Enable ide helpers - You should install [Laravel Ide Helper Plugin](https://marketplace.visualstudio.com/items?itemName=georgykurian.laravel-ide-helper&ssr=false#review-details)


    `php artisan ide-helper:generate`


    `php artisan ide-helper:models`


    `php artisan ide-helper:eloquent`
    
    `php artisan ide-helper:actions`

    If you use PHPStorm, consider running
    `php artisan ide-helper:meta`
6. Link the assets
    `php artisan storage:link`

7. Clone the .env file and setup using your database and Redis data

You're all set. Run the server if you don't have Laravel Vallet instaled
`php artisan serv`
