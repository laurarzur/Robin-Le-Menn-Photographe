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
        <title>Restauration</title>
    </head>

    <body>
<?php 
    include_once "header-admin.html";
?> 

    <main>
        <h1>Restauration</h1>

        <table>
            <thead>
                <tr>
                    <th class="quicksand">Nom</th>
                    <th class="quicksand">Date</th>
                    <th class="quicksand">Clos</th>
                </tr>
            </thead>
            <tbody>
                <!-- afficher autant de lignes qu'il y a de shootings type "restauration" -->
            </tbody>
        </table>

        <a class="lien-plus" href="creer-evenement.php"><img src="img/plus.png" alt="icône créer événement" class="plus"></a>
    </main>

<?php 
    include_once "./footer-admin.html";
?>