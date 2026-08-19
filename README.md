# CyberGuard

CyberGuard is a Laravel incident response platform for reporting, reviewing, and tracking cybersecurity incidents. Users can submit incidents with evidence, reviewers and admins can manage categories and status, and OpenAI is used to generate a short summary and suggest a category for each report.

## Features

- Incident reporting with title, description, and multiple evidence uploads
- AI-generated incident summaries and category suggestions
- Role-based access for `user`, `reviewer`, and `admin`
- Incident status workflow: `pending`, `under_review`, `resolved`
- Category management for incident classification
- Admin-only reviewer account creation
- Profile management and authentication via Laravel Breeze

## Tech stack

- Laravel 12
- PHP 8.2+
- OpenAI PHP Laravel SDK
- Vite
- Bootstrap / Bootstrap Icons

## Requirements

- PHP 8.2 or newer
- Composer
- Node.js and npm
- An OpenAI API key

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
```

## Environment

Add your OpenAI credentials to `.env`:

```env
OPENAI_API_KEY=your-api-key
OPENAI_ORGANIZATION=your-organization-id
```

If you are using SQLite, make sure the database file exists and the `.env` database settings point to it.

## Running the project

```bash
php artisan serve
```

## Core workflow

1. A user reports an incident and uploads evidence.
2. The app stores the incident and sends the title and description to OpenAI.
3. OpenAI returns a summary and predicted category.
4. Reviewers and admins can update the incident status and manage categories.

## Main routes

- `/` - home page
- `/incidents` - incident list
- `/incidents/create` - submit a new incident
- `/categories` - category management
- `/reviewers/create` - admin reviewer registration

## License

MIT
