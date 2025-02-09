@ECHO OFF
SETLOCAL
SET "sourcedir=G:\xampp\htdocs\img"
FOR /r "%sourcedir%" %%a IN (*.png) DO (
 optipng.exe -force -o7 "%%a"
)
pause
GOTO :EOF