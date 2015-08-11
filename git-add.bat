@echo off
git add bin\mysql\mysql5.6.17\data\ib*
git add bin\mysql\mysql5.6.17\data\wine_db
git add www\wine_site
git add git-add.bat
git commit -m %1
set user=dcwiggins912
echo %user%\n | git push origin master