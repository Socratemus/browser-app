# browser-app

Aplicatia are ca entry point vendor\Bootstrap.php si are o structura de tip MVC.

Routerul se face dupa parametrul ?q din url, primul segment reprezentand
controllerul, al doilea reprezentand metoda apelata, iar restul fiind parametrii.

Business logicul se face in modele (/app/model) , iar viewurile (/app/view) afiseaza informatia
prelucrata in controller(/app/controller).

Conexiunea la baza de date se face in clasa \vendor\Database.php (foloseste ca mysql driver - PDO ) prin intermediul metodei connect,
ea fiind ceruta din model.

Mesajele de notificare la adaugare/editare/stergere se fac prin intermediul sesiunii, operatii gestionate in \vendor\Session.php

Detectarea browserului se face pe server.

Linkuri : 
  Prima pagina : - ?q=index
  Dashbord portale : ?q=admin/index
  
Database :
 - \exports\dev_portals.sql