
create database Skolan; 

use Skolan; 

CREATE TABLE Larare
(
  akronymLarare CHAR(3) PRIMARY KEY,
  avdelningLarare CHAR(3),
  namnLarare CHAR(20),
  lonLarare INT,
  foddLarare DATETIME
);

SELECT * FROM Larare; 

-- CREATE TABLE 
-- http://dev.mysql.com/doc/refman/5.6/en/create-table.html

-- DROP TABLE
-- http://dev.mysql.com/doc/refman/5.6/en/drop-table.html

--
-- Lägg till rader i tabellen Lärare
--

INSERT INTO Larare VALUES ('MOS', 'APS', 'Mikael',   15000, '1968-03-07');
INSERT INTO Larare VALUES ('MOL', 'AIS', 'Mats-Ola', 15000, '1978-12-07');
INSERT INTO Larare VALUES ('BBE', 'APS', 'Betty',    15000, '1968-07-07');
INSERT INTO Larare VALUES ('AJA', 'APS', 'Andreas',  15000, '1988-08-07');
INSERT INTO Larare VALUES ('CJH', 'APS', 'Conny',    15000, '1943-01-07');
INSERT INTO Larare VALUES ('CSA', 'APS', 'Charlie',  15000, '1969-04-07');
INSERT INTO Larare VALUES ('BHR', 'AIS', 'Birgitta', 15000, '1964-02-07');
INSERT INTO Larare VALUES ('MAP', 'APS', 'Marie',    15000, '1972-06-07');
INSERT INTO Larare VALUES ('LRA', 'APS', 'Linda',    15000, '1975-03-07');
INSERT INTO Larare VALUES ('ACA', 'APS', 'Anders',   15000, '1967-09-07');

-- Radera rader från en tabell
--
DELETE FROM Larare WHERE namnLarare = 'Mikael';

DELETE FROM Larare WHERE avdelningLarare = 'AIS' LIMIT 5; 


SELECT * FROM Larare WHERE avdelningLarare = 'AIS'; 


-- Ändra befintlig tabell
ALTER TABLE Larare ADD COLUMN kompetensLarare INT;

ALTER TABLE larare DROP COLUMN kompetensLarare

ALTER TABLE Larare ADD COLUMN kompetensLarare INT DEFAULT 5 NOT NULL 

UPDATE larare SET kompetensLarare = 7, lonLarare = 21000 WHERE namnLarare = 'Mikael' LIMIT 1; 

INSERT INTO Larare(akronymLarare,avdelningLarare,namnLarare,lonLarare,foddLarare) VALUES ('MOL', 'AIS', 'Mats-Ola', 15000, '1978-12-07');

INSERT INTO Larare(akronymLarare,avdelningLarare,namnLarare,lonLarare,foddLarare) 
VALUES ('MOS', 'APS', 'Mikael', 99000, '1968-03-07');

UPDATE larare SET lonLarare = lonLarare+6000 WHERE namnLarare = 'Mats-Ola' LIMIT 1; 

SELECT * FROM larare WHERE namnLarare = 'Mats-Ola'; 

UPDATE larare SET kompetensLarare=9, lonLarare=21000 WHERE namnLarare = 'Betty' LIMIT 1; 

SELECT * FROM larare WHERE namnLarare = 'Betty'; 

UPDATE larare SET lonLarare = lonLarare-1200 WHERE namnLarare = 'Andreas' LIMIT 1; 

SELECT * FROM larare WHERE namnLarare = 'Andreas'; 

UPDATE larare SET lonLarare = lonLarare*1.1 

SELECT namnLarare, lonLarare FROM larare 

-- 8.1 

SELECT * FROM larare WHERE avdelningLarare = 'AIS'; 

SELECT * FROM larare WHERE akronymLarare LIKE 'M%'; 

SELECT * FROM larare WHERE namnLarare LIKE '%o%'; 

SELECT * FROM larare WHERE lonLarare >= 20000; 

SELECT * FROM larare WHERE lonLarare >= 20000 AND kompetensLarare > 5;

SELECT * FROM larare WHERE akronymLarare IN('MOS','MOL','BBE'); 

-- 8.2 

SELECT namnLarare, lonLarare FROM larare 
SELECT namnLarare, lonLarare FROM larare ORDER BY namnLarare ASC 
SELECT namnLarare, lonLarare FROM larare ORDER BY namnLarare DESC

