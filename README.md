# EITF05-Webbs-kerhet
Project in web security

F�r att f� TLS att fungera har jag bytt WAMP mot Xampp.


Instruktioner:
 
- L�gg php-filer och jpeg-filer i en mapp ni kallar   "myproject". Placera sedan mappen i C:\xampp\htdocs\.

- Importera databasfilen "requiredDbFiles.sql" i phpmyadmin.


TLS konfiguration:
1. Placera "server.crt" filen i "\xampp\apache\conf\ssl.crt\"

2. Placera "server.key" filen i "\xampp\apache\conf\ssl.key\"

3. Ers�tt filen "httpd-ssl.conf i "\xampp\apache\conf\extra\" med den nya.

4. Ladda upp "ca.crt" bland "trusted root certification authorities store".
 P� Chrome: Int�llningar --> Avancerad --> Hantera certifikat

- F�r att k�ra hemsidan skriver nu nu https://localhost/ som URL.

-Om ni inte kan ansluta till hemsidan, g�r f�ljande:

1. �ppna httpd.conf filen i xampp\apache\conf och peka 'DocumentRoot "..."' till projekt-mappen (C:\xampp\htdocs\myproject. G�r likadant med '<Directory "...">'.
2. �ppna sedan httpd-ssl.conf filen i xampp\apache\conf\extra och �ndra 'DocumentRoot' som ovan.



