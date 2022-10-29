## Requirement
- PHP ^ 8.0
- MySQL ^ 8.0
- NodeJS ^ 16

## Tech Stack Yang Digunakan
- Laravel 9
- VueJS dg Inertia


## Instalasi
```sh
git clone https://github.com/daimus/vehicle-reservation
cd vehicle-reservation
composer install
npm install
php artisan migrate:fresh --seed
php artisan serve
```

## Role User

- Super Admin
    - Mengelola User
    - Mengelola Kantor
    - Mengelola Pool
- Officer
    - Menyetujui Pemesanan Kendaraan Tingkat Ke-2
- Pool Head
    - Menyetujui Pemesanan Kendaraan Tingkat Ke-1
- Pool Admin
    - Mengelola Kendaraan
    - Mengelola Pemesanan Kendaraan
    - Melihat Laporan Pemeliharaan dan Pemesanan

## Daftar User

| Email | Posisi | Password |
| ------ | ------ | ------ |
| super@mail.com | Super Admin |password|
| officer_headoffice@mail.com | Head Officer |password|
| officer_branchoffice@mail.com | Branch Officer |password|
| officer_minesite1@mail.com | Mine Site Officer |password|
| officer_minesite2@mail.com | Mine Site Officer |password|
| officer_minesite3@mail.com | Mine Site Officer |password|
| officer_minesite4@mail.com | Mine Site Officer |password|
| officer_minesite5@mail.com | Mine Site Officer |password|
| officer_minesite6@mail.com | Mine Site Officer |password|
| head_head@mail.com | Head Office Pool Head |password|
| head_branch@mail.com | Branch Office Pool Head |password|
| head_minesite1@mail.com | Mine Site Pool Head |password|
| head_minesite2@mail.com | Mine Site Pool Head |password|
| head_minesite3@mail.com | Mine Site Pool Head |password|
| head_minesite4@mail.com | Mine Site Pool Head |password|
| head_minesite5@mail.com | Mine Site Pool Head |password|
| head_minesite6@mail.com | Mine Site Pool Head |password|
| admin_head@mail.com | Head Office Pool Admin |password|
| admin_branch@mail.com | Branch Office Pool Admin |password|
| admin_minesite1@mail.com | Mine Site Pool Admin |password|
| admin_minesite2@mail.com | Mine Site Pool Admin |password|
| admin_minesite3@mail.com | Mine Site Pool Admin |password|
| admin_minesite4@mail.com | Mine Site Pool Admin |password|
| admin_minesite5@mail.com | Mine Site Pool Admin |password|
| admin_minesite6@mail.com | Mine Site Pool Admin |password|