SELECT namnLarare, lonLarare FROM larare ORDER BY lonLarare ASC 
SELECT namnLarare, lonLarare FROM larare ORDER BY lonLarare DESC

SELECT namnLarare, lonLarare FROM larare ORDER BY lonLarare DESC LIMIT 3; 

-- 8.3 
SELECT
 namnLarare AS 'Lärare',
 lonLarare AS 'Lön',
 avdelningLarare AS 'Avdelning'
FROM Larare;

-- 9.1 
SELECT MIN(lonLarare) as 'Lön', namnLarare FROM larare; 

SELECT MAX(lonLarare) as 'Lön', namnLarare FROM larare; 

-- 9.2 
SELECT COUNT(namnLarare), avdelningLarare
FROM larare 
GROUP BY avdelningLarare

SELECT SUM(lonLarare), avdelningLarare
FROM larare 
GROUP BY avdelningLarare

SELECT AVG(lonLarare), avdelningLarare
FROM larare 
GROUP BY avdelningLarare

--9.3 
SELECT avdelningLarare, AVG(lonLarare) AS Medellon
FROM Larare
GROUP BY avdelningLarare
HAVING AVG(lonLarare) > 18000

SELECT lonLarare, COUNT(lonLarare) AS Antal
FROM Larare
GROUP BY lonLarare
HAVING COUNT(lonLarare) > 1

-- 10.1 

SELECT LOWER(CONCAT(avdelningLarare, '/', akronymLarare)) as larare FROM larare 

-- 10.2 
SELECT curdate(); 

SELECT LOWER(CONCAT(avdelningLarare, '/', akronymLarare)) as larare,
	   year(foddLarare),
	   curdate(), 
	   curtime()
FROM larare 

-- 10.3 

SELECT LOWER(CONCAT(avdelningLarare, '/', akronymLarare)) as larare,
	   (year(curdate())-year(foddLarare)) as 'ålder',
	   foddLarare
FROM larare 
ORDER BY foddLarare ASC 

SELECT LOWER(CONCAT(avdelningLarare, '/', akronymLarare)) as larare,
	   (year(curdate())-year(foddLarare)) as 'ålder',
	   foddLarare
FROM larare 
ORDER BY foddLarare DESC 

-- 11.1
-- http://dev.mysql.com/doc/refman/5.6/en/create-view.html

CREATE VIEW VLarare AS 
	SELECT namnLarare,
	   (year(curdate())-year(foddLarare)) as 'ålder'
	FROM larare 
	ORDER BY foddLarare DESC  

SELECT * FROM skolan.vlarare;

CREATE VIEW VLarare2 AS 
	SELECT *,
	   (year(curdate())-year(foddLarare)) as 'ålder'
	FROM larare 
	ORDER BY foddLarare DESC  

SELECT * FROM skolan.vlarare2;


ALTER VIEW VLarare3 AS 
	SELECT 
	   AVG(year(curdate())-year(foddLarare)) as 'medelålder',
	   MIN(year(curdate())-year(foddLarare)) as 'yngst',
	   MAX(year(curdate())-year(foddLarare)) as 'äldst',
	   AVG(lonLarare) as 'medellön',
	   MIN(lonLarare) as 'minst lön',
	   MAX(lonLarare) as 'högst lön',
	   COUNT(namnLarare)
	FROM larare 
	GROUP BY avdelningLarare 

SELECT * FROM skolan.vlarare3;


CREATE VIEW AvdelningsRapport AS 
	SELECT avdelningLarare, round(avg(ålder)), round(avg(lonLarare)) 
	FROM vlarare2
	GROUP BY avdelningLarare

SELECT * FROM skolan.avdelningsrapport;


CREATE  TABLE `skolan`.`Kurs` (
  `kodKurs` CHAR(6) NOT NULL ,
  `namnKurs` CHAR(40) NULL ,
  `poangKurs` FLOAT NULL ,
  PRIMARY KEY (`kodKurs`) );


CREATE  TABLE `skolan`.`Kurstillfalle` (
  `idKurstillfalle` INT NOT NULL ,
  `Kurstillfalle_kodKurs` CHAR(6) NULL ,
  `Kurstillfalle_akronymLarare` CHAR(3) NULL ,
  `lasperiodKurstillfalle` INT NOT NULL ,
  PRIMARY KEY (`idKurstillfalle`) );

