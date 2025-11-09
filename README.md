# Baby Logger API

A Laravel-based REST API for tracking baby care activities including feeding, sleeping, diaper changes, and growth metrics.

## Features

- 🍼 **Feeding Tracking**: Log feeding times, amounts, types (breast, bottle, solids)
- 😴 **Sleep Tracking**: Track sleep sessions with start/end times and quality
- 💩 **Diaper Changes**: Record wet and dirty diapers with timestamps
- 📊 **Growth Metrics**: Monitor weight, height, and head circumference over time
- 📱 **RESTful API**: Full CRUD operations for all resources
- 🔐 **API Authentication**: Secured with Laravel Sanctum

## Tech Stack

- **Framework**: Laravel 12
- **PHP**: 8.4
- **Database**: MySQL 5.7
- **Containerization**: Docker + Docker Compose
- **Deployment**: Laravel Sail (development) + Production Docker setup

## Local Development

### Prerequisites

- Docker and Docker Compose
- PHP 8.4+ (for Artisan commands outside Docker)
- Composer

### Setup

```bash
# Clone the repository
git clone https://github.com/YOUR_USERNAME/baby-logger-api.git
cd baby-logger-api

# Copy environment file
cp .env.example .env

# Install dependencies
composer install

# Start Docker containers with Sail
./vendor/bin/sail up -d

# Generate application key
./vendor/bin/sail artisan key:generate

# Run migrations
./vendor/bin/sail artisan migrate

# Seed database (optional)
./vendor/bin/sail artisan db:seed
```

The API will be available at `http://localhost`.

## API Endpoints

### Feedings

- `GET /api/feedings` - List all feedings
- `POST /api/feedings` - Create new feeding
- `GET /api/feedings/{id}` - Get specific feeding
- `PUT /api/feedings/{id}` - Update feeding
- `DELETE /api/feedings/{id}` - Delete feeding
- `GET /api/feedings/stats/today` - Get today's feeding statistics

### Sleep Sessions

- `GET /api/sleeps` - List all sleep sessions
- `POST /api/sleeps` - Create new sleep session
- `GET /api/sleeps/{id}` - Get specific sleep session
- `PUT /api/sleeps/{id}` - Update sleep session
- `DELETE /api/sleeps/{id}` - Delete sleep session
- `GET /api/sleeps/stats/today` - Get today's sleep statistics

### Diaper Changes

- `GET /api/diaper-changes` - List all diaper changes
- `POST /api/diaper-changes` - Create new diaper change
- `GET /api/diaper-changes/{id}` - Get specific diaper change
- `PUT /api/diaper-changes/{id}` - Update diaper change
- `DELETE /api/diaper-changes/{id}` - Delete diaper change
- `GET /api/diaper-changes/stats/today` - Get today's diaper change statistics

### Growth Metrics

- `GET /api/growth-metrics` - List all growth measurements
- `POST /api/growth-metrics` - Create new measurement
- `GET /api/growth-metrics/{id}` - Get specific measurement
- `PUT /api/growth-metrics/{id}` - Update measurement
- `DELETE /api/growth-metrics/{id}` - Delete measurement

## Example API Requests

### Create Feeding

```bash
curl -X POST http://localhost/api/feedings \
  -H "Content-Type: application/json" \
  -d '{
    "feeding_time": "2025-11-09T10:30:00",
    "amount_ml": 120,
    "feeding_type": "bottle_formula",
    "duration_minutes": 15,
    "notes": "Fed well"
  }'
```

### Create Sleep Session

```bash
curl -X POST http://localhost/api/sleeps \
  -H "Content-Type: application/json" \
  -d '{
    "start_time": "2025-11-09T20:00:00",
    "end_time": "2025-11-09T23:30:00",
    "sleep_quality": "good",
    "notes": "Slept soundly"
  }'
```

## Production Deployment

See [GITHUB_DEPLOYMENT.md](GITHUB_DEPLOYMENT.md) for detailed instructions on deploying to Portainer using GitHub.

### Quick Deploy

1. Push code to GitHub
2. Create stack in Portainer from GitHub repository
3. Set environment variables
4. Deploy!

## Database Schema

### feedings
- `id`: Primary key
- `feeding_time`: DateTime when feeding occurred
- `amount_ml`: Amount in milliliters (decimal)
- `feeding_type`: Type of feeding (enum)
- `duration_minutes`: How long feeding took
- `notes`: Additional notes
- `created_at`, `updated_at`: Timestamps

### sleeps
- `id`: Primary key
- `start_time`: When sleep started
- `end_time`: When sleep ended
- `duration_minutes`: Calculated duration
- `sleep_quality`: Quality rating (enum)
- `notes`: Additional notes
- `created_at`, `updated_at`: Timestamps

### diaper_changes
- `id`: Primary key
- `change_time`: When diaper was changed
- `is_wet`: Boolean flag
- `is_dirty`: Boolean flag
- `notes`: Additional notes
- `created_at`, `updated_at`: Timestamps

### growth_metrics
- `id`: Primary key
- `measurement_time`: When measurement was taken
- `weight_kg`: Weight in kilograms
- `height_cm`: Height in centimeters
- `head_circumference_cm`: Head circumference
- `notes`: Additional notes
- `created_at`, `updated_at`: Timestamps

## Testing

```bash
# Run tests
./vendor/bin/sail artisan test

# Run specific test
./vendor/bin/sail artisan test --filter=FeedingTest
```

## License

This is a personal project. All rights reserved.

## Companion Apps

- **Baby Logger App** - React Native Wear OS app for TicWatch Pro 5
