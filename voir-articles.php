<?php 
    session_start();

    if (!isset($_SESSION["admin"])) {
        header("Location: index.php");
        exit();
    } else {
        $admin = unserialize($_SESSION["admin"]);
    } 
    
    require "zelie.php";
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=$charset", $dbuser, $dbpass);
    $query = $pdo->prepare("SELECT * FROM categories;"); 
    $query->setFetchMode(PDO::FETCH_ASSOC); 
    $query->execute();
    $categories = $query->fetchAll();  
    $query = $pdo->prepare("SELECT * FROM articles;"); 
    $query->setFetchMode(PDO::FETCH_ASSOC); 
    $query->execute();
    $articles = $query->fetchAll(); 
    $query = $pdo->prepare("SELECT * FROM paragraphes;"); 
    $query->setFetchMode(PDO::FETCH_ASSOC); 
    $query->execute();
    $paragraphes = $query->fetchAll();  
    $query = $pdo->prepare("SELECT * FROM images;"); 
    $query->setFetchMode(PDO::FETCH_ASSOC); 
    $query->execute();
    $images = $query->fetchAll(); 

    include_once "./head.html";
?>
        <title>Voir les articles</title>
    </head>

    <body>
<?php 
    include_once "header-admin.html";
?>

<main>
    <h1>Mes articles</h1> 
        <?php 
            foreach ($categories as $categorie) { ?>
                <div class="column">
                    <h2><?= $categorie["nom"]; ?></h2>
                </div> 
                <div class="flex">
                    <?php
                    foreach ($articles as $article) {
                        if ($article["categorie"] == $categorie["id"]) { ?>
                            <div>
                                <h3><?= $article["titre"]; ?></h3> 
                                <?php
                                $firstImage = true; 
                                $firstText = true;
                                foreach ($images as $image) {
                                    if ($image["article"] == $article["id"] && $firstImage == true) { ?>
                                        <img class="<?= $image["format"]; ?>" src="<?= $image["source"]; ?>" alt="<?= $image["alt"]; ?>">
                                <?php 
                                    $firstImage = false;
                                    } 
                                }
                                foreach ($paragraphes as $paragraphe) {
                                    if ($paragraphe["article"] == $article["id"] && $firstText == true) { ?>
                                        <p><?= $paragraphe["contenu"]; ?></p> 
                                <?php
                                    $firstText = false;
                                    }
                                }
                                ?> 
                                <div class="row">
                                    <a class="update-article" href="#">Modifier</a>
                                    <a class="delete-article" href="#">Supprimer</a>
                                </div>
                            </div>
                        <?php
                        }
                    }
                ?> </div> <?php
            }
        ?>
</main>

<?php 
    include_once "./footer-admin.html";
?>