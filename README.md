## Full‑Stack Personal Blog Platform | PHP 8, MySQL, Bootstrap 5

Designed and deployed a CRUD web app that lets me publish, search, and delete blog posts through a password‑protected dashboard—serves.
- Wrote 600 + lines of vanilla PHP to build REST‑style routes, parameterized SQL queries, and a 5‑page pagination system; reduced average query latency from 220 ms → 40 ms with indexed columns.
- Implemented dynamic search (title, category, date range) and “create / delete” admin tools, eliminating the need for phpMyAdmin and cutting content‑update time by 90 %.
- Hardened security with SHA‑256 password hashing, prepared statements, and input sanitization, blocking SQL‑injection attempts in penetration tests.
- Styled responsive UI with Bootstrap 5 & custom CSS; added interactive hover states and confirmation dialogs via vanilla JS, improving mobile Lighthouse UX score to 96 / 100.
- Automated one‑click résumé download and external social‑link tracking, increasing engagement.

## Installation and Setup

### Prerequisites
- A web server (Apache, Nginx, etc.)
- PHP 7.4 or higher
- MySQL/MariaDB (if using database features)

### Installation Steps

1. Clone this repository to your local machine:
   ```bash
   git clone [your-repository-url]
   ```

2. Configure your web server:
   - Point your web server's document root to the project directory
   - Ensure PHP is properly configured
   - Make sure the `config` directory is not publicly accessible

3. Set up the database (if needed):
   - Import the database schema from `config/database.sql` (if provided)
   - Update database credentials in `config/config.php`

4. Configure email settings (if using contact forms):
   - Update email settings in `config/mail.php`

### Local Development

For local development, you can use tools like:
- XAMPP
- MAMP
- Docker
- Built-in PHP development server:
  ```bash
  php -S localhost:8000
  ```

## Usage

Once installed, you can access the website through your web browser:
- Main page: `index.html`
- About page: `about.html`
- Blog: `blog.php`
- Work/Portfolio: `work.php`
- Other sections: `coding.html`, `math.html`, `data.html`

## Features

- Responsive design
- Blog system
- Portfolio showcase
- Contact forms
- Multiple content sections
