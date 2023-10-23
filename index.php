<?php 
    include_once "./head.html";
?>
        <title>Robin Le Menn Photographe</title> <!-- pas inclus dans le head.html pour pouvoir changer le title -->
    </head>

    <body>
        <header>
            <div class="bg-img">
                <nav id="nav-index"> 
                    <a href="index.php"><img src="img/logo - Copie.png" alt="Logo Robin Le Menn Photographe"></a>
                    <div class="flex" id="menu-index">
                        <ul id="left-menu">
                            <li class="padding-left"><a href="index.php">Accueil</a></li>
                            <li class="padding-left"><a href="galeries.php">Galeries</a></li>
                            <li class="padding-left"><a href="tarifs.php">Tarifs</a></li> 
                        </ul>
                        <ul id="right-menu">
                            <li class="padding-right" id="pad-left"><a href="contact.php">Contact</a></li>
                            <li class="padding-right"><a href="blog.php">Blog</a></li>
                            <li class="padding-right"><a href="a-propos.php">À Propos</a></li>
                        </ul>
                    </div>
                    <a href="#" id="burger-index"><img src="img/burger-menu.png" alt="icône menu hamburger"></a>
                </nav>
            </div>
        </header>

        <main>
            <h1>Organisons ensemble le projet qui vous tient à coeur.</h1>
            <p>Parcourez les différentes galeries et trouvez le projet qui correspond à vos envies.</p>

            <section class="border">
                <h2>Le plus beau jour de votre vie</h2> 
                <div class="flex">
                    <div>
                        <img class="portrait" src="img/camille/camille-chaise2.JPG" alt="Camille dans sa robe de mariée style bohème, assise sur un fauteuil Emmanuelle, regarde vers sa droite avec un sourire pétillant. Elle tient son bouquet et a une couronne de fleurs dans ses longs cheveux châtains et bouclés.">
                    </div>
                    <div id="mariage">
                        <p>Vous <!--êtes en train d’organiser votre mariage et vous--> cherchez un photographe capable de capturer pour vous des images inoubliables ? Faites confiance à mon expérience et à mon œil avisé pour capter tous les moments de ce grand jour et sublimer chaque détail.
                        <br>Ma promesse : vous délivrer mes plus beaux clichés de cette journée particulière pour que vous puissiez la revivre encore et encore.</p>
                        <img class="avis" src="img/etoiles.png" alt="Notation 5 étoiles">
                        <p class="avis">“Superbe prestation avec de super photos souvenirs ! A l’écoute, Robin sait mettre à l’aise et saisir les bons moments avec son appareil. Très rapidement nous avons eu un retour des photos avec des couleurs, du noir et blanc, de super retouches lorsque nécessaire. 
                        <br>Son rendu nous donne un souvenir des meilleurs moments qui laisseront une trace importante dans nos souvenirs.”</p>
                        <p>Tom & Camille</p>
                    </div>
                </div>
            </section>

            <section class="border">
                <h2>Un moment entre amoureux</h2> 
                <div class="flex reverse"> 
                    <div>
                        <img class="portrait" src="img/raphaelle-c/raphaelle-colonnes.jpg" alt="Raphaëlle et Etienne assis sur les marches du mausaulée de Glanum à Saint-Remy-de-Provence. Ils sont tournés l'un vers l'autre et apparaissent décontractés, en pleine discussion. C'est la taille du monument et sa beauté qui rendent cette photo impressionante.">
                    </div>
                    <div id="couple">
                        <p>Organisons une petite escapade dans un lieu magique pour un moment tout doux avec votre moitié. Au cours d’une séance orchestrée par mes soins, vous vous retrouverez pour partager vos émotions. Je vous guiderai pas-à-pas et si vous êtes suffisamment à l’aise, c’est vous qui mènerez la danse !</p>
                        <img class="avis" src="img/etoiles.png" alt="Notation 5 étoiles">
                        <p class="avis">“Robin est une personne très agréable, qui sait se faire discret pour capter les meilleurs moments. Vous pouvez lui faire confiance les yeux fermés.
                        <br>Nous avons également fait une séance d’engagement avec lui au préalable et nous étions très contents”</p>
                        <p>Danaé & Jorrys</p> 
                    </div>
                </div>
            </section>

            <section>
            <!-- carrousel -->
            </section>
            <script>
                const burgerIndex = document.getElementById("burger-index"); 
                const menuIndex = document.querySelector("#menu-index"); 

                burgerIndex.addEventListener("click", ()=> {
                    menuIndex.classList.toggle("active"); 
                });
            </script>
        </main>

<?php 
    include_once "./footer.html";
?>