// Redirection de la page lost.php
function pageLostRedirection() {
  if (document.body.id === "lost-page") {
    setTimeout(() => {
      window.location.href = "/";
    }, 5000);
  }
}

// Affichage d'une excuse au chargement de la page home.php
async function excuseInitiale() {
  const excuseDisplay = document.getElementById("excuseDisplay");
  const loader = document.getElementById("loader");
  const loadExcuseButton = document.getElementById("excuses");

  loader.style.display = "block";
  excuseDisplay.style.display = "none";
  loadExcuseButton.style.display = "none";

  const delai = Math.floor(Math.random() * 3000) + 1000;
  await new Promise(resolve => setTimeout(resolve, delai));

  console.log(`Delai de l'affichage au chargement : ${delai}ms`);


  try {
    const response = await fetch(
      "index.php?controller=apiExcuses&action=getExcuses"
    );

    if (!response.ok) {
      throw new Error("Réponse HTTP non valide");
    }

    const typeContenue = response.headers.get("Content-Type") || "";
    if (!typeContenue.includes("application/json")) {
      throw new Error("La réponse du serveur n'est pas du JSON.");
    }

    const data = await response.json();
    const dataExcuse = data.excuse;

    if (dataExcuse && dataExcuse.message) {
      excuseDisplay.textContent = dataExcuse.message;
    } else {
      excuseDisplay.textContent = "Aucune excuse disponible.";
    }
    
  } catch (error) {
    console.error(error);
    excuseDisplay.textContent = "Erreur lors du chargement de l'excuse.";
  }

  excuseDisplay.style.display = "block";
  loadExcuseButton.style.display = "inline-block";
  loader.style.display = "none";
}


// Affichage d'une nouvelle excuse
async function displayNewExcuse() {
  const excuseDisplay = document.getElementById("excuseDisplay");
  const loader = document.getElementById("loader");
  const loadExcuseButton = document.getElementById("excuses");

  loadExcuseButton.disabled = true;
  loader.style.display = "block";
  excuseDisplay.style.display = "none";
  loadExcuseButton.style.display = "none";

  const delai = Math.floor(Math.random() * 4000) + 1000;
  await new Promise(resolve => setTimeout(resolve, delai));

  console.log(`Delai du chargement de la nouvelle excuse : ${delai}ms`);

  try {
    const response = await fetch(
      "index.php?controller=apiExcuses&action=getExcuses"
    );

    if (!response.ok) {
      throw new Error("Réponse HTTP non valide");
    }

    const data = await response.json();
    const dataExcuse = data.excuse;

    if (dataExcuse && dataExcuse.message) {
      excuseDisplay.textContent = dataExcuse.message;
    } else {
      excuseDisplay.textContent = "Erreur : aucune excuse trouvée.";
    }
    
    excuseDisplay.classList.add("flash");
    setTimeout(() => {
      excuseDisplay.classList.remove("flash");
    }, 500);

  } catch (error) {
    excuseDisplay.textContent = "Erreur réseau ou serveur";
    console.error("Erreur : ", error);
  }

  excuseDisplay.style.display = "block";
  loadExcuseButton.style.display = "inline-block";
  loader.style.display = "none";
  loadExcuseButton.disabled = false;
}


// Ajout d'excuses dans le fichier excuse.json
function setupAddExcuses() {
  const addExcusesForm = document.getElementById('addExcusesForm');

  addExcusesForm.addEventListener('submit', async (e) => {
  e.preventDefault();

  const http_code = document.getElementById('http_code').value;
  const tag = document.getElementById('tag').value;
  const message = document.getElementById('message').value;

  if (!http_code || !tag.trim() || !message.trim()){
    alert("Tous les champs doivent être renseignés.");
    return;
  }

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

    if (!response.ok) {
      throw new Error(result.error || 'Une erreur est survenue');
    }

    alert('Excuse ajoutée avec succès !');
    addExcusesForm.reset();

    const modalElement = document.getElementById('excuseModal');
    const modal = bootstrap.Modal.getInstance(modalElement);

    modalElement.addEventListener('hidden.bs.modal', function gererMasque() {
      document.getElementById("excuses").focus();
      modalElement.removeEventListener('hidden.bs.modal', gererMasque);
    });

    document.activeElement.blur();
    modal.hide();

    } catch (error) {
      console.error('Erreur :', error);
      alert('Échec de l’ajout : ' + error.message);
    }
  });

}

document.addEventListener("DOMContentLoaded", function () {
  pageLostRedirection();

  const title = document.getElementById("titreHome");

  excuseInitiale();

  const generateButton = document.getElementById("excuses");

  setTimeout(() => {
    title.classList.add("visible");
  }, 100);

  setTimeout(() => {
    title.classList.add("move-up");
    generateButton.classList.add("visible");
  }, 2000);

  generateButton.addEventListener("click", displayNewExcuse);

  setupAddExcuses();
});
