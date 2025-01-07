<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Master Data Management

## Overview
The Master Data Management system allows you to manage large volumes of master data for automotive claims, including importing, exporting, filtering, and managing records related to various car brands, suppliers, and other important fields. This system enables easy management of master data in a web interface, using Laravel and integrating with Excel for import and export functionality.

## Features
- **Create, Read, Update, Delete (CRUD)**: Manage master data including car-related information such as brand, supplier, car type, model, VIN, etc.
- **Import & Export**: Import large amounts of data using Excel or CSV files, and export data in the same format.
- **Filtering**: Apply filters based on various attributes like car type, supplier, brand, and more.
- **Pagination**: Efficient pagination of large datasets to ensure smooth browsing experience.

## Technologies Used
- **Laravel**: PHP framework for building the web application.
- **Excel Integration**: Maatwebsite Excel package for data import/export functionality.
- **Eloquent ORM**: For database management and querying.
- **Blade Templates**: For front-end views with Laravel's Blade templating engine.

## Installation
Follow the steps below to set up this project on your local machine.

### Prerequisites
- PHP >= 7.3
- Composer
- Laravel >= 8.x
- MySQL or other relational database
- Node.js (for frontend assets)

### Steps
1. **Clone the repository**:
   ```bash
   git clone https://github.com/abdelrahmanusama22/master-data-management.git
## Installation

### Install dependencies:
Navigate to the project directory and run:
```bash
composer install
### Generate application key:
```bash
php artisan key:generate

