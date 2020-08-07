Numele proiectului: Jewelry Warehouse Management Project 
Autor: Puscasu Ana-Maria
Deployment: Language: PHP IDE: PhpStorm Framework: Laravel

Descrierea proiectului:
- implementeaza un sistem informatic de gestiune a unui depozit de bijuterii
- ofera informatii si rapoarte in timp real
- asigura monitorizarea stocurilor prin optimizarea spatiului de depozitare

Pasi pentru descarcarea proiectului de pe gitHub:
- pentru clonarea repo-ului de pe github, folosesti comanda in cmd: 'git clone https://github.com/puscasuam/wsms.git'
- dupa clonare, te pozitionezi in fisierul proiectului (cd wsms) si din linia de comanda rulezi urmatoarele comenzi:
    - 'composer install' ..... daca ai eroarea " Could not open input file: C:\Users\....\wsms\composer.phar", da comanda: "curl -sS https://getcomposer.org/installer | php"
    - 'npm install'
    - 'copy .env.example .env'
    - 'php artisan key:generate'
- deschizi proiectul in PhpStorm (de preferat) si cauti fisierul .env  (atentie! nu env.exemple). In acest fisier vei gasi variabila"DB_DATABASE".  Inlocuieste textul "laravel" cu textul "wsms" 
- intra in PhpMyAdmin (din xampp  control panel - MySql - Admin) si genereaza o noua baza de date cu numele "wsms"
- rulare comanda CMD, in folderul sursa: php artisan migrate
- rulare comanda CMD: 'php artisan serve' si vei primi urmatorul raspuns: 'Laravel development server started: http://127.0.0.1:8000' Acum serverul ar trebui sa fie functional
- acceseaza in browser locatia:  http://127.0.0.1:8000


