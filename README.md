
# ProjectForge

ProjectForge is a comprehensive project management application built with Vue.js, Vuex, and Laravel API. It provides a user-friendly interface for managing tasks, roles, and permissions, empowering administrators to efficiently organize and oversee projects.
## Screenshots
**Login**
![Screenshot 1](./../../images/login.png)

## Features

- **Task Management**: Create, assign, and track tasks effortlessly within projects.
- **Role Management**: Define various roles for users with customizable permissions.
- **Permission Control**: Grant or restrict access to specific features based on user roles.
- **User Management**: Easily manage users, assign roles, and update permissions.
- **Secure Authentication**: Utilizes Laravel's authentication system for secure user login and management.
- **RESTful API**: Built on Laravel API for seamless communication between frontend and backend.

## Technologies Used

- **Frontend**: Vue.js, Vuex, Bootstrap
- **Backend**: Laravel
- **Database**: MySQL

## Installation

1. Clone the repository:

```bash
git https://github.com/Rokaya-mk/ProjectForge.git
```

2. Navigate to the project directory:

```bash
cd ProjectForge
```

3. Install dependencies for both frontend and backend:

```bash
# Frontend
npm install

# Backend
composer install
```

4. Configure the backend environment:

   - Copy the `.env.example` file to `.env`.
   - Update the database connection details in `.env`.
   - Generate a new application key:

   ```bash
   php artisan key:generate
   ```

5. Migrate and seed the database:

```bash
php artisan migrate --seed
```

6. Serve the application:

```bash
# Frontend
npm run dev

# Backend
php artisan serve
```

7. Access the application in your browser:

```
http://localhost:8080
```
