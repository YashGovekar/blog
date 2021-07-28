# Blog System

## Installation

- Firstly, execute command `cp .env.example .env`
- Then, execute command `php artisan key:generate`.
- Now, put database credentials in `.env` file.
- Now execute command : `php artisan migrate:fresh --seed`
- Finally, execute command : `php artisan storage:link`

That's it. You're good to go for using the Blog.
