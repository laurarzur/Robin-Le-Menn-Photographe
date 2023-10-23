<?php
    if (isset($_POST["clientId"])) {
        $clientId = $_POST["clientId"]; 

        // var_dump($clientId);
        $pdo = new PDO("");
        $query = $pdo->prepare(
            "SELECT * FROM clients
            INNER JOIN shootings ON clients.id = shootings.client
            INNER JOIN prix ON shootings.id = prix.shooting
            LEFT JOIN rdv ON shootings.id = rdv.shooting
            WHERE client = :id AND shootings.type = 2;");

        $query->bindParam(":id", $clientId, PDO::PARAM_INT); 
        $query->setFetchMode(PDO::FETCH_ASSOC);
        if ($query->execute()) {
            $client = $query->fetch(); 
            
            echo json_encode($client);
        } else {
            echo "{}";
        }
    }
?>
