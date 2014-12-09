ALTER  
VIEW `vmovie` AS
    select 
        `m`.`id` AS `id`,
        `m`.`title` AS `title`,
        `m`.`YEAR` AS `YEAR`,
        `m`.`image` AS `image`,
        group_concat(`g`.`name`
            separator ', ') AS `genre`
    from
        ((`movie` `m`
        left join `movie2genre` `m2g` ON ((`m`.`id` = `m2g`.`idMovie`)))
        left join `genre` `g` ON ((`m2g`.`idGenre` = `g`.`id`)))
    group by `m`.`id`