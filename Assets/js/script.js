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

  const addExcusesForm = document.getElementById('addExcusesForm');

  addExcusesForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const http_code = document.getElementById('http_code').value;
    const tag = document.getElementById('tag').value;
    const message = document.getElementById('message').value;

    try {
      const response = await fetch(`index.php?controller=apiExcuses&action=addExcuses`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          http_code: parseInt(http_code),
          tag: tag.trim(),
          message: message.trim()
        })
      });

      const result = await response.json();
      console.log('Réponse du serveur :', result);

      if (!response.ok) {
        throw new Error(result.error || 'Une erreur est survenue');
      }

      alert('Excuse ajoutée avec succès !');
      addExcusesForm.reset();
      const modal = bootstrap.Modal.getInstance(document.getElementById('excuseModal'));
      modal.hide();
      
    } catch (error) {
      console.error('Erreur :', error);
      alert('Échec de l’ajout : ' + error.message);
    }
  });
});
