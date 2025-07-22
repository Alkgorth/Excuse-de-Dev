# Excuse-de-Dev

Projet de test pour l'affichage d'excuses.

**Excuse-de-Dev** est une application web ludique qui génère aléatoirement des excuses de développeur, pour faire patienter les utilisateurs pendant qu'un bug est corrigé (ou pas 😅).

---

## Fonctionnalités

- Génération aléatoire d’excuses humoristiques.
- Interface responsive avec animation d’apparition.
- Ajout dynamique de nouvelles excuses via une modale.
- Affichage d’une excuse personnalisée selon le code HTTP dans `/404`, `/500`, etc.
- Page `/lost` avec redirection automatique vers l’accueil.
- Effets de transition soignés à l’ouverture de la page.

## Prérequis

Avant de commencer, assurez-vous d'avoir installé tous les éléments suivants sur votre système :

 - [Docker](https://www.docker.com/).
 - Un navigateur moderne (Chrome, Firefox, etc.).

## Installation

Pour l'installation en local du projet, veuillez suivre ces étapes.

### Clone du dépôt

En utilisant une invite de commandes ou GitBash, lancez la commande ci-dessous afin de copier le dépôt distant en local :
```bash
git clone https://github.com/Alkgorth/Excuse-de-Dev.git
cd Excuse-de-dev
```
### Création des conteneurs

Via le shell ou directement dans le terminal de votre IDE après avoir ouvert le projet. Entrez la commande :
```
docker-compose up -d --build
```
Pour lancer la construction et démarrer les différents services nécessaires (accessible par défaut sur le port **8080**).

### Accéder à l'application

Ouvrez votre navigateur à l'adresse suivante :
👉 http://localhost:8080

## Structure du projet

```
Excuse-de-Dev/
├── App/
│   ├── Controller/
│       ├── ApiExcusesController.php
│       ├── Controller.php
│       ├── HomeController.php
├── Assets/
│   ├── css/
│       ├── style.css
│   ├── data
│       ├── excuses.json
│   ├── js/
│       ├── script.js
├── templates/
│   ├── errors/
│       ├── 404.php
│       ├── http_code.php
│   ├── pages/
│       ├── home.php
│       ├── lost.php
│   ├── head.php
│   ├── footer.php
├── .htaccess
├── docker-compose.yml
├── Dockerfile
├── index.php
└── README.md
```

## Utilisation

### Générer une excuse

Sur la page d'accueil, cliquez sur **"Générer une nouvelle excuse"** pour afficher une nouvelle phrase aléatoire.

### Ajouter une excuse

Cliquez sur le bouton **"Ajouter une nouvelle excuse de dev"**, remplissez les champs et validez pour apporter votre contribution à la liste d'excuses.

### Routes personnalisées

- /235, /722, etc. : affiche une excuse correspondant au code HTTP.
- /lost : page d'erreur avec redirection automatique.

## Développement

Le projet est codé en **PHP natif** avec une structure **MVC**, sans framework, pour des raisons pédagogiques.
L'affichage dynamique repose sur du **JavaScript**, **Fetch API**, **Bootstrap** et un fichier **JSON**.

## Contribuer

Les contributions sont les bienvenues !
Proposez une pull request ou ouvrez une issue.

1. Avant de proposer du code :

2. Forkez le dépôt.

3. Créez une branche.

4. Ajoutez vos modifications.

5. Testez.

6. Ouvrez une pull request.

## License

[MIT](https://choosealicense.com/licenses/mit/)