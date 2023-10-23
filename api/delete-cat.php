<?php 
   /* if (isset ($_COOKIE["categorieId"])) {
        $categorieId = $_COOKIE["categorieId"]; 
        $pdo = new PDO("mysql:host=localhost;port=3306;dbname=robin;charset=utf8", "laura", "lauraB@boudou22");
        $query = $pdo->prepare("DELETE FROM categories WHERE id = :id;"); 
        $query->bindParam(":id", $categorieId, PDO::PARAM_INT); 
        if ($query->execute()) { 
            header("Location: ../gestion-categories.php");
        }
    } 
?>