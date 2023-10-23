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
        <title>Calendrier</title>
    </head>

    <body>
<?php 
    include_once "header-admin.html";
?> 

    <main>
        <h1>Calendrier</h1>

    </main>

<?php 
    include_once "./footer-admin.html";
?>