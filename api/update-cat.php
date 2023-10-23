<?php 
    $id = $_COOKIE["idCategorie"]; 
    $nom = $_COOKIE["nouveauNom"]; 

    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=robin;charset=utf8", "laura", "lauraB@boudou22"); 
    if (isset($id) && isset($nom)) {
        $query = $pdo->prepare("UPDATE categories SET nom = :nom WHERE id = :id"); 
        require "../sanitize.php";
        $nom = sanitize($nom);
        $query->bindParam(":nom", $nom, PDO::PARAM_STR); 
        $query->bindParam(":id", $id, PDO::PARAM_INT); 
        if ($query->execute()){
            header("Location: ../gestion-categories.php");
        }
    }
    
    