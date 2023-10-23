<?php 
    session_start();

    if (!isset($_SESSION["admin"])) {
        header("Location: index.php");
        exit();
    } else {
        $admin = unserialize($_SESSION["admin"]);
    } 
    
    include_once "./head.html";
?>
        <title>Blog</title>
    </head>

    <body>
<?php 
    include_once "header-admin.html";
?> 

    <main>
        <h1>Gérer le blog</h1>

        <div class="flex">
            <button><img src="" alt="" class="icons"><a href="creer-article.php" class="quicksand">Écrire un article</a></button>
            <button><img src="" alt="" class="icons"><a href="voir-articles.php" class="quicksand">Voir les articles</a></button>
            <button><img src="" alt="" class="icons"><a href="gestion-categories.php" class="quicksand">Gérer les catégories</a></button>
        </div>
    </main>

<?php 
    include_once "./footer-admin.html";
?>