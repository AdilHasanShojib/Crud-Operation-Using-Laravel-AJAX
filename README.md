# Employee Setup CRUD (Laravel + AJAX + DataTables)


## Tech Stack

- **Backend**: Laravel 
- **Frontend**: Bootstrap 5, jQuery 3.6, DataTables
- **Database**: MySQL

## Installation

1. Clone the repo:
   ```bash
   git clone https://github.com/your-username/employee-setup.git
   cd employee-setup
   ```

2. Install dependencies:
   composer install
   npm install && npm run dev
   
3. Create .env and set your DB credentials:
   cp .env.example .env
   php artisan key:generate
   
4. Run migrations:
   php artisan migrate
   
5. Serve the app:
   php artisan serve

Then ClickOn: http://127.0.0.1:8000/employees

Database Name: crud (Adding db file in the project)
