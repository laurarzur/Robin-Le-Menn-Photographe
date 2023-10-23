<?php 
    session_start();

    $email = ""; 
    $mdp = ""; 
    $message = "Les données saisies sont incorrectes.";

    if (isset($_POST["email"]) && isset($_POST["mdp"])) { 
        require "sanitize.php";
        $email = sanitize($_POST["email"]); // nettoyer les entrées dans le formulaire
        require "zelie.php";
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=$charset", $dbuser, $dbpass); // connexion bdd
        $query = $pdo->prepare("SELECT * FROM administrateur WHERE mail = :email;"); // vérifier si l'email est dans la bdd
        $query->bindParam(":email", $email, PDO::PARAM_STR); 
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute(); 
        $resultats = $query->fetchAll();

        var_dump($resultats); 
        var_dump(password_verify($_POST["mdp"], $resultats[0]["mdp"]));

        if (count($resultats) == 1) { // si cela corresond à une ligne dans la bdd 
            
            if (password_verify($_POST["mdp"], $resultats[0]["mdp"])) { // vérifier le mot de passe
                $_SESSION["admin"] = serialize($resultats[0]); 
                header("Location: calendrier.php"); // rediriger vers la page "calendrier.php"
            } else { ?>
                <div class="erreur"> <!-- essayer de faire un joli message d'erreur -->
                    <?= $message; ?>
                </div>
           <?php }
        } else { ?>
            <div class="erreur">
                <?= $message; ?>
            </div>
       <?php }
    }

    require_once "head.html";
?> 

        <title>Connexion</title> 
    </head> 

    <body>
        <header id="connexion">
            <img src="img/logo.png" alt="Logo Robin Le Menn Photographe">
        </header> 

        <main>
            <div id="connexion">
                <h1 class="quicksand">Connexion admin</h1> 

                <form action="" method="post">
                    <label for="email">Adresse mail</label>
                    <input type="email" name="email" id="mail-admin" autocomplete="email">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" name="mdp" id="mdp-admin" autocomplete="current-password">
                    <button>Connexion</button>
                </form>
            </div>
        </main>
 
<?php 
    require_once "footer-admin.html";
?>
