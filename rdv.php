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
        <title>Ajouter un rendez-vous</title>
    </head>

    <body>
<?php 
    include_once "header-admin.html";
?>

<main>
    <h1>Nouveau rendez-vous</h1> 

    <div class="flex">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" required> 
        <label for="motif">Motif</label>
        <input type="text" name="motif" id="motif" required> 
        <label for="date">Date</label> 
        <input type="date" name="date" id="date" required>
        <label for="heure">Heure</label>
        <input type="time" name="heure" id="heure" required>
        <label for="lieu">Lieu</label>
        <input type="text" name="lieu" id="lieu"> 
        <button>Créer un rendez-vous</button>
    </div>
</main>

<?php 
    include_once "./footer-admin.html";
?>