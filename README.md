# Robin-Le-Menn-Photographe
## Site vitrine & gestion clients

J'ai réalisé ce projet durant ma formation chez Avenir 84. C'est une application pour mon conjoint, qui est photographe, avec une partie site vitrine, une partie blog (qui n'est pas encore fonctionnelle), et une partie administrateur où il pourra gérer ses clients / shootings. Ce projet a été réalisé en PHP pur. <br><br>
La partie site vitrine est statique. Seul le formulaire de contact nécessite une communication avec la base de données pour y enregistrer les messages. Si la requête SQL est exécutée, le formulaire disparait pour laisser apparaître un message de confirmation d'envoi, et le bouton "Envoyer" se change en "Envoyé". Si le message n'a pas pu être enregistré dans la base de données, un message d'erreur apparaît sous le formulaire.<br><br> 
La partie blog est liée à la base de données puisque les articles et catégories y sont stockés. Le menu de navigation va chercher toutes les catégories dans la BDD et l'accueil du blog affiche les 2 derniers articles publiés. Une fois le projet terminé, on pourra afficher tous les articles en cliquant sur leur catégorie. Le blog ne permet pas de connexion, ni d'interaction avec les articles, à la demande de mon conjoint. <br><br> 
Côté admin, on retrouve la gestion du blog, avec possibilité d'ajouter, modifier ou supprimer les articles et catégories. Pour chaque type de shooting (mariage, séance couple ou restauration), mon conjoint aura accès à un tableau affichant le nom des clients, la date des shootings et une case indiquant si la prestation est close ou non. En cliquant sur un nom, la fiche complète du shooting client apparaîtra, avec toutes les informations qu'il aura entré dans un formulaire. Pour accéder à ce formulaire et ajouter un nouveau shooting (et un nouveau client s'il n'existe pas dans la BDD), il suffira de cliquer sur une icône en dessous du tableau. 
<br><br>
Ce projet est loin d'être terminé, car j'ai passé beaucoup de temps à modifier la maquette et à me battre avec jQuery / AJAX. Avec l'expérience que j'ai gagné durant la formation, je vois maintenant les lacunes et les choses qui aurait pu être faites différemment. Je pense restructurer ce projet et utiliser Symfony pour lui donner une base plus solide.