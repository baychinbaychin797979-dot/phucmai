@echo off
REM Movable Type Framework Installation Script for Windows

echo Movable Type Framework Installation
echo ====================================
echo.

REM Check PHP
echo Checking PHP version...
php -v
if %ERRORLEVEL% NEQ 0 (
    echo Error: PHP is not installed or not in PATH
    exit /b 1
)

REM Install Composer dependencies
echo Installing Composer dependencies...
call composer install
if %ERRORLEVEL% NEQ 0 (
    echo Error: Composer installation failed
    exit /b 1
)

REM Install NPM dependencies
echo Installing NPM dependencies...
call npm install
if %ERRORLEVEL% NEQ 0 (
    echo Error: NPM installation failed
    exit /b 1
)

REM Create .env file
if not exist .env (
    echo Creating .env file...
    copy .env.example .env
    echo Warning: Please edit .env with your configuration
)

REM Create storage directories
echo Creating storage directories...
if not exist storage\cache mkdir storage\cache
if not exist storage\logs mkdir storage\logs
if not exist storage\uploads mkdir storage\uploads

echo.
echo Installation completed!
echo Start server with: npm run dev
pause
