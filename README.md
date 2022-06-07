# Personal Finances
A simple pwa to manage personal finances - developed using Laravel9, Inertia.js and Vue3

## How to run
Requires: PHP8, Node18, Composer

Clone the repo


Install php dependences
`composer install`

Install node dependencies 
`npm install`

Compile the assets
`npm run dev`

Enable ide helpers - You should install (Laravel Ide Helper Plugin)[https://marketplace.visualstudio.com/items?itemName=georgykurian.laravel-ide-helper&ssr=false#review-details]
`php artisan ide-helper:generate`
`php artisan ide-helper:models`
`php artisan ide-helper:eloquent`

If you use PHPStorm, consider running
`php artisan ide-helper:meta`

P.S: If there is a error, just compile the assets again

Clone the .env file and setup using your database and Redis data
