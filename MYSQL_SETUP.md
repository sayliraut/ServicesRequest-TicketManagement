# MySQL Setup Guide for Service Request App

## Overview
This application requires MySQL to be running for full functionality. Follow the steps below based on your setup.

---

## ✅ Step 1: Verify MySQL Installation

### Windows (XAMPP Users)
1. Open **XAMPP Control Panel**
2. Check if MySQL is installed in your XAMPP folder

### Windows (Direct MySQL Installation)
1. Open **Services** (Press `Win + R`, type `services.msc`)
2. Look for **MySQL** or **MySQL80** (or your version)

---

## 🚀 Step 2: Start MySQL

### Option A: Using XAMPP Control Panel (Recommended)
1. Open **XAMPP Control Panel**
2. Click **Start** button next to **MySQL**
3. You should see "Running" status

### Option B: Command Line (Windows)

```powershell
# If MySQL is a Windows service, run:
net start mysql

# Or for specific version (e.g., MySQL80):
net start MySQL80

# Or find the exact service name:
Get-Service | Where-Object {$_.Name -Match 'mysql'}
```

### Option C: Direct Start (Without Service Installation)
If MySQL is not installed as a service, navigate to your MySQL bin folder and run:

```powershell
cd "C:\xampp\mysql\bin"
mysqld.exe
```

---

## ✅ Step 3: Verify Connection

Run this command in PowerShell from your project root:

```powershell
php test_db.php
```

**Expected Output:** `OK_CONN` (if successful)

**Error Output:** `ERR: [error message]`

---

## 📋 Step 4: Database Configuration

Your database settings are in `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ServicesDB
DB_USERNAME=root
DB_PASSWORD=
```

**Note:** Default XAMPP setup uses `root` user with NO password.

---

## 🏗️ Step 5: Run Migrations & Seeders

Once MySQL is running:

```bash
# Create database tables
php artisan migrate

# Seed default categories
php artisan db:seed
```

---

## 🧪 Step 6: Test the Application

Start the Laravel development server:

```bash
php artisan serve
```

Then open your browser to: **http://localhost:8000**

---

## ❌ Troubleshooting

### "Connection refused" error
- MySQL is not running → Start it using steps above
- Wrong host/port in `.env` → Check if `127.0.0.1:3306` is correct

### "Access denied for user 'root'@'localhost'"
- Check your `.env` file password matches MySQL setup
- For XAMPP, password should be empty (`DB_PASSWORD=`)

### "Database 'ServicesDB' doesn't exist"
- Run `php artisan migrate` to create tables automatically

### Port 3306 already in use
- Another MySQL instance might be running
- Change port in `.env` and MySQL config if needed

---

## 📖 Quick Reference

| Task | Command |
|------|---------|
| Start MySQL (Windows Service) | `net start mysql` |
| Stop MySQL | `net stop mysql` |
| Test Connection | `php test_db.php` |
| Run Migrations | `php artisan migrate` |
| Seed Database | `php artisan db:seed` |
| Start Dev Server | `php artisan serve` |

---

## ✨ Once Everything is Running

1. **Dashboard** - See statistics at `/dashboard`
2. **Categories** - Manage service categories
3. **Service Requests** - Create and track requests
4. **Admin Panel** - Manage requests (if you're an admin)

---

**Questions?** Check the `.env` file or contact your system administrator.
