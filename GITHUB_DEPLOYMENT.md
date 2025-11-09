# GitHub + Portainer Deployment Guide - Baby Logger API

The **easiest way** to deploy your Baby Logger API to Portainer using GitHub!

## 🎯 One-Time Setup

### Step 1: Push Code to GitHub

```bash
cd /home/mhowlin/dev/baby-logger-api

# Initialize git if not already done
git init

# Add all files
git add .

# Commit
git commit -m "Initial commit - Baby Logger API"

# Add your GitHub repository as remote
git remote add origin https://github.com/YOUR_USERNAME/baby-logger-api.git

# Push to GitHub
git push -u origin main
```

### Step 2: Environment Variables Template

Update your `.env.example` with Baby Logger specific variables.

## 🚀 Deploy to Portainer

### One-Time Portainer Setup:

1. **Open Portainer**: `http://your-server:9000`

2. **Go to Stacks** → **"+ Add stack"**

3. **Choose: "Repository"**

4. **Fill in**:
   - **Name**: `baby-logger-api`
   - **Repository URL**: `https://github.com/YOUR_USERNAME/baby-logger-api`
   - **Repository reference**: `refs/heads/main`
   - **Compose path**: `docker-compose.prod.yml`

5. **Add Environment Variables**:
   ```
   APP_NAME=BabyLoggerAPI
   APP_KEY=base64:YOUR_KEY_HERE
   APP_URL=https://baby-logger.yourdomain.com
   DB_DATABASE=baby_logger
   DB_USERNAME=baby_logger
   DB_PASSWORD=your_secure_password_here
   APP_PORT=80
   ```

6. **Click**: "Deploy the stack"

### Step 3: Initialize Application (First Time Only)

SSH into your server and run:

```bash
# Generate app key (if not set)
docker exec baby-logger-api php artisan key:generate

# Run migrations
docker exec baby-logger-api php artisan migrate --force

# Cache configuration
docker exec baby-logger-api php artisan config:cache
docker exec baby-logger-api php artisan route:cache

# Set permissions
docker exec baby-logger-api chown -R www-data:www-data /var/www/html/storage
docker exec baby-logger-api chown -R www-data:www-data /var/www/html/bootstrap/cache
```

## 🔄 Updating Your Application

When you make changes:

```bash
cd /home/mhowlin/dev/baby-logger-api

# Make your changes...

# Commit and push
git add .
git commit -m "Added new feature"
git push
```

Then in **Portainer**:
1. Go to **Stacks** → **baby-logger-api**
2. Click **"Update the stack"**
3. Check **"Re-pull image and redeploy"** if you changed dependencies
4. Click **"Update"**

## 📝 API Endpoints

The Baby Logger API provides endpoints for:
- 🍼 Feeding tracking (time, amount, type)
- 😴 Sleep tracking (start/end times, duration)
- 💩 Diaper changes
- 📊 Growth metrics (weight, height, head circumference)
- 📸 Photo logging with timestamps

## 🔐 Private Repository Setup

Follow the same setup as the Jovo project for private repositories using Deploy Keys or Personal Access Tokens.

## 🎉 Summary

Deploy with ease using the GitHub + Portainer workflow!

```bash
git push  # That's it!
```

Then click "Update" in Portainer UI.
