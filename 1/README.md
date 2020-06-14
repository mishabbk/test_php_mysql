#### Запрос на создание структуры БД

```mysql 
CREATE TABLE country (
    id INT NOT NULL AUTO_INCREMENT, 
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY (id), 
    UNIQUE (name)
) 
ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_unicode_ci;

CREATE TABLE olympic_games (
    id INT NOT NULL AUTO_INCREMENT, 
    name VARCHAR(255) NOT NULL, 
    opened_at DATE NOT NULL, 
    closed_at DATE NOT NULL, 
    country_id INT NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (name),
    INDEX (country_id), 
    FOREIGN KEY (country_id) 
    	REFERENCES country(id) 
    	ON DELETE CASCADE
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_unicode_ci;
```

#### Запрос который выберет все игры, которые проходили в одной и той же стране более трех раз.

```mysql
SELECT og.id, og.name, og.opened_at, og.closed_at, c.name as country
FROM olympic_games as og
LEFT JOIN country as c 
	ON og.country_id = c.id
WHERE c.id IN (
    SELECT country_id 
        FROM olympic_games 
        GROUP BY country_id 
        HAVING COUNT(*) > 3
)
```
