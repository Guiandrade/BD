"R.I com Trigger"
 
/*
Notas:

Provar -> Todo o valor de contador sequencia existente na relação sequencia existe numa
e uma vez no universo das relações tipo registo, pagina, campo, registo e valor.

Campo idseq no tipo_registo,registo,pagina,campo e valor.

VERIFICAR SE NÃO PODEMOS CRIAR UMA STORED PROCEDURE PARA NÃO REPETIR TANTO CÓDIGO (se houver tempo)

*/

# TRIGGERS PAGINA


delimiter //
CREATE TRIGGER pagina_before_insert BEFORE INSERT ON pagina 
FOR EACH ROW
BEGIN
INSERT INTO sequencia (moment,userid)
VALUES (NOW(),NEW.userid);
SET NEW.idseq= LAST_INSERT_ID(); 
END; //
delimiter ;

delimiter //
CREATE TRIGGER pagina_before_update BEFORE UPDATE ON pagina 
FOR EACH ROW
BEGIN
UPDATE sequencia 
SET moment=NOW() WHERE idseq=OLD.idseq();
SET idseq= OLD.idseq(); 
END; //
delimiter ;

#FIM TRIGGERS PAGINA

# TRIGGERS TIPO_REGISTO
delimiter //
CREATE TRIGGER tipo_registo_before_insert BEFORE INSERT ON tipo_registo
FOR EACH ROW
BEGIN
INSERT INTO sequencia (moment,userid)
VALUES (NOW(),NEW.userid);
SET NEW.idseq= LAST_INSERT_ID(); 
END; //
delimiter ;

delimiter //
CREATE TRIGGER tipo_registo_before_update BEFORE UPDATE ON tipo_registo 
FOR EACH ROW
BEGIN
UPDATE sequencia 
SET moment=NOW() WHERE idseq=OLD.idseq();
SET idseq= OLD.idseq(); 
END; //
delimiter ;

#FIM TRIGGERS TIPO_REGISTO

# TRIGGERS REGISTO

delimiter //
CREATE TRIGGER registo_before_insert BEFORE INSERT ON registo
FOR EACH ROW
BEGIN
INSERT INTO sequencia (moment,userid)
VALUES (NOW(),NEW.userid);
SET NEW.idseq= LAST_INSERT_ID(); 
END; //
delimiter ;

delimiter //
CREATE TRIGGER registo_before_update BEFORE UPDATE ON registo 
FOR EACH ROW
BEGIN
UPDATE sequencia 
SET moment=NOW() WHERE idseq=OLD.idseq();
SET idseq= OLD.idseq(); 
END; //
delimiter ;

# FIM TRIGGERS REGISTO

# TRIGGERS CAMPO

delimiter //
CREATE TRIGGER campo_before_insert BEFORE INSERT ON campo
FOR EACH ROW
BEGIN
INSERT INTO sequencia (moment,userid)
VALUES (NOW(),NEW.userid);
SET NEW.idseq= LAST_INSERT_ID(); 
END; //
delimiter ;

delimiter //
CREATE TRIGGER campo_before_update BEFORE UPDATE ON campo 
FOR EACH ROW
BEGIN
UPDATE sequencia 
SET moment=NOW() WHERE idseq=OLD.idseq();
SET idseq= OLD.idseq(); 
END; //
delimiter ;

#FIM TRIGGERS CAMPO

# TRIGGERS VALOR

delimiter //
CREATE TRIGGER valor_before_insert BEFORE INSERT ON valor
FOR EACH ROW
BEGIN
INSERT INTO sequencia (moment,userid)
VALUES (NOW(),NEW.userid);
SET NEW.idseq= LAST_INSERT_ID(); 
END; //
delimiter ;

delimiter //
CREATE TRIGGER valor_before_update BEFORE UPDATE ON valor 
FOR EACH ROW
BEGIN
UPDATE sequencia 
SET moment=NOW() WHERE idseq=OLD.idseq();
SET idseq= OLD.idseq(); 
END; //
delimiter ;

# FIM TRIGGERS VALOR

# TESTES

# PAGINA
INSERT INTO pagina (userid, pagecounter, nome, idseq, ativa) VALUES (1556, 9999, "Nike Running Portugal - BVU_PS", 151489, true);
UPDATE pagina SET idseq=151489 WHERE pagecounter=1556 AND userid=1556;
