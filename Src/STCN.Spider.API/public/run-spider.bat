@echo off
:do
php spider2.php
timeout /nobreak /t 3600
goto do
pause
