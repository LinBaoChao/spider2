@echo off
:do
php -q spider.php
timeout /nobreak /t 600
goto do
pause
