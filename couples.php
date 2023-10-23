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
    $query = $pdo->prepare("SELECT clients.id, prenom1, date FROM clients LEFT JOIN shootings ON clients.id = shootings.client WHERE type = 2 ORDER BY date ASC;"); // récupérer les dates et id clients des séances couple
    $query->setFetchMode(PDO::FETCH_ASSOC); 
    $query->execute(); 
    $shootings = $query->fetchAll(); 


        /*$query = $pdo->prepare("SELECT * FROM prix WHERE id LIKE :id;"); 
        $query->bindParam(":id", $idPrix, PDO::PARAM_INT); 
        $query->setFetchMode(PDO::FETCH_ASSOC); 
        $query->execute(); 
        $infosPrix = $query->fetchAll(); */
        /* echo " " . implode($prenomClient[0]) . " "; 
        echo " " . $shooting["date"] . " "; 
        echo "non"; */
        // TODO : dans la fiche client if (intval($infosPrix[0]["tarif"]) > (intval($infosPrix[0]["acompte"]) + intval($infosPrix[0]["reste"]))) 
    
    require_once "./head.html";
?>
        <title>Couples</title>
    </head>

    <body>
<?php 
    require_once "header-admin.html";
?> 

    <main>
        <h1>Couples</h1>
        
        <section>
            <table>
                <thead>
                    <tr>
                        <th class="quicksand">Prénom</th>
                        <th class="quicksand">Date</th>
                        <th class="quicksand">Clos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($shootings as $shooting) {
                    ?>
                    <tr>
                        <td><a href="#" class="ligne-client" id="<?= $shooting["id"]; ?>"><?= $shooting["prenom1"]; ?></a></td>
                        <td><?=" " . $shooting["date"] . " "; ?></td>
                        <td id="clos"><?= "non"; ?></td> 
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <form action="" method="post">
                <input type="hidden" name="get-id" id="get-id" value="">
            </form>
        </section>

        <section>
            <div id="hidden-fiche">
                
            </div>
        </section>

        <a class="lien-plus" href="creer-evenement.php"><img src="img/plus.png" alt="icône créer événement" class="plus"></a>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="js/script.js"></script>
    </main>

<?php 
    require_once "./footer-admin.html";
?>