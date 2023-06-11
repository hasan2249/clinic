@echo off

:: open xammp server (apatch & mysql)
cd "C:\xampp"
start xampp_start.EXE

:: server php by artisan 
cd "C:\xampp\htdocs\moneyTransfer"
start "" php artisan serve --host=0.0.0.0

:: wait 5 seconds to ensure that servers were opened
ping 127.0.0.1 -n 3 > nul

:: open brawser to localhost
::start "" http://127.0.0.1:8000
start "" "C:\Program Files (x86)\Google\Chrome\Application\chrome_proxy.exe"  --profile-directory=Default --app-id=mngloiodpbedloingimookgdhhkgcblo
