# 🛍️ Mini Shop (Laravel + Filament)

A simple pet project e-commerce system built with Laravel and Filament admin panel.

---

## 🚀 Tech Stack

- Laravel 11+
- Filament Admin Panel
- MySQL
- File Storage (public disk)
- Tailwind (inside Filament UI)

---

## 📦 Features

### 🛒 Admin Panel
- Products CRUD
- Categories CRUD
- Tags CRUD

### 📦 Products
- Name
- Slug
- Price
- Stock
- Status (active/inactive)
- Description (rich editor)
- Main image
- Image gallery
- Category relation
- Tags (many-to-many)

### 📂 Categories
- Name

### 🏷️ Tags
- Name

---

## 🖼️ File Uploads

All images are stored in:

storage/app/public/products  
storage/app/public/products/gallery  

### Enable public access:

php artisan storage:link

---

## ⚙️ Project Setup

git clone <repo-url>  
cd shop1  

composer install  
npm install  
npm run build  

cp .env.example .env  
php artisan key:generate  

---

## 🗄️ Database Setup

DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=shop1  
DB_USERNAME=root  
DB_PASSWORD=root  

---

## 🧱 Migrations

php artisan migrate  

---

## 👤 Create Admin User

php artisan make:filament-user  

---

## 🌱 Seed Database

php artisan db:seed  

---

## 🧑‍💻 Admin Panel

http://shop1.d2.local/admin  

---

## 📁 Project Structure

app/
├── Models/
│   ├── Product
│   ├── Category
│   ├── Tag
│
├── Filament/
    ├── Resources/
        ├── Products
        ├── Categories
        ├── Tags

---

## 🧠 Key Features

- Gallery stored as JSON array
- Public disk for images
- Filament resource-based admin panel
- Two-column infolist layout
- Clean e-commerce admin UI

---

## 📜 License

MIT

