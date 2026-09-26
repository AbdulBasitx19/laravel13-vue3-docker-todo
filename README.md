# Dockerized Laravel + Vue 3 Todo Application

A fully containerized full-stack Todo application built with **Laravel 11**, **Vue 3 (Vite)**, and **MySQL**, orchestrated using **Docker Compose**. 

This repository provides a decoupled development environment where backend services and frontend build servers run in isolated Docker containers.

---

## 🛠 Tech Stack & Infrastructure

- **Backend:** Laravel 11 (PHP 8.2+ with Apache)
- **Frontend:** Vue 3, Vite, Bootstrap 5
- **Database:** MySQL 8.0
- **Database GUI:** phpMyAdmin
- **Containerization:** Docker & Docker Compose

---

## 🏗 Architecture Overview

The application runs using 4 dedicated containers:

| Container Name | Service | Access URL / Port |
| :--- | :--- | :--- |
| `vue_laravel_app` | Laravel API / Backend | `http://localhost:8000` |
| `vue_laravel_vue` | Vue 3 Dev Server (Vite) | `http://localhost:5173` |
| `vue_laravel_db` | MySQL Database | `localhost:3306` |
| `vue_laravel_phpmyadmin` | phpMyAdmin Database Manager | `http://localhost:8888` |

---

## 🚀 Quick Start Guide

### Prerequisites

Ensure you have the following installed on your machine:
- [Git](https://git-scm.com/)
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) (includes Docker Compose)

> **Note:** You do **NOT** need PHP, Node.js, or MySQL installed locally on your system. Everything runs inside Docker.

---

### Installation Steps

1. **Clone the Repository**
   ```bash
   git clone <YOUR_GITHUB_REPOSITORY_URL>
   cd <YOUR_REPOSITORY_FOLDER>
   ```

2. **Set Up Environment File**
    Copy the default .env.example file to .env inside the src directory:
    ```bash
    cp src/.env.example src/.env
    ```
3. **Verify Database Configuration**
Ensure src/.env contains the following database credentials matching the Docker stack:    
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=app_db
DB_USERNAME=app_user
DB_PASSWORD=userpassword

4. **Build and Run Docker Containers**
Start all 4 services in detached mode:
```bash
docker compose up -d --build
```
5. **Generate Application Key**
```bash
docker compose exec app php artisan key:generate
```

6. **Run Database Migrations**
```bash
docker compose exec app php artisan migrate
```

### 🌐 Application Access
Web Application: Open http://localhost:8000 in your browser.

Vite Hot-Reload Server: Runs at http://localhost:5173.

phpMyAdmin: Open http://localhost:8888 to inspect database tables.

### ⚡ Useful Docker Commands
```bash
docker compose ps
docker compose logs -f
docker compose down
docker compose down -v
```

### 📄 License
This project is open-source and available under the MIT License.

