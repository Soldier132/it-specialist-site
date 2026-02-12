# it-specialist-site

## Local development

### 1) Prepare environment variables
1. Copy the template:
   ```bash
   cp .env.example .env
   ```
2. Edit `.env` and set strong local passwords for:
   - `WORDPRESS_DB_PASSWORD`
   - `MYSQL_ROOT_PASSWORD`

### 2) Start services
- Start WordPress + MariaDB:
  ```bash
  docker compose up -d
  ```
- Start with phpMyAdmin as well:
  ```bash
  docker compose --profile tools up -d
  ```

### 3) Open in browser
- WordPress site: `http://localhost:8080`
- phpMyAdmin (if profile enabled): `http://localhost:8081`

Ports can be changed in `.env` via `WORDPRESS_PORT` and `PHPMYADMIN_PORT`.

### 4) Stop services
- Stop and keep data volumes:
  ```bash
  docker compose down
  ```
- Stop and remove data volumes (fresh reset):
  ```bash
  docker compose down -v
  ```
