// Redirection de la page lost.php
function pageLostRedirection() {
  if (document.body.id === "lost-page") {
    setTimeout(function () {
      window.location.href = "/";
    }, 5000);
  }
}

document.addEventListener("DOMContentLoaded", function () {
  pageLostRedirection();

  // Affichage des excuses sur la page home.php
  const loadExcuseButton = document.getElementById("excuses");
  const excuseDisplay = document.getElementById("excuseDisplay");

  loadExcuseButton.addEventListener("click", async () => {
    try {
      const response = await fetch(
        "index.php?controller=apiExcuses&action=getExcuses"
      );

      if (!response.ok) {
        throw new Error("Réponse HTTP non valide");
      }

      const data = await response.json();
      const dataExcuse = data.excuse;
      
      excuseDisplay.classList.add("flash");
      setTimeout(() => {
        
        if (dataExcuse && dataExcuse.message && dataExcuse.tag) {
        excuseDisplay.textContent = `http_code : ${dataExcuse.http_code}, tag : ${dataExcuse.tag}, message : ${dataExcuse.message}`;
      } else if (dataExcuse && dataExcuse.message) {
        excuseDisplay.textContent = dataExcuse.message;
      } else {
        excuseDisplay.textContent = "Erreur : aucune excuse trouvée";
      }

      excuseDisplay.classList.remove("flash");
    }, 100);

      
    } catch (error) {
      excuseDisplay.textContent = "Erreur réseau ou serveur";
      console.error("Erreur : ", error);
    }
  });
});
