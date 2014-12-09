--
-- Add tables for genre
--
DROP TABLE IF EXISTS Genre;
CREATE TABLE Genre
(
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  name CHAR(20) NOT NULL -- crime, svenskt, college, drama, etc
) ENGINE INNODB CHARACTER SET utf8;
 
INSERT INTO Genre (name) VALUES 
  ('comedy'), ('romance'), ('college'), 
  ('crime'), ('drama'), ('thriller'), 
  ('animation'), ('adventure'), ('family'), 
  ('svenskt'), ('action'), ('horror')
;
 
DROP TABLE IF EXISTS Movie2Genre;
CREATE TABLE Movie2Genre
(
  idMovie INT NOT NULL,
  idGenre INT NOT NULL,
 
  FOREIGN KEY (idMovie) REFERENCES Movie (id),
  FOREIGN KEY (idGenre) REFERENCES Genre (id),
 
  PRIMARY KEY (idMovie, idGenre)
) ENGINE INNODB;
 
 
INSERT INTO Movie2Genre (idMovie, idGenre) VALUES
  (1, 1),
  (1, 5),
  (1, 6),
  (2, 1),
  (2, 2),
  (2, 3),
  (3, 7), 
  (3, 8), 
  (3, 9), 
  (4, 11),
  (4, 1),
  (4, 10),
  (4, 9),
  (5, 11),
  (5, 4),
  (5, 12)
;
 
DROP VIEW IF EXISTS VMovie;
 
CREATE VIEW VMovie
AS
SELECT 
  M.*,
  GROUP_CONCAT(G.name) AS genre
FROM Movie AS M
  LEFT OUTER JOIN Movie2Genre AS M2G
    ON M.id = M2G.idMovie
  LEFT OUTER JOIN Genre AS G
    ON M2G.idGenre = G.id
GROUP BY M.id
;
 
SELECT * FROM VMovie;