<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Project

Medical Appointment is a web application that is used to make an appointment with a doctor. This application is made using the Laravel framework. This application has 3 roles, namely admin, doctor, and patient. Admin can manage doctors and patients. Doctors can manage their schedules and patients. Patients can make appointments with doctors.

## Features

-   Admin can manage doctors, patients, and medicion.
-   Doctor can manage their schedules and patients.
-   Patient can make appointments with doctors.
-   Login and Register
-   CRUD Etc.

## Installation

1. Dependencies install :

    ```bash
    git clone https://github.com/deoai/Medical-Appointment-Laravel10.git

    cd ./Medical-Appointment-Laravel10

    composer install

    ```

2. Database setup

    - Create an database on phpmyadmin name
        ```bash
        bk
        ```
    - Copy content of `.env.example` into new `.env` file
        ```bash
        cp .env.example .env
        ```
    - Change those values on the `.env` file

        ```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=bk
        DB_USERNAME=root
        DB_PASSWORD=
        ```

</br></br> 3. Login to the app:

| role   | email           | password |
| ------ | --------------- | -------- |
| Admin  | admin@mail.com  | 123      |
| Doctor | iskan@mail.com  | 1234     |
| Doctor | ai@mail.com     | 1234     |
| Pasien | dhiya@mail.com  | 123      |
| Pasien | yudhis@mail.com | 123      |
