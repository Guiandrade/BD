"R.I com Trigger"
 
/*
Notas:

Provar -> Todo o valor de contador sequencia existente na relação sequencia existe numa
e uma vez no universo das relações tipo registo, pagina, campo, registo e valor.

Campo idseq no tipo_registo,registo,pagina,campo e valor.

Fazer um Trigger para cada tabela que verifica que o numero posto não existe em nenhuma das tabelas (No Insert e no Update)

VERIFICAR SE NÃO PODEMOS CRIAR UMA STORED PROCEDURE PARA NÃO REPETIR TANTO CÓDIGO

*/

#REALIZAR DOIS TRIGGERS PARA CADA TABELA SEGUINDO ESTES EXEMPLOS:

delimiter //
CREATE TRIGGER pagina_before_insert BEFORE INSERT ON pagina 
FOR EACH ROW
BEGIN
IF EXISTS ( SELECT p.idseq FROM pagina p,tipo_registo tr,registo r,campo c,valor v
WHERE (NEW.idseq=p.idseq OR NEW.idseq=tr.idseq OR NEW.idseq=r.idseq OR NEW.idseq=c.idseq OR NEW.idseq=v.idseq))
THEN CALL nao_existo(); 
END IF;
END
//
delimiter ;

delimiter //
CREATE TRIGGER pagina_before_update BEFORE UPDATE ON pagina 
FOR EACH ROW
BEGIN
IF EXISTS ( SELECT p.idseq FROM pagina p,tipo_registo tr,registo r,campo c,valor v
WHERE (NEW.idseq=p.idseq OR NEW.idseq=tr.idseq OR NEW.idseq=r.idseq OR NEW.idseq=c.idseq OR NEW.idseq=v.idseq))
THEN CALL nao_existo(); 
END IF;
END
//
delimiter ;



# TESTES

INSERT INTO pagina (userid, pagecounter, nome, idseq, ativa) VALUES (9999, 9999, "Nike Running Portugal - BVU_PS", 151489, true);
