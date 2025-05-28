

/* Insertion of data in "Utilisateur" table */
INSERT INTO Utilisateur (loginUtil, mailUtil, pwdUtil)
VALUES
('test','test@test.fr','$2y$10$UEkpj.YPgxRylo4rP/tOHO16DBpAsNrCSbUa1.sOkx9zqVzQZJ8L.'); /* type "test" as password if u want to login with this user */

/* Insertion of data in "Produit" table */
INSERT INTO Produit (libProduit, prixProHT)
VALUES 
('Pizza Margherita', 8.50),
('Burger Classic', 7.20),
('Salade César', 6.80),
('Sushi Saumon', 12.00),
('Tacos Poulet', 5.50),
('Spaghetti Bolognese', 9.30),
('Lasagne Végétarienne', 8.00),
('Poulet Rôti', 10.50),
('Frites Maison', 3.00),
('Tarte aux Pommes', 4.50);

/* Insertion of data in "Commande" table */
INSERT INTO Commande (etatCom, totalComTTC, typeCom, dateCom, heureCom, idUtil)
VALUES 
(0, 35.50, 'Sur place', '2024-10-03', '12:30:00', 1),
(3, 20.00, 'Livraison', '2024-10-03', '13:15:00', 1),
(0, 42.80, 'Sur place', '2024-10-02', '14:00:00', 1),
(2, 15.50, 'À emporter', '2024-10-01', '11:45:00', 1),
(3, 65.00, 'Livraison', '2024-10-03', '15:30:00', 1);

/* Insertion of data in "ligneCommandes" table */
INSERT INTO ligneCommandes (idCom, idProduit, qteLigne, totalLigneHT)
VALUES
(1, 1, 2, 17.00),  -- 2x Pizza Margherita dans la commande 1
(1, 3, 1, 6.80),   -- 1x Salade César dans la commande 1
(2, 1, 1, 8.50),   -- 1x Pizza Margherita dans la commande 2
(2, 4, 2, 24.00),  -- 2x Sushi Saumon dans la commande 2
(3, 1, 3, 25.50),  -- 3x Pizza Margherita dans la commande 3
(3, 2, 2, 14.40),  -- 2x Burger Classic dans la commande 3
(4, 9, 1, 3.00),   -- 1x Frites Maison dans la commande 4
(4, 5, 1, 5.50),   -- 1x Tacos Poulet dans la commande 4
(5, 1, 1, 8.50),   -- 1x Pizza Margherita dans la commande 5
(5, 6, 2, 18.60);  -- 2x Spaghetti Bolognese dans la commande 5
