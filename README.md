# Flownate 🧭

A lightweight, collaborative project management & workflow automation tool built with Laravel
→ Think **Notion + Trello + Zapier** in one clean package.

## Vision
Small teams should have a single place to:
- Plan with rich documents (like Notion)
- Track tasks with Kanban boards (like Trello)
- Automate repetitive work (When → Then rules)

## Current Progress
| Phase | Status | Features |
|------|------|----------|
| Phase 1 – Foundation | In Progress | Auth, Teams, Projects, Boards, Tasks, Comments, Attachments |
| Phase 2 – Automation | Planned | Triggers + Actions engine |
| Phase 3 – Realtime UX | Planned | Livewire drag & drop, mentions, WebSockets |
| Phase 4 – Insights | Planned | Reports, API, multi-tenancy |

## Tech Stack
- Laravel 12 + PHP 8.3
- Livewire 3 + Alpine.js + TailwindCSS
- MySQL + Redis
- Laravel Jetstream (Teams)
- Docker-ready (coming soon)

## Local Development
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve