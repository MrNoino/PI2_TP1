CREATE VIEW get_total_admins AS
SELECT COUNT(id)
FROM admin;

CREATE VIEW get_entities AS
SELECT id, nome as "name", descricao as "description", logotipo as "logo", morada as "address", telefone as "phone_number", email, password, ativo as "active"
FROM entidade;