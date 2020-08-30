-- База данных в файле dump.sql
-- Настройки БД в файле \mvc\tools\DBConfig.php 


--  список email'лов встречающихся более чем у одного пользователя
SELECT
	`test`.`email`
FROM
(
	SELECT
	    COUNT(`r63_users`.`email`) AS `count`,
		 `r63_users`.`email`
	FROM
	    `r63_users`
	GROUP BY 
		`r63_users`.`email`
	HAVING 
		`count` > 1
) `test`


-- список логинов пользователей, которые не сделали ни одного заказа
SELECT
	`r63_users`.`login`
FROM
	`r63_users`
LEFT OUTER JOIN
		`r63_orders`
	ON
		`r63_orders`.`user_id` = `r63_users`.`id`
WHERE
	ISNULL(`r63_orders`.`user_id`)
ORDER BY
	`r63_users`.`id`

-- список логинов пользователей которые сделали более двух заказов
SELECT
	`test`.`login`
FROM
(
	SELECT
		`r63_users`.`login`,
		COUNT(`r63_orders`.`user_id`) AS `count`
	FROM
		`r63_users`
	LEFT OUTER JOIN
			`r63_orders`
		ON
			`r63_users`.`id` = `r63_orders`.`user_id`
	GROUP BY
		`r63_users`.`login`
	HAVING 
		`count` > 1
) `test`