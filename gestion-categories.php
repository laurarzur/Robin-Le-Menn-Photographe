<?php 
    session_start();

    if (!isset($_SESSION["admin"])) {
        header("Location: index.php");
        exit();
    } else {
        $admin = unserialize($_SESSION["admin"]);
    } 

    if(isset ($_COOKIE["categorieId"])) {
        $categorieId = $_COOKIE["categorieId"]; 
        require "zelie.php";
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=$charset", $dbuser, $dbpass);
        $query = $pdo->prepare("DELETE FROM categories WHERE id = :id;"); 
        $query->bindParam(":id", $categorieId, PDO::PARAM_INT); 
        if ($query->execute()) { 
           // header("Location: gestion-categories.php");
        }
    } 
    
    include_once "./head.html";
?>
        <title>Gérer les catégories</title>
    </head>

    <body>
<?php 
    include_once "header-admin.html";
?>

<main>
    <h1>Mes catégories</h1> 
        <div class="flex">
            <?php 
                $query = $pdo->prepare("SELECT * FROM categories;"); // aller chercher tous les noms de catégories
                $query->setFetchMode(PDO::FETCH_ASSOC); 
                $query->execute(); 
                $categories = $query->fetchAll(); // les mettre dans une variable
                foreach($categories as $cat) { // ne garder que le nom pour chaque categorie
                    $categorie = $cat["nom"]; 
                    $id = $cat["id"]; ?> 
                    <p class="paragraph<?= $id; ?>" id="<?= $categorie; ?>"><?= $categorie; ?></p>
                    <div>
                        <a href="#" class="update" id="<?= $id; ?>">Modifier</a>
                        <a href="#" class="delete" id="<?= $id; ?>">Supprimer</a>
                    </div> 
                    <form class="modif<?= $id; ?>" action="/api/update-cat.php" method="post">
                    </form>
            <?php } ?>
        </div>

    <a class="lien-plus" href="#" id="add-cat"><img src="img/plus.png" alt="icône créer événement" class="plus"></a> 
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</main>

<?php 
    include_once "./footer-admin.html";
?>