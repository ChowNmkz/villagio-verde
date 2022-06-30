# Village Green

## Fournisseurs
    - Identifiant du fournisseur (Compteur NOT NULL)
    - Nom du fournisseur (Varchar(25))
    - Adresse du fournisseur (Varchar(255))
    - Code postal du fournisseur (Varchar(5))
    - Ville du fournisseur (Varchar(25))
    - Téléphone du fournisseur (Int(10))
    - Mail du fournisseur (Varchar(255))
    - Type du fournisseur [Constructeur/Importateur] (Boolean)

## Client
    - Identifiant client (Compteur NOT NULL)
    - Nom du client (Varchar(25))
    - Prénom du client (Varchar(25))
    - Adresse du client (Varchar(255))
    - Code postal du client (Varchar(5))
    - Ville du client (Varchar(25))
    - Téléphone du client (Int(10))
    - Mail du client (Varchar(255))
    - Adresse de livraison du client (Varchar(255))
    - Code postal de livraison du client (Varchar(5))
    - Ville de livraison du client (Varchar(25))
    - Type de client [Particulier/Professionnel] (Boolean)

## Service Commercial 
    - Identifiant de l'employé (Compteur NOT NULL)
    - Nom de l'employé (Varchar(25))
    - Prénom de l'employé (Varchar(25))
    - Téléphone de l'employé (Int(10))
    - Mail de l'employé (Varchar(255))

## Catalogue produit
    - Identifiant du produit (Compteur NOT NULL)
    - Référence produit (Varchar(6))
    - Libéllé court (Varchar(25))
    - Libéllé long (Varchar(255))
    - Prix de vente (Float(8,2))
    - Prix d'achat (Float(8,2))
    - Photo (Varchar(255))
    - Stock physique (Int)
    - Stock d'alerte (Int)

## Commande 
    - Identifiant de la commande (Compteur NOT NULL)
    - Date de la commande (Date)
    - Etat de la commande (Varchar(15))
    - Prix total de la commande (Float (11,2))

## Ligne de commande
    - Identifiant ligne de commande (Compteur NOT NULL)
    - Quantité commandé (Int)
    - Prix unitaire du produit commandé (Float (8,2))

## Livraison 
    - Identifiant de livraison (Compteur NOT NULL)
    - Date d'expédition (Date)
    - Date de livraison (Date)
    - (Quantité livré ?) (Int)
    - (Reliquat livraison ?) (Int)

## Facturation
    - Identifiant de facturation (Compteur NOT NULL)
    - Réduction (Float(5,2))
    - Réduction supplémentaire (Float(5,2))
    - Date de facturation (Date)
    - Montant total facture (Float(11,2))
    - Etat de la facture [Payé/Impayé] (Boolean)
    - Type de paiement [Comptant/Différé] (Boolean)

## Catégorie
    - Identifiant de catégorie (Compteur NOT NULL)
    - Nom de catégorie (Varchar(25))

## Sous-catégorie
    - Identifiant de sous-catégorie (Compteur NOT NULL)
    - Nom de sous-catégorie (Varchar(25))