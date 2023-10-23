<?php 
    $id = $_COOKIE["idCategorie"]; 
    $nom = $_COOKIE["nouveauNom"]; 

    $pdo = new PDO(""); 
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
    
    
