#Respostas SQL

a)

SELECT userid 
FROM login 
GROUP BY userid 
HAVING (SUM(sucesso=false)>SUM(sucesso=true));

b)

SELECT pagOk.regid, pagOk.userid FROM registo r,
(
SELECT  p.userid,rp.regid,COUNT(p.pagecounter) NumPagOk
FROM pagina p LEFT JOIN reg_pag rp ON p.userid=rp.userid AND p.pagecounter=rp.pageid 
LEFT JOIN tipo_registo tr ON p.userid=tr.userid AND rp.typeid=tr.typecnt
WHERE p.ativa=1 AND rp.ativa=p.ativa AND tr.ativo=rp.ativa
GROUP BY rp.regid
) pagOk,

(
SELECT p.userid,COUNT(p.pagecounter) as NumPagAct
FROM pagina p
WHERE p.ativa=1 
GROUP BY p.userid
) pagAct

WHERE NumPagOk=NumPagAct 
AND pagOk.userid=pagAct.userid 
AND r.regcounter=pagOk.regid 
AND r.ativo=1 ;

c)


SELECT tabela2.userid,AVG(tabela2.NumReg) as MediaRegPag FROM (

SELECT COUNT(tabela1.regid)as NumReg,p.userid,p.pagecounter
FROM pagina p LEFT JOIN (

SELECT rp.pageid,rp.regid,rp.userid
FROM registo r,tipo_registo tr, reg_pag rp
WHERE r.typecounter=tr.typecnt 
AND r.ativo=1 AND tr.ativo=1 AND rp.ativa=1
AND rp.regid=r.regcounter AND r.userid=tr.userid 
AND tr.userid=rp.userid
)AS tabela1

ON p.pagecounter=tabela1.pageid AND p.userid=tabela1.userid
WHERE p.ativa=1
GROUP BY p.pagecounter
)AS tabela2

GROUP BY tabela2.userid
HAVING AVG(tabela2.NumReg)=(SELECT MAX(avgTable) as maximo FROM (
SELECT AVG(tabela2.NumReg) as avgTable,tabela2.userid 
FROM (
SELECT COUNT(tabela1.regid)as NumReg,p.userid,p.pagecounter
FROM pagina p LEFT JOIN (
SELECT rp.pageid,rp.regid,rp.userid
FROM registo r,tipo_registo tr, reg_pag rp
WHERE r.typecounter=tr.typecnt 
AND r.ativo=1 AND tr.ativo=1 AND rp.ativa=1
AND rp.regid=r.regcounter
AND r.userid=tr.userid 
AND tr.userid=rp.userid
)as tabela1

ON p.pagecounter=tabela1.pageid AND p.userid=tabela1.userid
WHERE p.ativa=1
GROUP BY p.pagecounter
)as tabela2

GROUP BY tabela2.userid) as tabela3);



d)

SELECT cruza.userid
FROM
(
 
SELECT PageFulltype.*, ifnull(typeid,-1) AS falha
FROM
 
(SELECT pagina.userid, pagina.pagecounter, tipo_registo.typecnt
FROM pagina INNER JOIN tipo_registo ON pagina.userid = tipo_registo.userid INNER JOIN registo ON registo.userid=tipo_registo.userid
WHERE (((tipo_registo.ativo)=1) AND ((pagina.ativa=1)) AND ((registo.ativo)=1))
) as PageFulltype LEFT JOIN
(SELECT DISTINCT reg_pag.pageid, reg_pag.userid, reg_pag.typeid
FROM reg_pag INNER JOIN tipo_registo ON reg_pag.userid = tipo_registo.userid INNER JOIN pagina ON pagina.userid=tipo_registo.userid INNER JOIN registo ON registo.userid=tipo_registo.userid
WHERE (((reg_pag.ativa)=1) AND ((tipo_registo.ativo)=1) AND ((pagina.ativa=1)) AND ((registo.ativo)=1))
) as rp_act_distintos
ON (PageFulltype.typecnt = rp_act_distintos.typeid) AND (PageFulltype.userid = rp_act_distintos.userid) AND (PageFulltype.pagecounter = rp_act_distintos.pageid)
) as cruza
GROUP BY cruza.userid
HAVING (((Min(cruza.falha))>0));
