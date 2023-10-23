<?php 
    session_start();

    if (!isset($_SESSION["admin"])) {
        header("Location: index.php");
        exit();  
    } else {
        $admin = unserialize($_SESSION["admin"]);
    } 

    $message = "L'article n'a pas pu être sauvegardé."; 
    require "zelie.php";
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=$charset", $dbuser, $dbpass);

    if (isset($_POST["titre"]) && isset($_POST["categorie"]) && isset($_POST["paragraphe"])) {
        require "sanitize.php";
        $titre = sanitize($_POST["titre"]);  
        $nom = sanitize($_POST["categorie"]);
        $query = $pdo->prepare("SELECT id FROM categories where nom LIKE :nom;"); 
        $query->bindParam(":nom", $nom, PDO::PARAM_STR); 
        $query->setFetchMode(PDO::FETCH_ASSOC); 
        $query->execute(); 
        $id = $query->fetch(); // id de la catégorie sélectionnée
        $query = $pdo->prepare("INSERT INTO articles (titre, categorie) VALUES (:titre, :categorie);"); 
        $query->bindParam(":titre", $titre, PDO::PARAM_STR); 
        $query->bindParam(":categorie", $id, PDO::PARAM_INT); 
        if ($query->execute()) {
            $query = $pdo->prepare("SELECT id FROM articles ORDER BY id DESC LIMIT 1;"); 
            $query->execute();
            $id = $query->fetch(); // id de l'article
            $contenu = sanitize($_POST["paragraphe"]);
            if (isset($_POST["paragraphe2"])) {
                $contenu2 = sanitize($_POST["paragraphe2"]);
                if (isset($_POST["paragraphe3"])) {
                    $contenu3 = sanitize($_POST["paragraphe3"]);
                    $query = $pdo->prepare("INSERT INTO paragraphes (contenu, article) VALUES (:contenu, :article), (:contenu2, :article), (:contenu3, :article);"); 
                    $query->bindParam(":contenu", $contenu, PDO::PARAM_STR);
                    $query->bindParam(":contenu2", $contenu2, PDO::PARAM_STR); 
                    $query->bindParam(":contenu3", $contenu3, PDO::PARAM_STR);
                    $query->bindParam(":article", $id, PDO::PARAM_INT); 
                    $query->execute();
                } else {
                    $query = $pdo->prepare("INSERT INTO paragraphes (contenu, article) VALUES (:contenu, :article), (:contenu2, :article);"); 
                    $query->bindParam(":contenu", $contenu, PDO::PARAM_STR);
                    $query->bindParam(":contenu2", $contenu2, PDO::PARAM_STR); 
                    $query->bindParam(":article", $id, PDO::PARAM_INT); 
                    $query->execute();
                }   
            } else {
                $query = $pdo->prepare("INSERT INTO paragraphes (contenu, article) VALUES (:contenu, :article);"); 
                $query->bindParam(":contenu", $contenu, PDO::PARAM_STR);
                $query->bindParam(":article", $id, PDO::PARAM_INT); 
                $query->execute();
            }

            if (isset($_POST["img"]) && isset($_POST["img-alt"])) { 
                $format = "";
                $alt = sanitize($_POST["img-alt"]); 
                $img = $_POST["img"]; 
                if (isset($_POST["img-format"])) {
                    $format = sanitize($_POST["img-format"]);
                }

                if (isset($_POST["img2"]) && isset($_POST["img2-alt"])) {
                    $alt2 = sanitize($_POST["img2-alt"]); 
                    $img2 = $_POST["img2"]; 
                    if (isset($_POST["img2-format"])) {
                        $format2 = sanitize($_POST["img2-format"]);
                    }

                    if (isset($_POST["img3"]) && isset($_POST["img3-alt"])) {
                        $alt3 = sanitize($_POST["img3-alt"]); 
                        $img3 = $_POST["img3"]; 
                        if (isset($_POST["img3-format"])) {
                            $format3 = sanitize($_POST["img3-format"]);
                        }
                        $query = $pdo->prepare("INSERT INTO images (source, format, alt, article) VALUES (:source, :format, :alt, :article), (:source2, :format2, :alt2, :article), (:source3, :format3, :alt3, :article);"); 
                        $query->bindParam(":source", $img, PDO::PARAM_LOB); 
                        $query->bindParam(":format", $format, PDO::PARAM_STR); 
                        $query->bindParam(":alt", $alt, PDO::PARAM_STR); 
                        $query->bindParam(":source2", $img2, PDO::PARAM_LOB); 
                        $query->bindParam(":format2", $format2, PDO::PARAM_STR); 
                        $query->bindParam(":alt2", $alt2, PDO::PARAM_STR); 
                        $query->bindParam(":source3", $img3, PDO::PARAM_LOB); 
                        $query->bindParam(":format3", $format3, PDO::PARAM_STR); 
                        $query->bindParam(":alt3", $alt3, PDO::PARAM_STR); 
                        $query->bindParam(":article", $id, PDO::PARAM_INT); 
                        $query->execute();
                    } else {
                        $query = $pdo->prepare("INSERT INTO images (source, format, alt, article) VALUES (:source, :format, :alt, :article), (:source2, :format2, :alt2, :article);"); 
                        $query->bindParam(":source", $img, PDO::PARAM_LOB); 
                        $query->bindParam(":format", $format, PDO::PARAM_STR); 
                        $query->bindParam(":alt", $alt, PDO::PARAM_STR); 
                        $query->bindParam(":source2", $img2, PDO::PARAM_LOB); 
                        $query->bindParam(":format2", $format2, PDO::PARAM_STR); 
                        $query->bindParam(":alt2", $alt2, PDO::PARAM_STR); 
                        $query->bindParam(":article", $id, PDO::PARAM_INT); 
                        $query->execute();
                    }
                }  else {
                $query = $pdo->prepare("INSERT INTO images (source, format, alt, article) VALUES (:source, :format, :alt, :article);"); 
                $query->bindParam(":source", $img, PDO::PARAM_LOB); 
                $query->bindParam(":format", $format, PDO::PARAM_STR); 
                $query->bindParam(":alt", $alt, PDO::PARAM_STR); 
                $query->bindParam(":article", $id, PDO::PARAM_INT); 
                $query->execute();
                }
            }
        } else { ?> 
            <div class="erreur">
                <?= $message; ?>
            </div>
        <?php }
    }

    include_once "./head.html";
