
<div id="top"></div>
<!-- EN TETE PROJET -->
<br />
<div align="center">
  <!--<a href="">
    <img src="public/img/logo.jpg" alt="Logo" width="80" height="80">
  </a>-->

  <h3 align="center">Villagio Verde</h3>

  <p align="center">
   Un site e-commerce d'instrument de musique!
  </p>
</div>



<!-- TABLE DES MATIERES -->
<details>
  <summary>Table des matiéres</summary>
  <ol>
    <li>
      <a href="#a-propos">A propos</a>
      <ul>
        <li><a href="#technologies">Technologies</a></li>
      </ul>
    </li>
    <li>
      <a href="#demarrer-le-projet">Demarrer le projet</a>
      <ul>
        <li><a href="#prerequis">Pré-requis</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#roadmap">Roadmap</a></li>
  </ol>
</details>



<!-- A PROPOS DU PROJET -->
## A propos

<!--[![Product Name Screen Shot][product-screenshot]](https://example.com)-->

Projet à réaliser durant ma formation sur le Campus de l'AFPA. 

La mise en situation est la suivante : 

> L’entreprise Village Green distribue du matériel musical. Elle a une activité de grossiste, c'est-à-dire de revente aux magasins spécialisés. Elle peut sous certaines conditions procéder à la vente aux particuliers et elle souhaiterait développer cette activité.
>
> L’entreprise Village Green souhaite faire évoluer son système de gestion des commandes et de facturation. Actuellement, l’organisation utilise un système qui ne donne pas entière satisfaction. L’informatisation de la totalité du processus depuis la mise à jour du catalogue, de la commande jusqu’au paiement, a pour objectif de fluidifier le workflow de l’entreprise.
>
> La société souhaite avoir un site d'e-commerce permettant aux clients de visualiser l'ensemble du catalogue et de passer des commandes en ligne.


<p align="right">(<a href="#top">back to top</a>)</p>



### Technologies

Les différentes technologies utilisé sur ce projet sont les suivantes : 

* [Symfony](https://symfony.com)
* [Bootstrap](https://getbootstrap.com)


<p align="right">(<a href="#top">back to top</a>)</p>



<!-- GETTING STARTED -->
## Demarrer le projet

Afin de démarrer le projet, veuillez suivre les instructions suivantes : 

### Prerequis

Vous devez avoir :
* une version récente de Node.js (npm)
* un systéme de gestion de base de données (MySQL/MariaDB)
* la version 8.1 de PHP

### Installation

_Si tout les prérequis sont effectif, vous pouvez suivre les instructions suivantes :_
 
1. Cloner le repo GitHub
   ```
   git clone https://github.com/ChowNmkz/villagio-verde
   ```
2. Modifier le .env du projet Symfony afin de rentrer les informations lié à votre account MySQL/MariaDB
   ```
   DATABASE_URL="mysql://VOTRE_USER_ACCOUNT:VOTRE_MDP_ACCOUNT@127.0.0.1:3306/villagio_verde?serverVersion=5.7&charset=utf8mb4"
   ```
4. Installer les dépendances (Composer) du projet
   ```
   composer install
   ```
5. Installer les dépendances de Node.js
   ```
   npm install
   ```
6. Executer npm pour compiler le code CSS & JS
   ```
   npm run dev
   ```


<p align="right">(<a href="#top">back to top</a>)</p>


<!-- ROADMAP -->
## Roadmap

- [x] Systéme de navigation par catégorie
- [x] Systéme de panier (avec persistance en BDD)
- [ ] Authentification & connexion des utilisateurs
- [ ] Systéme de gestion des produits via une page administrateur
- [ ] Création de l'API via API Platform

<p align="right">(<a href="#top">back to top</a>)</p>


