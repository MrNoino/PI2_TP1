DELIMITER $$
CREATE PROCEDURE insert_admin(IN a_username varchar(45), IN a_nome varchar(100), IN a_password varchar(200))
BEGIN
	INSERT INTO admin (username, nome, password)
    VALUES
    (a_username, a_nome, a_password);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE admin_login(IN a_username VARCHAR(45), OUT a_id INT, OUT a_password VARCHAR(200)) 
BEGIN
    (SELECT id, password
			FROM admin
            WHERE username = a_username) INTO a_id, a_password;
END $$
DELIMITER ;
