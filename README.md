# 🎯 YokDolan App

"YokDolan" adalah solusi aplikasi web (Web App) gamifikasi yang diusulkan untuk mengatasi kesenjangan antara besarnya potensi pariwisata massal di Jawa Timur dengan pelaku ekonomi kreatif (Ekraf) lokal, khususnya UMKM. Proyek ini dikembangkan oleh tim Pemuda Sintaks dari SMK Negeri 1 Surabaya dengan tema Creative Economy and Smart Tourism.

Tujuan utama aplikasi ini adalah mengubah perilaku wisatawan dari pasif (sekadar berfoto) menjadi aktif (berinteraksi dan bertransaksi) dengan pelaku Ekraf.

## 📋 Daftar Isi

- [Stack Teknologi](#-stack-teknologi)
- [Prasyarat](#-prasyarat)
- [Instalasi](#-instalasi)
- [Konfigurasi](#-konfigurasi)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Struktur Project](#-struktur-project)
  
## 🛠️ Stack Teknologi

- **Backend:** Laravel 12
- **Frontend:** Vue 3
- **Bridge:** Inertia.js
- **Build Tool:** Vite
- **Styling:** Tailwind CSS
- **Database:** MySQL

## ✅ Prasyarat

Sebelum memulai, pastikan Anda telah menginstal:

- PHP >= 8.2
- Composer
- Node.js >= 18.x
- npm or yarn
- MySQL/MariaDB

## 🚀 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/Rafi-Andi/yokdolan-app.git
cd yokdolan-app
```

### 2. Install Dependencies

**Backend (Laravel):**
```bash
composer install
```

**Frontend (Vue + Vite):**
```bash
npm install
```

## ⚙️ Configuration

### 1. Environment Setup

Copy the example environment file and generate application key:

```bash
cp .env.example .env
php artisan key:generate
```

### 2. Database Configuration

Update your `.env` file with database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yokdolan_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 3. Run Migrations and Seeders

```bash
php artisan migrate
php artisan db:seed
```

### 4. Storage Setup

Create symbolic link for storage:

```bash
php artisan storage:link
```

### 5. Copy Asset Folders

Move asset folders from `public/` to `storage/app/public/`:

**Windows (PowerShell):**
```powershell
cp -Recurse public/channels storage/app/public/
cp -Recurse public/rewards storage/app/public/
cp -Recurse public/missions storage/app/public/
```

**Linux/Mac:**
```bash
cp -r public/channels storage/app/public/
cp -r public/rewards storage/app/public/
cp -r public/missions storage/app/public/
```

## ▶️ Running the Application

### Development Mode

This project uses a custom script that runs all necessary services:

```bash
composer run dev
```

This command will simultaneously run:
- Laravel development server
- Queue listener
- Vite dev server

### Access the Application

- **Laravel App:** [http://127.0.0.1:8000](http://127.0.0.1:8000)
- **Vite Dev Server:** [http://localhost:5173](http://localhost:5173)

## 📁 Project Structure

```
yokdolan-app/
├── app/                # Laravel application logic
├── resources/
│   ├── js/            # Vue 3 components and pages
│   └── css/           # Stylesheets
├── public/            # Public assets
├── storage/
│   └── app/public/    # User uploaded files
├── routes/            # Application routes
└── database/
    ├── migrations/    # Database migrations
    └── seeders/       # Database seeders
```

## 🎯 Quick Setup Commands

Run all setup commands in sequence:

```bash
cp .env.example .env
composer install
npm install
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
composer run dev
```

## 📝 Additional Commands

### Clear Application Cache
```bash
php artisan optimize:clear
```
### Build for Production
```bash
npm run build
```

## 👥 Authors

- **Rafi-Andi** - [GitHub Profile](https://github.com/Rafi-Andi)
- **Randi-95** - [Github Profile](https://github.com/Randi-95)
- **HablSank** - [Github Profile](https://github.com/HablSank)
- **renrennn27** - [Github Profile](https://github.com/renrennn27)
- **renrennn27** - [Github Profile](https://github.com/renrennn27)
- **SkyFredoz** - [Github Profile](https://github.com/SkyFredoz)
---

**Pemuda Sintaks || SMKN 1 SURABAYA 🚀**



