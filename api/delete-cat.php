<?php 
   /* if (isset ($_COOKIE["categorieId"])) {
        $categorieId = $_COOKIE["categorieId"]; 
        $pdo = new PDO("");
        $query = $pdo->prepare("DELETE FROM categories WHERE id = :id;"); 
        $query->bindParam(":id", $categorieId, PDO::PARAM_INT); 
        if ($query->execute()) { 
            header("Location: ../gestion-categories.php");
        }
    } 
?>
