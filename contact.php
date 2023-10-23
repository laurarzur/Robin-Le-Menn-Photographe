<?php 
    session_start();

    $nom = "";
    $success = "Votre message a bien été envoyé. Je vous recontacterai au plus vite pour répondre à votre demande."; 
    $error = "Il y a eu une erreur au moment de l'envoi de votre message. Veuillez réessayer plus tard ou me contacter d'une autre manière.";
    if (isset($_POST["mail"]) && isset($_POST["message"])) { 
        require "sanitize.php";
    
        if (isset($_POST["nom"])) {
            $nom = sanitize($_POST["nom"]);  //nettoyer les entrées dans le formulaire 
        }
        $mail = sanitize($_POST["mail"]); 
        $message = sanitize($_POST["message"]); 

        require "zelie.php";
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=$charset", $dbuser, $dbpass); // connexion bdd
        $query = $pdo->prepare("INSERT INTO messages (nom, mail, contenu) VALUES (:nom, :mail, :contenu);"); 
        $query->bindParam(":nom", $nom, PDO::PARAM_STR); 
        $query->bindParam(":mail", $mail, PDO::PARAM_STR); 
        $query->bindParam(":contenu", $message, PDO::PARAM_STR); 

        if ($query->execute()) { ?>
            <input type="hidden" name="envoi" id="envoi" value="ok">
        <?php } else { ?>
            <input type="hidden" name="envoi" id="envoi" value="nope">
        <?php }
    }
    
        // FAIRE L'ENVOI PAR MAIL DES MESSAGES !!

    include_once "./head.html";
?>
        <title>Contact - Robin Le Menn Photographe</title>
    </head>

    <body>
        <?php 
            include_once "header.html";
        ?>

        <main>
            <h1>Me contacter</h1>
            <p>Vous pouvez me décrire votre projet dans le formulaire ci-dessous, ainsi que me donner la date à laquelle vous auriez besoin de moi. J’aurais plaisir à vous recontacter. 
            <br>Vous pouvez également me contacter par mail, téléphone ou via mes réseaux sociaux à tout moment.</p>

            <div class="flex">
                <div>
                    <h2>Formulaire de contact</h2>
                    <form action="" method="post" id="hide-form">
                        <div>
                            <label for="nom">Nom</label> 
                            <input type="text" name="nom" id="nom" maxlength="40" autocomplete="name">
                        </div>
                        <div>
                            <label for="mail" class="required">Adresse mail</label> 
                            <input type="email" name="mail" id="mail" maxlength="50" autocomplete="email" required> 
                        </div>
                        <div>
                            <label for="message" class="required">Message</label>
                            <textarea name="message" id="message" cols="30" rows="10" required></textarea> 
                        </div>
                        <p id="mini">champs obligatoires</p>
                        <button>Envoyer</button>
                    </form> 
                    <div id="msg-envoye">
                        <button id="btn-msg"></button>
                    </div>
                </div>

                <div class="border" id="border-left">
                    <h2>Contactez-moi directement 7 jours /7</h2>
                    <h3>Par téléphone</h3>
                    <p>06.46.10.34.34</p>
                    <h3>Par mail</h3>
                    <p>robin.lemenn.photographe@gmail.com</p>
                    <h3>Sur Instagram</h3>
                    <p><a href="https://www.instagram.com/robin.lemenn.photographe/">@ robin.lemenn.photographe</a></p>
                    <h3>Sur Facebook</h3>
                    <p><a href="https://www.facebook.com/profile.php?id=100091543364166">Robin Le Menn Photographe</a></p>
                </div>
            </div>
            <script>
                // GÉRER L'ENVOI DE MESSAGES DANS LE FORMULAIRE DE CONTACT

                const btnMsg = document.querySelector("#btn-msg"); 
                const hideForm = document.querySelector("#hide-form");

                const envoi = document.getElementById("envoi").value;  
                const msgEnvoye = document.getElementById("msg-envoye"); // récupérer la div
                const newP = document.createElement("p"); // créer un texte de confirmation (ou non)
                msgEnvoye.appendChild(newP);

                if (envoi == "ok") { // vérifier si le message a bien été enregistré dans la bdd
                    hideForm.style.display = "none"; 
                    btnMsg.textContent = "Envoyé"; 
                    btnMsg.style.display = "block"; 
                    btnMsg.disabled = true;
                    newP.textContent = "Votre message a bien été envoyé. Je vous recontacterai au plus vite pour répondre à votre demande." 

                } else if (envoi == "nope") {
                    newP.classList.add("erreur"); 
                    newP.textContent = "Une erreur s'est produite lors de l'envoi de votre message. Veuillez réessayer plus tard ou me contacter d'une autre manière. Toutes mes excuses pour ce désagrément."
                }
            </script>
        </main>

<?php 
    include_once "./footer.html";
?>