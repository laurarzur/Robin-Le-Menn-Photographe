const ligneClient = document.querySelectorAll(".ligne-client"); // lignes du tableau 
const hiddenFiche = document.getElementById("hidden-fiche"); // fiche client 
const getId = document.querySelector("#get-id"); // value du hidden input 

ligneClient.forEach((ligne) => { 
    ligne.addEventListener("click", function (event) { 
        event.preventDefault(); // empêcher de traiter le "#" comme un lien
        const clientId = ligne.getAttribute("id"); //récupérer l'id client

        $.ajax({
            type: "POST", 
            url: "./api/show-couple.php", 
            data: { clientId: clientId}, 
            success: function(response) {

                hiddenFiche.innerHTML = "";
                
                console.log(response);

                let client = JSON.parse(response);

                const h2 = document.createElement("h2");
                h2.innerText = "Séance de " + client.prenom1;
                if (client.prenom2 != "") {
                    h2.innerText += " et " + client.prenom2;
                }
                hiddenFiche.appendChild(h2)
            }
        });

        hiddenFiche.style.display = "flex"; // afficher la fiche
    });
}); 

// MODIFIER LES CATÉGORIES
const update = document.querySelectorAll(".update"); // récupérer les liens des catégories à modifier

update.forEach((categorie) => { // pour chaque lien "update"
    categorie.addEventListener("click", function () {

        const idCategorie = categorie.getAttribute("id"); // obtenir l'id de la catégorie cliquée
        const paragraph = document.querySelector(".paragraph" + idCategorie);
        const nomCategorie = paragraph.getAttribute("id"); 
        console.log(nomCategorie); 
        const form = document.querySelector(".modif" + idCategorie); 
        const label = document.createElement("label"); 
        label.for = "update"; 
        label.textContent = "Entrez le nouveau nom";
        const input = document.createElement("input"); 
        input.type = "text"; 
        input.name = "update"; 
        input.id = "update"; 
        input.value = nomCategorie;
        const valider = document.createElement("button"); 
        valider.textContent = "Valider";
        form.appendChild(label); 
        form.appendChild(input); 
        form.appendChild(valider);

       /* $.ajax({
            type: "POST", 
            url: "./api/update-cat.php", 
            data: { idCategorie : idCategorie }, 
            success: function(response) {

            }
        });*/

        document.cookie = "idCategorie = " + idCategorie; // le renvoyer à PHP 
        valider.addEventListener("click", function () {

          /*  $.ajax({
                type: "POST", 
                url: "./api/update-cat.php", 
                data: { nouveauNom : input.value }, 
                success: function(response) {

                }
            });*/
            document.cookie = "nouveauNom = " + input.value;
        });
        // fonction pour récupérer la value quand on valide
    });
}); 

//SUPPRIMER LES CATÉGORIES 

const deleteCat = document.querySelectorAll(".delete"); 
deleteCat.forEach((categorie) => { // pour chaque lien "delete"
    categorie.addEventListener("click", function () {
        const categorieId = categorie.getAttribute('id'); // obtenir l'id de la catégorie cliquée 
        if (confirm("Êtes-vous sûr de vouloir supprimer cette catégorie ?")) { 
            document.cookie = "categorieId = " + categorieId; // le renvoyer à PHP 
        }
     });
});
