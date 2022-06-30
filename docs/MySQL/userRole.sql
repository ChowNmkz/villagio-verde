-- Création des rôles 
CREATE ROLE IF NOT EXISTS 'Visiteur'@'localhost';
CREATE ROLE IF NOT EXISTS 'Client'@'localhost';
CREATE ROLE IF NOT EXISTS 'Gestion'@'localhost';
CREATE ROLE IF NOT EXISTS 'Administrateur'@'localhost';
-- Création utilisateur Visiteur
CREATE USER IF NOT EXISTS 'vis1'@'localhost' IDENTIFIED BY 'vis1';
CREATE USER IF NOT EXISTS 'vis2'@'localhost' IDENTIFIED BY 'vis2';
-- Création utilisateur Client
CREATE USER IF NOT EXISTS 'cli1'@'localhost' IDENTIFIED BY 'cli1';
CREATE USER IF NOT EXISTS 'cli2'@'localhost' IDENTIFIED BY 'cli2';
-- Création utilisateur Gestionnaire
CREATE USER IF NOT EXISTS 'gest'@'localhost' IDENTIFIED BY 'gest';
-- Création utilisateur Administrateur
CREATE USER IF NOT EXISTS 'admin'@'localhost' IDENTIFIED BY 'admin';
-- Privilége des visiteurs
GRANT SELECT ON villagegreen.products
TO 'Visiteur'@'localhost';
-- Privilége en vue des Client
GRANT SELECT ON villagegreen.*
TO 'Client'@'localhost';
-- Privilége en écriture sur certaines tables des clients
GRANT INSERT, UPDATE ON villagegreen.orders, villagegreen.customers
TO 'Client'@'localhost';
-- Privilége des gestionnaires
GRANT SELECT, INSERT, UPDATE ON villagegreen.*
TO 'Gestion'@'localhost';
-- Privilége des admins
GRANT SELECT, INSERT, UPDATE, CREATE, DROP ON villagegreen.*
TO 'Administrateur'@'localhost';
-- Attribution des rôles aux utilisateurs
GRANT Visiteur TO 'vis1'@'localhost', 'vis2'@'localhost';
GRANT Client TO 'cli1'@'localhost', 'cli2'@'localhost';
GRANT Gestion TO 'gest'@'localhost';
GRANT Administrateur TO 'admin'@'localhost';
