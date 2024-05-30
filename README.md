# Courier Cost Calculator

## Description
Courier Cost Calculator is a Laravel-based application designed to help logistics and delivery service providers accurately calculate the costs of delivery jobs. It factors in various parameters like distance, number of drop-off locations, cost per mile, and the option for additional personnel. The application features a sleek user interface with real-time quote generation through AJAX calls.

## Features
- Calculate delivery costs based on multiple factors
- User-friendly interface
- Real-time quote generation with AJAX
- Validation for input data
- Extendable and maintainable code structure

## Requirements
- PHP 8.3+
- Laravel 11+
- Composer

## Installation
1. **Clone the repository:**
    ```bash
    git clone https://github.com/kundu/courier-cost-calculator.git
    cd courier-cost-calculator
    ```

2. **Install PHP dependencies:**
    ```bash
    composer install
    ```

3. **Create a copy of the .env file:**
    ```bash
    cp .env.example .env
    ```

4. **Generate an application key:**
    ```bash
    php artisan key:generate
    ```
 

5. **Start the development server:**
    ```bash
    php artisan serve
    ```

## Usage
Navigate to `http://localhost:8000` to access the Courier Cost Calculator application. Enter the required details and calculate the delivery cost.
 