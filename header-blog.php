<header> 
    <a href="blog.php"><img src="img/logo.png" alt="Logo Robin Le Menn Photographe"></a>
    <nav id="nav-blog">
        <!-- modifier en PHP pour afficher les catégories ET AJOUTER CLASSE QUICKSAND ?-->
        <ul> 
            <?php 
                require "zelie.php";
                $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=$charset", $dbuser, $dbpass);
                $query = $pdo->prepare("SELECT * FROM categories;"); // aller chercher tous les noms de catégories
                $query->setFetchMode(PDO::FETCH_ASSOC); 
                $query->execute(); 
                $categories = $query->fetchAll(); // les mettre dans une variable
                foreach($categories as $cat) { // ne garder que le nom pour chaque categorie
                    $categorie = $cat["nom"]; 
                    $id = $cat["id"]; ?> 
                    <li><a href="categorie.php" class="cat-list" id="cat<?= $id; ?>"><?= $categorie; ?></a></li>
            <?php } ?>
        </ul>
    </nav>
</header>