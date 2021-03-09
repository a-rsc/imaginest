SHOW DATABASES;
USE imaginest;
SHOW TABLES;
SELECT * FROM users;
SELECT * FROM hashtags;
SELECT * FROM images;
SELECT * FROM hashtags_has_images;

SELECT count(*) FROM users WHERE (username = 'albert' || email = 'albert@hotmail.com') LIMIT 1;
SELECT * FROM users WHERE (username = 'alvaro' || email = 'a_rsc@hotmail.com') && active = 1 LIMIT 1;

UPDATE users SET last_sign_in = now(), changed_on = now() WHERE iduser = 1;
SELECT length(SHA2(CONCAT("hola"), 256)), SHA2(CONCAT(floor(1+RAND()*1000000)), 256), floor(1+RAND()*1000000);

update users set removedon = now() where iduser = 1;
select * from users where iduser = 1 && createdOn > (now() - interval 5 minute) && removedOn is not null;

UPDATE users SET resetPasswordCode = 'adfasd', resetPassword = 1, resetPasswordExpiry = now() WHERE iduser = 1;