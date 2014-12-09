
delimiter //

CREATE PROCEDURE restoreMoviesDB ()
 BEGIN 
	DELETE FROM Movie;
	 
	INSERT INTO Movie (title, YEAR, image) VALUES
	  ('Pulp fiction', 1994, 'img/movie/pulp-fiction.jpg'),
	  ('American Pie', 1999, 'img/movie/american-pie.jpg'),
	  ('Pokémon The Movie 2000', 1999, 'img/movie/pokemon.jpg'),  
	  ('Kopps', 2003, 'img/movie/kopps.jpg'),
	  ('From Dusk Till Dawn', 1996, 'img/movie/from-dusk-till-dawn.jpg')
	;
 END// 
