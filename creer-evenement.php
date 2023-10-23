<?php 
    session_start();

    if (!isset($_SESSION["admin"])) {
        header("Location: index.php");
        exit();
    } else {
        $admin = unserialize($_SESSION["admin"]);
    } 

    $msg = "Veuillez remplir les champs obligatoires."; 
    $error = "Une erreur s'est produite.";
    $nom1 = ""; 
    $prenom2 = ""; 
    $nom2 = ""; 
    $tel = "";
    if (isset($_POST["prenom1"]) && isset($_POST["mail"])) { // si les champs obligatoires sont remplis
        require_once "sanitize.php"; 
        $prenom1 = sanitize($_POST["prenom1"]); 
        $mail = sanitize($_POST["mail"]);
        if (isset($_POST["nom1"])) {            // checker si d'autres champs sont remplis
            $nom1 = sanitize($_POST["nom1"]);
        }
        if (isset($_POST["prenom2"])) {
            $prenom2 = sanitize($_POST["prenom2"]);
        }
        if (isset($_POST["nom2"])) {
            $nom2 = sanitize($_POST["nom2"]);
        }
        if (isset($_POST["tel"])) {
            $tel = sanitize($_POST["tel"]);
        } 
        require "zelie.php";
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=$charset", $dbuser, $dbpass);
        $query = $pdo->prepare("INSERT INTO clients (nom1, prenom1, nom2, prenom2, mail, telephone) VALUES (:nom1, :prenom1, :nom2, :prenom2, :mail, :telephone);"); 
        $query->bindParam(":nom1", $nom1, PDO::PARAM_STR);
        $query->bindParam(":prenom1", $prenom1, PDO::PARAM_STR);
        $query->bindParam(":nom2", $nom2, PDO::PARAM_STR);
        $query->bindParam(":prenom2", $prenom2, PDO::PARAM_STR);
        $query->bindParam(":mail", $mail, PDO::PARAM_STR);
        $query->bindParam(":telephone", $tel, PDO::PARAM_STR); 

        if ($query->execute()) { // si la requête fonctionne, récupérer l'id client
            $query = $pdo->prepare("SELECT id FROM clients ORDER BY DESC LIMIT 1;"); 
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();
            $dernierId = $query->fetch(); 
            $client = intval($dernierId["id"]); 

            if (isset($_POST["prix"])) {
                $tarif = $_POST["prix"]; 
                $acompte = ""; 
                $reste = ""; 
                if (isset($_POST["acompte"])) {
                    $acompte = $_POST["acompte"];
                } 
                if (isset($_POST["reste"])) {
                    $reste = $_POST["reste"];
                } 
                $query = $pdo->prepare("INSERT INTO prix (tarif, acompte, reste) VALUES (:tarif, :acompte, :reste);"); 
                $query->bindParam(":tarif", $tarif, PDO::PARAM_INT); 
                $query->bindParam(":acompte", $acompte, PDO::PARAM_INT); 
                $query->bindParam(":reste", $reste, PDO::PARAM_INT); 

                if ($query->execute()) { // si la requête fonctionne, récupérer l'id prix
                    $query = $pdo->prepare("SELECT id FROM prix ORDER BY DESC LIMIT 1;"); 
                    $query->setFetchMode(PDO::FETCH_ASSOC);
                    $query->execute();
                    $lastId = $query->fetch(); 
                    $prix = intval($lastId["id"]); 

                    if (isset($_POST["event"]) && isset($_POST["date"])) {
                        if ($_POST["event"] == "mariage") {
                            $event = 1;
                        } elseif ($_POST["event"] == "couple") {
                            $event = 2;
                        } else {
                            $event = 3;
                        } 
                        $date = sanitize($_POST["date"]); 
                        $heure = ""; 
                        $lieu = ""; 
                        $video = ""; 
                        $demandes = ""; 
                        $notes = ""; 
                        $devis = ""; 
                        if (isset($_POST["heure"])) {
                            $heure = sanitize($_POST["heure"]); 
                        }
                        if (isset($_POST["lieu"])) {
                            $lieu = sanitize($_POST["lieu"]); 
                        }
                        if (isset($_POST["video"])) {
                            if ($_POST["video"] == "non") {
                                $video = 1;
                            } 
                        } 
                        if (isset($_POST["demandes-hidden"])) {
                            $demandes = sanitize($_POST["demandes-hidden"]);
                        } 
                        if (isset($_POST["notes"])) {
                            $notes = sanitize($_POST["notes"]);
                        } 
                        if (isset($_POST["devis"])) {
                            $devis = $_POST["devis"];
                        }
                        $query = $pdo->prepare("INSERT INTO shootings (date, heure, lieu, video, demandes, notes, devis, client, prix, type) VALUES (:date, :heure, :lieu, :video, :demandes, :notes, :devis, :client, :prix, :type);"); 
                        $query->bindParam(":date", $date, PDO::PARAM_STR); 
                        $query->bindParam(":heure", $heure, PDO::PARAM_STR); 
                        $query->bindParam(":lieu", $lieu, PDO::PARAM_STR); 
                        $query->bindParam(":video", $video, PDO::PARAM_INT); 
                        $query->bindParam(":demandes", $demandes, PDO::PARAM_STR); 
                        $query->bindParam(":notes", $notes, PDO::PARAM_STR); 
                        $query->bindParam(":devis", $devis, PDO::PARAM_LOB); //! sécuriser l'envoi de fichier
                        $query->bindParam(":client", $client, PDO::PARAM_INT); 
                        $query->bindParam(":prix", $prix, PDO::PARAM_INT); 
                        $query->bindParam(":type", $event, PDO::PARAM_INT);

                        if ($query->execute()) { // si la requête fonctionne, récupérer l'id shooting
                            $query = $pdo->prepare("SELECT id FROM shootings ORDER BY DESC LIMIT 1;"); 
                            $query->setFetchMode(PDO::FETCH_ASSOC);
                            $query->execute();
                            $derniereId = $query->fetch(); 
                            $shooting = intval($derniereId["id"]); 
                            //TODO : alter table prix where id = $prix 

                            $phy = "physique"; 
                            $tel = "telephonique"; 
                            $motif = "";
                            if (isset($_POST["heure1"]) && isset($_POST["date1"]) && isset($_POST["lieu1"])) {//! A FINIR  
                                
                            }
                        } else {
                            echo $error;
                        }
                    }
                } else {
                    echo $error;
                }
            }

        } else {
            echo $error;
        }
    } else { 
        echo $msg;
    }

    //! CLIENT -> PRIX -> SHOOTING -> RDV

    include_once "./head.html";
