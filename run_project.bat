@echo off
title Running SIMAGANG Services...

:: Masuk ke direktori project (Opsional jika file bat ditaruh di folder project)
:: cd /d "C:\path\ke\folder\project\kamu"

echo Menjalankan Web Server...
start /b php artisan serve

echo Menjalankan Queue Worker (Export/Import)...
start /b php artisan queue:work

echo Menjalankan Scheduler (Otomasi Status)...
start /b php artisan schedule:work

echo ===========================================
echo SEMUA SERVICE BERJALAN!
echo Website: http://127.0.0.1:8000
echo ===========================================
echo JANGAN TUTUP JENDELA INI SELAMA PENGEMBANGAN.
pause