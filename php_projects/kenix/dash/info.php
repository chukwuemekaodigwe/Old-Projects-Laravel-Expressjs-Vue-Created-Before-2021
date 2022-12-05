RewriteBase "/kinex"
RewriteEngine On
RewriteCond /kinex/%{REQUEST_FILENAME} !-f
RewriteCond /kinex/%{REQUEST_FILENAME} !-d
RewriteRule "(.*)" "index.php?$1" [PT,QSA]