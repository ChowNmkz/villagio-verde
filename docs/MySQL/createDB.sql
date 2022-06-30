DROP DATABASE IF EXISTS villagegreen;
CREATE DATABASE IF NOT EXISTS villagegreen;
USE villagegreen;

DROP TABLE IF EXISTS fournisseur;
CREATE TABLE IF EXISTS fournisseur(
    fournisseur_id INT NOT NULL AUTO_INCREMENT,
    fournisseur_nom VARCHAR(25),
    fournisseur_addresse VARCHAR(255),
    fournisseur_codepostal VARCHAR(5),
    fournisseur_ville VARCHAR(25),
    fournisseur_telephone VARCHAR(10),
    fournisseur_email VARCHAR(255),
    fournisseur_type TYNYINT(1),
    PRIMARY KEY(fournisseur_id)
);

DROP TABLE IF EXISTS employe;
CREATE TABLE IF EXISTS employe(
    employe_id INT NOT NULL AUTO_INCREMENT,
    employe_prenom VARCHAR(25),
    employe_nom VARCHAR(25),
    employe_telephone VARCHAR(10),
    employe_email VARCHAR(255),
    employe_departement VARCHAR(25),
    PRIMARY KEY(employe_id)
);

DROP TABLE IF EXISTS categorie;
CREATE TABLE IF EXISTS categorie(
    categorie_id INT NOT NULL AUTO_INCREMENT,
    categorie_nom VARCHAR(25),
    PRIMARY KEY(categorie_id)
);

DROP TABLE IF EXISTS souscategorie;
CREATE TABLE IF EXISTS souscategorie(
    souscategorie_id INT NOT NULL AUTO_INCREMENT,
    souscategorie_nom VARCHAR(50),
    categorie_id INT NOT NULL,
    PRIMARY KEY(souscategorie_id),
    FOREIGN KEY(categorie_id) REFERENCES categorie(categorie_id)
);

DROP TABLE IF EXISTS produit;
CREATE TABLE IF EXISTS produit(
    produit_id INT NOT NULL AUTO_INCREMENT,
    produit_reference VARCHAR(6),
    produit_libelle_court VARCHAR(25),
    produit_libelle_long VARCHAR(255),
    produit_prix_vente DECIMAL(8,2),
    produit_prix_achat DECIMAL(8,2),
    produit_image VARCHAR(255),
    produit_stock_physique INT,
    produit_stock_alerte INT,
    souscategorie_id INT NOT NULL,
    fournisseur_id INT NOT NULL,
    PRIMARY KEY(produit_id),
    FOREIGN KEY(souscategorie_id) REFERENCES souscategorie(souscategorie_id),
    FOREIGN KEY(fournisseur_id) REFERENCES fournisseur(fournisseur_i

DROP TABLE IF EXISTS employe;
CREATE TABLE IF EXISTS client(
    client_id INT NOT NULL AUTO_INCREMENT,
    client_prenom VARCHAR(25),
    client_nom VARCHAR(25),
    client_adresse VARCHAR(255),
    client_codepostal VARCHAR(5),
    client_ville VARCHAR(25),
    client_telephone INT,
    client_email VARCHAR(255),
    client_adresse_livraison VARCHAR(255),
    client_codepostal_livraison VARCHAR(5),
    client_ville_livraison VARCHAR(25),
    client_type LOGICAL,
    client_reduction DECIMAL(5,2),
    employe_id INT NOT NULL,
    PRIMARY KEY(client_id),
    FOREIGN KEY(employe_id) REFERENCES employe(employe_id)
);

DROP TABLE IF EXISTS commande;
CREATE TABLE IF EXISTS commande(
    commande_id INT NOT NULL AUTO_INCREMENT,
    commande_date DATE,
    commande_statut VARCHAR(15),
    commande_total DECIMAL(11,2),
    client_id INT NOT NULL,
    PRIMARY KEY(commande_id),
    FOREIGN KEY(client_id) REFERENCES client(client_id)
);

DROP TABLE IF EXISTS livraison;
    CREATE TABLE IF EXISTS livraison(
    livraison_id INT NOT NULL AUTO_INCREMENT,
    livraison_date_expedition DATE,
    livraison_date_livraison DATE,
    livraison_adresse VARCHAR(255),
    livraison_codepostal VARCHAR(5),
    livraison_ville VARCHAR(25),
    commande_id INT NOT NULL,
    PRIMARY KEY(livraison_id),
    FOREIGN KEY(commande_id) REFERENCES commande(commande_id)
);

DROP TABLE IF EXISTS facture;
CREATE TABLE IF EXISTS facture(
    facture_id INT NOT NULL AUTO_INCREMENT,
    facture_reduction DECIMAL(5,2),
    facture_reduction_supplementaire DECIMAL(5,2),
    facture_date DATE,
    facture_total DECIMAL(11,2),
    facture_statut LOGICAL,
    facture_paiement_type LOGICAL,
    facture_adresse VARCHAR(255),
    facture_codepostal VARCHAR(5),
    facture_ville VARCHAR(25),
    commande_id INT NOT NULL,
    PRIMARY KEY(facture_id),
    FOREIGN KEY(commande_id) REFERENCES commande(commande_id)
);

DROP TABLE IF EXISTS Composer;
CREATE TABLE IF EXISTS Composer(
    produit_id INT,
    commande_id INT,
    livraison_id INT,
    detailcommande_quantite INT,
    detailcommande_prix_unitaire VARCHAR(50),
    detailcommande_reste_livrer INT,
    detailcommande_quantite_expedier VARCHAR(50),
    PRIMARY KEY(produit_id, commande_id, livraison_id),
    FOREIGN KEY(produit_id) REFERENCES produit(produit_id),
    FOREIGN KEY(commande_id) REFERENCES commande(commande_id),
    FOREIGN KEY(livraison_id) REFERENCES livraison(livraison_id)
);