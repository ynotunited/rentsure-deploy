@echo off
echo Removing duplicate migration files...

if exist "database\migrations\2025_10_30_150100_create_documents_table.php" (
    del "database\migrations\2025_10_30_150100_create_documents_table.php"
    echo Removed duplicate documents table migration
)

if exist "database\migrations\2025_10_30_150200_create_verification_requests_table.php" (
    del "database\migrations\2025_10_30_150200_create_verification_requests_table.php"
    echo Removed duplicate verification requests table migration
)

echo Cleanup complete!
echo Running migrations...
php artisan migrate

pause