?>
        <title>Écrire un article</title>
    </head>

    <body>
<?php 
    include_once "header-admin.html";
?> 

    <main>
        <h1>Nouvel article</h1>

        <form action="" method="post" id="article">
            <label for="titre">Titre de l'article</label>
            <input type="text" name="titre" id="titre" maxlength="120"> 
            <label for="categorie">Catégorie</label>
            <select name="categorie" id="categorie">
                <?php
                    $query = $pdo->prepare("SELECT nom FROM categories;"); // aller chercher tous les noms de catégories
                    $query->setFetchMode(PDO::FETCH_ASSOC); 
                    $query->execute(); 
                    $categories = $query->fetchAll(); // les mettre dans une variable
                    foreach($categories as $categorie) { // ne garder que le nom pour chaque categorie
                    $categorie = $categorie["nom"]; ?>
                    <option value="<?= $categorie; ?>"><?= $categorie; ?></option>
                    <?php } ?>   
            </select>
            <div class="move">
                <label for="paragraphe">Paragraphe</label>
                <textarea name="paragraphe" id="paragraphe" cols="30" rows="10"></textarea>
            </div>
            <div class="move">
                <label for="img">Image</label>
                <input type="file" name="img" id="img"> 
                <label for="img-format">Format</label>
                <select name="img-format" id="img-format">
                    <option value="portrait">Portrait</option>
                    <option value="paysage">Paysage</option>
                </select>
                <label for="img-alt">Texte alternatif</label>
                <input type="text" name="img-alt" id="img-alt">
            </div>
            <div class="move">
                <label for="paragraphe2">Paragraphe</label>
                <textarea name="paragraphe2" id="paragraphe2" cols="30" rows="10"></textarea>
            </div>
            <div class="move">
                <label for="img2">Image</label>
                <input type="file" name="img2" id="img2">
                <label for="img2-format">Format</label>
                <select name="img2-format" id="img2-format">
                    <option value="portrait">Portrait</option>
                    <option value="paysage">Paysage</option>
                </select>
                <label for="img2-alt">Texte alternatif</label>
                <input type="text" name="img2-alt" id="img2-alt">
            </div>
            <div class="move hidden" id="new-para">
                <label for="paragraphe3">Paragraphe</label>
                <textarea name="paragraphe3" id="paragraphe3" cols="30" rows="10"></textarea>
            </div>
            <div class="move hidden" id="new-img">
                <label for="img3">Image</label>
                <input type="file" name="img3" id="img3">
                <label for="img3-format">Format</label>
                <select name="img3-format" id="img3-format">
                    <option value="portrait">Portrait</option>
                    <option value="paysage">Paysage</option>
                </select>
                <label for="img3-alt">Texte alternatif</label>
                <input type="text" name="img3-alt" id="img3-alt">
            </div>
            <button type="button" class="quicksand" id="add-img" class="icons"><img src="img/image.png" alt="icône image">Ajouter image</button>
            <button type="button" class="quicksand" id="add-para" class="icons"><img src="img/paragraphe.png" alt="icône paragraphe">Ajouter paragraphe</button>
            <button>Publier l'article</button>
        </form>
        <script>
            // AJOUTER PARAGRAPHE OU IMAGE DANS CREATION ARTICLE
            const addImg = document.getElementById("add-img"); 
            const addPara = document.getElementById("add-para"); 

            addImg.addEventListener("click", ajoutImg); 
            addPara.addEventListener("click", ajoutPara);

            function ajoutImg() {
                const newImg = document.getElementById("new-img"); 
                newImg.style.display = "flex";
            }

            function ajoutPara() {
                const newPara = document.getElementById("new-para"); 
                newPara.style.display = "flex";
            }
        </script>
    </main>
  
<?php 
    include_once "./footer-admin.html";
?>