ALTER TABLE `skolan`.`kurstillfalle` 
  ADD CONSTRAINT `FK_Larare`
  FOREIGN KEY (`Kurstillfalle_akronymLarare` )
  REFERENCES `skolan`.`larare` (`akronymLarare` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD INDEX `FK_Larare_idx` (`Kurstillfalle_akronymLarare` ASC) ;

ALTER TABLE `skolan`.`kurstillfalle` 
  ADD CONSTRAINT `FK_Kurs`
  FOREIGN KEY (`Kurstillfalle_kodKurs` )
  REFERENCES `skolan`.`kurs` (`kodKurs` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD INDEX `FK_Kurs_idx` (`Kurstillfalle_kodKurs` ASC) ;


INSERT INTO Kurs(kodKurs,namnKurs,poangKurs) VALUES('DV1106','Databasteknik och Webbapps', 7.5); 
INSERT INTO Kurs(kodKurs,namnKurs,poangKurs) VALUES('DV1219','Databasteknik', 7.5); 
INSERT INTO Kurs(kodKurs,namnKurs,poangKurs) VALUES('PA1106','Individuellt Projekt', 7.5); 

SELECT * FROM larare WHERE akronymLarare = 'MOL'


INSERT INTO Kurstillfalle(Kurstillfalle_kodKurs,Kurstillfalle_akronymLarare,lasperiodKurstillfalle) 
VALUES('DV1106','MOS',1); 

INSERT INTO Kurstillfalle(Kurstillfalle_kodKurs,Kurstillfalle_akronymLarare,lasperiodKurstillfalle) 
VALUES('DV1106','MOS',4);

INSERT INTO Kurstillfalle(Kurstillfalle_kodKurs,Kurstillfalle_akronymLarare,lasperiodKurstillfalle) 
VALUES('DV1219','CJH',2);

INSERT INTO Kurstillfalle(Kurstillfalle_kodKurs,Kurstillfalle_akronymLarare,lasperiodKurstillfalle) 
VALUES('DV1219','MOS',3);

INSERT INTO Kurstillfalle(Kurstillfalle_kodKurs,Kurstillfalle_akronymLarare,lasperiodKurstillfalle) 
VALUES('PA1106','MOL',1);

INSERT INTO Kurstillfalle(Kurstillfalle_kodKurs,Kurstillfalle_akronymLarare,lasperiodKurstillfalle) 
VALUES('PA1106','BBE',2);

ALTER VIEW VKurstillfallen AS 
SELECT * FROM Kurstillfalle AS Kt
INNER JOIN Kurs AS K 
ON K.Kodkurs = Kt.Kurstillfalle_kodKurs
INNER JOIN Larare AS L 
ON Kt.Kurstillfalle_akronymLarare = L.akronymLarare 
ORDER BY K.Kodkurs; 

SELECT ROUND(AVG(YEAR(curdate())-YEAR(foddLarare))), kodKurs
FROM VKurstillfallen
WHERE kodKurs = 'PA1106'
GROUP BY kodKurs; 

SELECT AVG(lonLarare)
FROM VKurstillfallen
WHERE kodKurs LIKE 'PA%'

SELECT lonLarare, kodKurs 
FROM VKurstillfallen
WHERE kodKurs LIKE 'PA%'

--
-- Hur många kurstillfällen har lärarna?
--
CREATE VIEW VVAntalKATillfallen
AS
SELECT akronymLarare, COUNT(akronymLarare) AS Antal 
FROM VKurstillfallen
GROUP BY akronymLarare;
 
SELECT * FROM VVAntalKATillfallen;
SELECT MAX(Antal) FROM VVAntalKATillfallen;
 
SELECT * 
FROM VVAntalKATillfallen
WHERE Antal = (SELECT MAX(Antal) FROM VVAntalKATillfallen);

INSERT INTO Kurs VALUES ('DV1207', 'Db och Webb2', 7.5);
SELECT * FROM Kurs;

SELECT
  K.kodKurs AS Kurskod,
  K.namnKurs AS Kursnamn,
  Kt.lasperiodKurstillfalle AS Läsperiod
FROM Kurstillfalle AS Kt
  LEFT OUTER JOIN Kurs AS K
    ON Kt.Kurstillfalle_kodKurs = K.kodKurs
ORDER BY K.kodKurs;


