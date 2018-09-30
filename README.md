# EITF05-Webbs-kerhet
Project in web security

För att få TLS att fungera har jag bytt WAMP mot Xampp.


Instruktioner:
 
- Lägg php-filer och jpeg-filer i en mapp ni kallar   "myproject". Placera sedan mappen i C:\xampp\htdocs\.

- Importera databasfilen "requiredDbFiles.sql" i phpmyadmin.


TLS konfiguration:
1. Placera "server.crt" filen i "\xampp\apache\conf\ssl.crt\"

2. Placera "server.key" filen i "\xampp\apache\conf\ssl.key\"

3. Ersätt filen "httpd-ssl.conf i "\xampp\apache\conf\extra\" med den nya.

4. Ladda upp "ca.crt" bland "trusted root certification authorities store".
 På Chrome: Intällningar --> Avancerad --> Hantera certifikat

- För att köra hemsidan skriver nu nu https://localhost/ som URL.

Om ni inte kan ansluta till hemsidan, gör följande:

1. Öppna httpd.conf filen i xampp\apache\conf och peka 'DocumentRoot "..."' till projekt-mappen (C:\xampp\htdocs\myproject. Gör likadant med '<Directory "...">'.
2. Öppna sedan httpd-ssl.conf filen i xampp\apache\conf\extra och ändra 'DocumentRoot' som ovan.



