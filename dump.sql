/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE TABLE IF NOT EXISTS `r63_orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_user_order` (`user_id`),
  CONSTRAINT `FK_user_order` FOREIGN KEY (`user_id`) REFERENCES `r63_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `r63_orders` DISABLE KEYS */;
INSERT INTO `r63_orders` (`id`, `user_id`, `price`) VALUES
	(1, 7, 2.5),
	(2, 7, 4.67),
	(3, 2, 6),
	(4, 4, 56.98),
	(6, 4, 56.8);
/*!40000 ALTER TABLE `r63_orders` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `r63_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fio` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `r63_users` DISABLE KEYS */;
INSERT INTO `r63_users` (`id`, `email`, `login`, `password`, `fio`, `token`) VALUES
	(1, 'first@work.com', 'first', '$2y$12$7HEHRUUwWo9Org8IXHyEMe98TtBCvwG.ocR2j2/H6/Jv8kuggIefq', '1232 12312 12312', 'allb3qvuh2ln93ci1scl8dhrb1766m0o'),
	(2, 'second@work.com', 'second', '$2y$12$7HEHRUUwWo9Org8IXHyEMe98TtBCvwG.ocR2j2/H6/Jv8kuggIefq', 'second second second', ''),
	(3, 'third@work.com', 'third', '$2y$12$7HEHRUUwWo9Org8IXHyEMe98TtBCvwG.ocR2j2/H6/Jv8kuggIefq', 'third third third', ''),
	(4, 'fourth@mail.ru', 'fourth', '$2y$12$7HEHRUUwWo9Org8IXHyEMe98TtBCvwG.ocR2j2/H6/Jv8kuggIefq', 'fourth fourth fourth', ''),
	(5, 'fifth@work.com', 'fifth', '$2y$12$7HEHRUUwWo9Org8IXHyEMe98TtBCvwG.ocR2j2/H6/Jv8kuggIefq', 'fifth fifth fifth', ''),
	(6, 'sixth@work.com', 'sixth', '$2y$12$7HEHRUUwWo9Org8IXHyEMe98TtBCvwG.ocR2j2/H6/Jv8kuggIefq', 'sixth sixth sixth', ''),
	(7, 'seventh@work.com', 'seventh', '$2y$12$7HEHRUUwWo9Org8IXHyEMe98TtBCvwG.ocR2j2/H6/Jv8kuggIefq', 'seventh seventh seventh', '');
/*!40000 ALTER TABLE `r63_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
