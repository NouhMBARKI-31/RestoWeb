DELIMITER |

CREATE TRIGGER `after_ligne_update` AFTER UPDATE ON `lignecommandes`
 FOR EACH ROW BEGIN
    DECLARE v_total_HT DECIMAL(10, 2);
    DECLARE v_tva DECIMAL(10, 3);
    DECLARE v_total_TTC DECIMAL(10, 2);
    declare v_typecom varchar(50);
    
    -- Calcule la somme des totaux ligne HT pour la commande liée
    SELECT SUM(totalLigneHT) INTO v_total_HT
    FROM lignecommandes
    WHERE idCom = NEW.idCom;
    
    Select typeCom into v_typecom 
    from commande
    WHERE idCom = NEW.idCom;
    
      IF v_typecom = 'Sur place' THEN
        SET v_tva = v_total_HT* 0.1;
        SET v_total_TTC = v_total_HT + v_tva;
    ELSE
        SET v_tva = v_total_HT * 0.055;
        SET v_total_TTC = v_total_HT + v_tva;
    END IF;

    -- Met à jour le total commande TTC dans la table commande
    UPDATE commande
    SET totalComTTC = v_total_TTC
    WHERE idCom = NEW.idCom;
END |