?>
        <title>Créer un événement</title>
    </head>

    <body>
<?php 
    include_once "header-admin.html";
?> 

    <main>
        <h1>Nouvel événement</h1>

        <form action="" >
            <fieldset>
                <legend class="quicksand">Shooting</legend>

                <label for="event" class="required">Événement</label>
                <select name="event" id="event">
                    <option value="mariage">Mariage</option>
                    <option value="couple">Couple</option>
                    <option value="restauration">Restauration</option>
                </select>

                <label for="prenom1" class="required">Prénom</label> 
                <input type="text" name="prenom1" id="prenom1" required>
                <label for="nom1">Nom</label> 
                <input type="text" name="nom1" id="nom1">
                <label for="prenom2">Prénom partenaire</label> 
                <input type="text" name="prenom2" id="prenom2">
                <label for="nom2">Nom partenaire</label> 
                <input type="text" name="nom2" id="nom2">
                <label for="mail" class="required">Mail</label>
                <input type="email" name="mail" id="mail" required>
                <label for="tel">Téléphone</label>
                <input type="tel" name="tel" id="tel">
                <label for="date" class="required">Date</label>
                <input type="date" name="date" id="date" required>
                <label for="heure">Heure</label>
                <input type="time" name="heure" id="heure">
                <label for="lieu">Lieu</label>
                <input type="text" name="lieu" id="lieu">
                <label for="prix" class="required">Prix demandé</label>
                <input type="number" name="prix" id="prix" required>
                <label for="acompte">Acompte payé</label>
                <input type="number" name="acompte" id="acompte">
                <label for="reste">Reste payé</label>
                <input type="number" name="reste" id="reste">

                <select name="video" id="video">
                    <option value="non">Non</option>
                    <option value="oui">Oui</option>
                </select>

                <select name="demandes" id="demandes">
                    <option value="non">Non</option>
                    <option value="oui">Oui</option> 
                </select> 
                <?php 
                    if (isset($_POST["demandes"])) {
                        if ($_POST["demandes"] == "oui") { ?>
                             <div id="demandes-hidden">
                                <textarea name="demandes-oui" id="demandes-oui" cols="30" rows="10"></textarea>
                            </div>
                       <?php }
                    }
                ?>
            </fieldset>

            <fieldset>
                <legend>Rdv prévus</legend>
                <p class="form">Rdv physiques</p>
                <label for="nb-phy">Nombre</label>
                <input type="number" name="nb-phy" id="nb-phy" min="0" max="3"> 
                <div id="div-rdv"></div>
                <p class="form">Rdv téléphoniques</p>
                <label for="nb-tel">Nombre</label>
                <input type="number" name="nb-tel" id="nb-tel" min="0" max="3"> 
                <div id="rdv-div"></div>
            </fieldset>

            <fieldset>
                <legend>Notes</legend>
                <label for="notes">À faire</label>
                <textarea name="notes" id="notes" cols="30" rows="10"></textarea> 
                <label for="devis">Devis</label>
                <input type="file" name="devis" id="devis">
            </fieldset>

            <button>Créer un événement</button>
        </form> 
        <script>
            function optionsRdv(nb) { // prend comme argument le nb de rdv physiques
            const divRdv = document.getElementById("div-rdv");
            divRdv.innerHTML = ""; 

            for (var i = 1; i <= nb; i++) {
                var div = document.createElement("div"); 
                div.id = "phy" + i;
                var labelMotif = document.createElement("label"); 
                labelMotif.for = "motif" + i; 
                labelMotif.textContent = "Motif rdv " + i; 
                var inputMotif = document.createElement("input"); 
                inputMotif.type = "text"; 
                inputMotif.name = "motif" + i;
                inputMotif.id = "motif" + i;
                inputMotif.maxLength = "60"; 
                var labelDate = document.createElement("label"); 
                labelDate.for = "date" + i; 
                labelDate.class = "required";
                labelDate.textContent = "Date rdv " + i; 
                var inputDate = document.createElement("input"); 
                inputDate.type = "date"; 
                inputDate.name = "date" + i;
                inputDate.id = "date" + i; // le rendre required ??
                var labelHeure = document.createElement("label"); 
                labelHeure.for = "heure" + i; 
                labelHeure.class = "required";
                labelHeure.textContent = "Heure rdv " + i; 
                var inputHeure = document.createElement("input"); 
                inputHeure.type = "time"; 
                inputHeure.name = "heure" + i;
                inputHeure.id = "heure" + i; 
                var labelLieu = document.createElement("label"); 
                labelLieu.for = "lieu" + i; 
                labelLieu.class = "required";
                labelLieu.textContent = "Lieu rdv " + i; 
                var inputLieu = document.createElement("input"); 
                inputLieu.type = "text"; 
                inputLieu.name = "lieu" + i;
                inputLieu.id = "lieu" + i; 
                inputLieu.maxLength = "120";
                div.appendChild(labelMotif);
                div.appendChild(inputMotif);
                div.appendChild(labelDate);
                div.appendChild(inputDate);
                div.appendChild(labelHeure); 
                div.appendChild(inputHeure); 
                div.appendChild(labelLieu); 
                div.appendChild(inputLieu);
                divRdv.appendChild(div);
            }
        }

        document.getElementById('nb-phy').addEventListener('input', function() { 
            // savoir combien de rdv il y a
            var nbRdv = parseInt(this.value);
            optionsRdv(nbRdv);
        });
        </script>
    </main>

<?php 
    include_once "./footer-admin.html";
?>