// MENU BURGER 


const burger = document.querySelector("#burger"); 
const menu = document.querySelector("#menu"); 

burger.addEventListener("click", fonctionBurger);
function fonctionBurger() { 
    menu.classList.toggle("active"); // ajouter la classe "active" à la div quand l'icône burger est cliquée
}



// AFFICHER LA FICHE SHOOTING CORRESPONDANTE SI UN PRÉNOM EST CLIQUÉ 

/* var hiddenFiche = document.querySelector("#hidden-fiche"); 

var ligneClient = document.querySelectorAll("ligne-client"); 
var fetchId = document.getElementById("fetch-id").value; 
console.log(ligneClient.length);

Object.keys(ligneClient).forEach( key => incrementId);

function incrementId() {

    var id = parseInt(fetchId); 
    var clickFiche = document.getElementById(id);
    id += 1; 
    clickFiche.addEventListener("click", showFiche, false); 

    function showFiche() { 
        hiddenFiche.style.display = "flex";
    }
} */ 

// ! A TESTER !

 

//TODO : modifier et supprimer les catégories dans gestion-categories