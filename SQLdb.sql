use socialnet;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--database 'socialnet'

DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users (
  id INT unsigned NOT NULL AUTO_INCREMENT,
  email VARCHAR(75) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY email (email)
)DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

INSERT INTO users (id, email, password, otp) VALUES
(1, 'root@gmail.com', 'root','12345');

CREATE TABLE IF NOT EXISTS posting (
    post_id INT,
    usrname VARCHAR(255) NOT NULL,
    post_content VARCHAR(512) NOT NULL,
    time_posting TIMESTAMP NOT NULL,
    PRIMARY KEY (post_id)
) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

INSERT INTO posting (post_id, usrname, post_content, time_posting) VALUES
(1, 'root', '2020-20-12 21:33:22');


