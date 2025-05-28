-- Création de la base de données
CREATE DATABASE IF NOT EXISTS `restoweb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `restoweb`;

-- ------------------------------------------------------------------- --

-- Structure de la base de données

-- Table Utilisateur
DROP TABLE IF EXISTS `Utilisateur`;
CREATE TABLE Utilisateur (
    idUtil INT AUTO_INCREMENT PRIMARY KEY,
    loginUtil VARCHAR(50) NOT NULL,
    mailUtil VARCHAR(50) NOT NULL,
    pwdUtil VARCHAR(250) NOT NULL
);

-- Table Commande
DROP TABLE IF EXISTS `Commande`;
CREATE TABLE Commande (
    idCom INT AUTO_INCREMENT PRIMARY KEY,
    etatCom INT NOT NULL,
    totalComTTC DECIMAL(15,2) NOT NULL,
    typeCom VARCHAR(50) NOT NULL,
    dateCom DATE NOT NULL,
    heureCom TIME NOT NULL,
    idUtil INT,
    FOREIGN KEY (idUtil) REFERENCES Utilisateur(idUtil)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

-- Table Produit
DROP TABLE IF EXISTS `Produit`;
CREATE TABLE Produit (
    idProduit INT AUTO_INCREMENT PRIMARY KEY,
    libProduit VARCHAR(50) NOT NULL,
    prixProHT DECIMAL(15,2) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

-- Table ligneCommandes
DROP TABLE IF EXISTS `ligneCommandes`;
CREATE TABLE ligneCommandes (
    idCom INT,
    idProduit INT,
    qteLigne INT NOT NULL,
    totalLigneHT DECIMAL(15,2) NOT NULL,
    PRIMARY KEY (idCom, idProduit),
    FOREIGN KEY (idCom) REFERENCES Commande(idCom),
    FOREIGN KEY (idProduit) REFERENCES Produit(idProduit)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
