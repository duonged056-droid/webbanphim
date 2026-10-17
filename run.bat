@echo off
chcp 65001 >nul
title Keyboard Shop - Laravel

echo ================================================
echo        KEYBOARD SHOP - KHOI DONG SERVER
echo ================================================
echo.

cd /d "%~dp0"

where php >nul 2>&1
if %errorlevel% neq 0 (
    echo [LOI] Khong tim thay PHP! Hay cai XAMPP hoac them PHP vao PATH.
    pause
    exit /b 1
)

where composer >nul 2>&1
if %errorlevel% neq 0 (
    echo [LOI] Khong tim thay Composer! Hay cai Composer.
    pause
    exit /b 1
)

if not exist "vendor\" (
    echo [1/4] Cai dat Composer dependencies...
    composer install --no-interaction
    echo.
) else (
    echo [1/4] Composer dependencies da san sang.
)

if not exist ".env" (
    echo [2/4] Tao file .env tu .env.example...
    copy .env.example .env
    php artisan key:generate
    echo.
) else (
    echo [2/4] File .env da ton tai.
)

echo [3/4] Xoa cache cu...
php artisan config:clear >nul 2>&1
php artisan cache:clear >nul 2>&1
php artisan route:clear >nul 2>&1
echo      Done!
echo.

if not exist "public\storage" (
    php artisan storage:link >nul 2>&1
)

echo [4/4] Khoi dong Laravel server...
echo.
echo ================================================
echo   Web chay tai: http://localhost:8000
echo   Nhan Ctrl+C de dung server
echo ================================================
echo.

start "" cmd /c "timeout /t 2 >nul && start http://localhost:8000"

php artisan serve

pause
