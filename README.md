<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Description

Ini adalah website Sistem Bursa kerja khusus Di SMK Kandeman yang menarapkan metode content based filtering.
Website ini dibangun menggunakan laravel dan mysql.
terdapat dua role:
1. Admin
    - Admin memiliki hak akses penuh pada sistem ini termasuk melakukan crud jurusan, skill, mmitra, lowongan, dan manajemen user.
2. Pelamar
    - Pelamar dapat melihat dan melamar lowongan pekerjaan.

## Instalasi 
1. ```bash
    git clone https://github.com/Anammkh/projectskripsi
    cd projectskripsi
    ```
2. Selanjutnya buka terminal lagi
    ```bash
    cp .env.example .env
    ```
3. buat database kosong, dan isikan nama database nya di .env tadi dibagian DB_DATABASE
4. Buka terminal lagi,
    ```bash
    php artisan key:generate
    php artisan migrate
    php artisan db:seed --class=AdminSeeder
    ```
    ```bash
    npm run dev
    ```
5. Terminal baru
    ```bash
    php artisan storage:link
    php artisan serve
    ```
6. Buka browser lalu ketik 
    ```bash
    localhost:8000
    ```

# Penggunaan
Admin :
    Email = "admin@gmail.com"
    password = "password"



