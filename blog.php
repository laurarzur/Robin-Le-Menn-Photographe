<?php 
    // ALLER CHERCHER LES 2 DERNIERS ARTICLES DE LA BDD 
    require "zelie.php";
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=$charset", $dbuser, $dbpass);
    $query = $pdo->prepare("SELECT id, titre FROM articles ORDER BY id DESC LIMIT 2;"); // aller chercher tous les noms de catégories
    $query->setFetchMode(PDO::FETCH_ASSOC); 
    $query->execute(); 
    $articles = $query->fetchAll();
    $id1 = $articles[0]["id"]; 
    $id2 = $articles[1]["id"]; 

    $query = $pdo->prepare("SELECT * FROM paragraphes INNER JOIN images ON paragraphes.article = images.article WHERE paragraphes.article = :id1 OR paragraphes.article = :id2 GROUP BY paragraphes.article;");
    $query->bindParam(":id1", $id1, PDO::PARAM_INT);
    $query->bindParam(":id2", $id2, PDO::PARAM_INT);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute(); 
    $contenus = $query->fetchAll(); 

    include_once "head.html"; 
?>

        <title>Blog - Robin Le Menn Photographe</title>
    </head> 

    <body> 
        <?php 
            include_once "header-blog.php";
        ?>

        <main>
            <h1>À la une</h1>

            <div class="flex">
                <div>
                    <h2><?= $articles[0]["titre"]; ?></h2>
                    <?php 
                        foreach($contenus as $contenu)
                        if ($contenu["article"] == $articles[0]["id"]) { ?>
                            <p><?= $contenu["contenu"]; ?></p>
                            <img src="<?= $contenu["source"]; ?>" alt="<?= $contenu["alt"]; ?>">
                        <?php } ?>
                </div>
                <div>
                    <h2><?= $articles[1]["titre"]; ?></h2>
                    <?php 
                        foreach($contenus as $contenu)
                        if ($contenu["article"] == $articles[1]["id"]) { ?>
                            <p><?= $contenu["contenu"]; ?></p>
                            <img src="<?= $contenu["source"]; ?>" alt="<?= $contenu["alt"]; ?>">
                        <?php } ?>
                </div>

            <a href="index.php">Revenir à l'accueil du site</a>
        </main>

        <?php 
            include_once "footer.html";
        ?>