<h1 align="center" style="font-size:1.5rem;font-weight:500">
Simple User Management
</h1>
<br><br>

<p align="center">
<a href="https://laravel.com" target="_blank">
<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1969px-Laravel.svg.png" width="75" alt="Laravel Logo">
</a>&nbsp;&nbsp;&nbsp;
<a href="https://vuejs.org/" target="_blank">
<img src="https://static-00.iconduck.com/assets.00/vue-icon-512x439-f6q4zral.png" width="90" alt="Vuejs Logo">
</a>&nbsp;&nbsp;&nbsp;
<a href="https://inertiajs.com" target="_blank">
<img src="https://raw.githubusercontent.com/innocenzi/awesome-inertiajs/main/assets/logo.svg" width="80" alt="Inertiajs Logo">
</a>
</p>

## Overview

"Simple User Management" is a [Dockerized](https://www.docker.com/) Laravel application built using **[Laravel Breeze](https://github.com/laravel/breeze)** + **[Inertia.js](https://inertiajs.com)** + **[Vue.js](https://vuejs.org/)**. This project provides a foundation for implementing CRUD (Create, Read, Update, Delete) functionalities for user management, utilizing Spatie's [Laravel Permission](https://spatie.be/docs/laravel-permission/v6/introduction) package, to provide a flexible and efficient way to assign roles and permissions to users, ensuring granular control over access levels.

#### Key Features

- **User Management**: Create, edit, view, and delete users.
- **Roles and Permissions Management**: Assign roles and permissions to users for granular access control.
- **Laravel Breeze**: Utilizes Laravel Breeze for authentication and authorization, styled with [Tailwind CSS](https://tailwindcss.com/).
- **Inertia.js**: Seamlessly integrates Laravel and Vue.js for a unified development experience.
- **Vue.js**: Provides a modern and reactive frontend framework.
- **Dockerization**: Containerizes the application for easy deployment, environment isolation, and scalability.

#### Prerequisites

- **Docker Desktop**: Ensure you have [Docker Desktop](https://www.docker.com/products/docker-desktop/) installed in your system.

## Installation

#### Clone the Repository
```
git clone https://github.com/by-artemis/simple-user-management.git
```

#### Make Initial Setup
```
cp .env.example .env
```
Make sure to input necessary values to the following environment variables
```
PROJECT_NAME=simpleuser

DB_ROOT_PASSWORD=root
DB_DATABASE=simpleuser
DB_USERNAME=simpleuser
DB_PASSWORD=password

# Can be populated later
DB_CONNECTION=mysql 
DB_HOST=mysql
DB_PORT=3306
```

#### Build Docker Containers
```
cd simple-user-management
docker compose build
docker compose up -d
```

#### Install Dependencies

```
php artisan key:generate
php artisan storage:link
```
> Note: Though these commands are already ran in `Dockerfile` (php and node), you can re-run them if new libraries/packages are installed.
```
# Backend
composer install

# Frontend
npm install
```

#### Run Database Migrations and Seeders
```
docker compose exec php sh
php artisan migrate
php artisan db:seed
```

## Usage

#### Start the Development server

Dev server is already ran inside `node` container. No need to explicitly run `npm run dev`.

> Note: Please be advised that running this project on a Windows-based system may result in slower performance due to the limitations of the Windows Subsystem for Linux (WSL). If you are using Windows, I recommend to run `npm run dev` outside of the Docker container with Node.js and npm installed.

#### Access the Application
Visit http://localhost in your web browser.

## Contributing

Contributions are welcome! Please follow these guidelines:

- Fork the Repository: Fork the project on GitHub.
- Create a Branch: Create a new branch for your feature or bug fix.
- Make Changes: Implement your changes and write tests.
- Submit a Pull Request: Submit a pull request to the main branch.

## Additional Notes

- For more information on Laravel Breeze, Inertia.js, and Vue.js, please refer to their official documentation.
- Customize the project to fit your specific needs by adding more features or modifying the existing ones.