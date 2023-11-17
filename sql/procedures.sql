DELIMITER $$
CREATE PROCEDURE insert_admin(IN a_username VARCHAR(45), IN a_nome VARCHAR(100), IN a_password VARCHAR(200))
BEGIN
	INSERT INTO admin (username, nome, password)
    VALUES
    (a_username, a_nome, a_password);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE admin_login(IN a_username VARCHAR(45)) 
BEGIN
    SELECT id, password
			FROM admin
            WHERE username = a_username;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE insert_entity(IN a_nome VARCHAR(45), IN a_descricao VARCHAR(256), IN a_logotipo VARCHAR(100), IN a_morada VARCHAR(200), IN a_telefone VARCHAR(45), IN a_email VARCHAR(150),  IN a_password VARCHAR(200), IN a_ativo TINYINT(1))
BEGIN
	INSERT INTO entidade (nome, descricao, logotipo, morada, telefone, email, password, ativo)
    VALUES
    (a_nome, a_descricao, a_logotipo, a_morada, a_telefone, a_email, a_password, a_ativo);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE entity_login(IN a_email VARCHAR(150)) 
BEGIN
    SELECT id, password
			FROM entidade
            WHERE email = a_email;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE insert_offer(IN a_entidade_id INT, IN a_nome VARCHAR(45), IN a_descricao VARCHAR(256), IN a_foto VARCHAR(100), IN a_preço FLOAT, IN a_data DATE, IN a_disponivel TINYINT(1))
BEGIN
	INSERT INTO oferta (entidade_id, nome, descricao, foto, preço, data, disponivel)
    VALUES
    (a_entidade_id, a_nome, a_descricao, a_foto, a_preço, a_data, a_disponivel);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE delete_offer(IN a_id INT)
BEGIN
	DELETE FROM oferta 
    WHERE id = a_id;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE get_offers(IN a_entidade_id INT)
BEGIN
SELECT id, entidade_id as "entity_id", nome as "name", descricao as "description", foto as "image", preço as "price", data as "date", disponivel as "available"
FROM oferta
WHERE entidade_id = a_entidade_id;
END $$
DELIMITER ;