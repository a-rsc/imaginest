SHOW DATABASES;
USE imaginest;
SHOW TABLES;

SELECT count(*) AS count FROM users WHERE (username = 'benito' || email = 'benito@hotmail.com' ) AND iduser != 4 LIMIT 1;

-- tables
SELECT * FROM users;
SELECT * FROM images;
SELECT * FROM images_has_users;
SELECT * FROM hashtags;
SELECT * FROM hashtags_has_images;

DELETE FROM images_has_users WHERE users_iduser = 5;

DELETE FROM hashtags WHERE hashtag = 'tag1' || hashtag = 'tag2';
INSERT INTO hashtags VALUES ('tag1'), ('tag2'); 

DELETE FROM hashtags_has_images WHERE images_idimages = 3;
INSERT INTO hashtags_has_images VALUES (3, 'tag1'), (3, 'tag2'); 

UPDATE images SET average = 0.5 WHERE idimages = 3;


INSERT INTO images_has_users VALUES (3, 4, 'like');
INSERT INTO images_has_users VALUES (4, 2, 'dislike');
INSERT INTO images_has_users VALUES (3, 1, 'like');

INSERT INTO images_has_users VALUES (3, 3, 'like');
INSERT INTO images_has_users VALUES (3, 4, 'dislike');
INSERT INTO images_has_users VALUES (3, 5, 'like');
INSERT INTO images_has_users VALUES (3, 6, 'dislike');

SELECT i.*
FROM images i
LEFT JOIN images_has_users ih ON ih.images_idimages = i.idimages
inner join users u on u.iduser = i.users_iduser
WHERE i.users_iduser != 2 AND (ih.users_iduser IS NULL OR i.idimages NOT IN (SELECT images_idimages FROM images_has_users WHERE users_iduser = 2))
ORDER BY i.idimages DESC LIMIT 1;

SELECT * FROM users WHERE (username = 'alvaro' || email = 'a_rsc@hotmail.com') && active = 1 LIMIT 1;

UPDATE users SET last_sign_in = now(), changed_on = now() WHERE iduser = 1;
SELECT length(SHA2(CONCAT("hola"), 256)), SHA2(CONCAT(floor(1+RAND()*1000000)), 256), floor(1+RAND()*1000000);

