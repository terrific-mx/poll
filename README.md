# Terrific Poll

Terrific Poll is a Laravel application that makes it easy to create polls that can be embedded directly into emails or newsletters. Designed for simplicity and seamless integration, Terrific Poll helps you engage your audience and collect feedback.

## Features

- 📨 **Embeddable Polls:** Generate polls that work inside most email clients and newsletter platforms.
- ⚡ **Easy Poll Creation:** Intuitive interface for creating multiple-choice polls.
- 📊 **Real-Time Results:** View poll responses as they come in.

## Requirements

- A valid [Flux Pro license](https://fluxui.dev/pricing) is required to use this application.

## Getting Started

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js & npm
- A database (MySQL, PostgreSQL, SQLite, etc.)

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/terrific-mx/poll.git
   cd poll
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies:**
   ```bash
   npm install
   ```

4. **Copy and configure environment variables:**
   ```bash
   cp .env.example .env
   # Edit .env to set your database and mail settings
   ```

5. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

6. **Run migrations:**
   ```bash
   php artisan migrate
   ```

7. **Build frontend assets:**
   ```bash
   npm run build
   ```

8. **Start the development server:**
   ```bash
   php artisan serve
   ```

## Usage

- Log in and create a new poll.
- Copy the generated embed code or poll link.
- Paste it into your email or newsletter.
- Recipients can vote directly from their inbox.
- View live results in your dashboard.

## License

This project is licensed under the MIT License.
