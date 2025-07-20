// Redirection de la page lost.php
function pageLostRedirection() {
    if (document.body.id === 'lost-page') {
        
        setTimeout(function () {
          window.location.href = "/";
        }, 5000);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    pageLostRedirection();  
    
    // Affichage des excuses sur la page home.php
    const excuseButton = document.getElementById("excuses");
    const inputExcuse = document.getElementById("inputExcuse");
    
    excuseButton.addEventListener("click", async() => {
        try {
            const response = await fetch("index.php?controller=apiExcuses&action=getExcuses");
            const data = await response.json();
    
            if (data.excuse) {
                inputExcuse.value = data.excuse;
            } else {
                inputExcuse.value = "Erreur : aucune excuse trouvée";
            }
    
        } catch (error) {
            inputExcuse.value = "Erreur réseau ou serveur";
            console.error("Erreur : ", error);
        }
    
    });
});

