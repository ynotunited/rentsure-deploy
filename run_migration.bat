@echo off
echo Running RentSure Database Migration...
echo.

cd /d "c:\laragon\www\rentsure"

echo Checking current migration status...
php artisan migrate:status

echo.
echo Running new migration to add state field...
php artisan migrate

echo.
echo Migration completed! Press any key to exit...
pause > nul
