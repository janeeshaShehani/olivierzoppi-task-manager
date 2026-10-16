# Task Management System

A web-based Task Management System built with Laravel and MySQL. The application allows users to create, view, update, delete, search, and filter tasks through a simple and responsive interface.

## Features

- **Create Tasks** — Add a task with a title, description, due date, and status.
- **View Tasks** — View task details in a popup modal.
- **Edit Tasks** — Update existing task information.
- **Delete Tasks** — Delete tasks with a confirmation prompt.
- **Search Tasks** — Search tasks by title.
- **Filter Tasks** — Filter tasks by status.
- **Pagination** — Navigate through task records and select the number of rows displayed per page.
- **Form Validation** — Validate required fields and permitted task statuses.
- **Feedback Messages** — Display feedback after successful operations.
- **Responsive Interface** — Access the task management interface on different screen sizes.

## Technologies Used

- PHP
- Laravel
- MySQL
- Blade Templates
- HTML and CSS
- JavaScript
- Vite
- Eloquent ORM

## Requirements

Install the following software before setting up the project:

- PHP version compatible with the Laravel version specified in `composer.json`
- Composer
- MySQL Server
- Node.js and npm

## Installation and Setup

### 1. Clone the Repository

```bash
git clone https://github.com/janeeshaShehani/olivierzoppi-task-manager.git
cd olivierzoppi-task-manager
```

Replace `<repository-url>` with the actual repository URL.

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Configure Environment Variables

Create your local environment file.

On Windows Command Prompt:

```bash
copy .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### 4. Create the MySQL Database

Create a database in MySQL named:

```sql
CREATE DATABASE olivierzoppi_tasks;
```

Update the database configuration in your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=olivierzoppi_tasks
DB_USERNAME=root
DB_PASSWORD=
```

Update the username and password to match your local MySQL configuration.

### 5. Run Database Migrations

```bash
php artisan migrate
```

This creates the database tables required by the application.

### 6. Install Frontend Dependencies

```bash
npm install
```

### 7. Start the Development Servers

Open two terminals in the project directory.

**Terminal 1 — Laravel server**

```bash
php artisan serve
```

**Terminal 2 — Vite development server**

```bash
npm run dev
```

Open the application in your browser:

http://127.0.0.1:8000/tasks

Keep both development servers running while using the application.

## Task Fields

Each task contains the following fields:

| Field | Description |
|---|---|
| ID | Unique task identifier |
| Title | Required task title, maximum 255 characters |
| Description | Optional task description |
| Due Date | Optional task deadline |
| Status | Pending, In Progress, or Completed |
| Created At | Date and time the task was created |
| Updated At | Date and time the task was last updated |

## Implementation Decisions

- **Laravel MVC Architecture:** Controllers handle requests and business logic, models interact with the database, and Blade templates render the interface.
- **Eloquent ORM:** Used to perform database operations through the Task model.
- **Database Migrations:** Used to define and manage the database schema.
- **Server-Side Validation:** Validates task input before storing or updating records.
- **GET Query Parameters:** Used for searching, filtering, pagination, and selecting the number of rows displayed.
- **Modal Interface:** Create, view, and edit forms are loaded into popup modals to keep the task list accessible.
- **Environment Configuration:** Database credentials are configured locally through `.env`.

## Assumptions and Limitations

- User authentication is not required for this version of the application.
- Task status is restricted to Pending, In Progress, and Completed.
- Task titles are mandatory; descriptions and due dates are optional.
- The application is intended to run locally during development unless separately deployed.

## Troubleshooting

**Database connection error**

- Ensure MySQL Server is running.
- Verify the database name and credentials in `.env`.
- Confirm that the database exists.

**Frontend assets not loading**

- Run `npm install` if dependencies are missing.
- Run `npm run dev` during local development.
- Ensure the Blade layout includes the appropriate Vite assets.

**Migration errors**

- Check the database configuration and migration files.
- Run `php artisan migrate:status` to inspect migration status.

## License

This project was developed as a task management application assignment. All rights and usage are subject to the applicable assignment requirements.
