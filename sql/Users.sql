 SELECT * FROM `test-db`.Users;

-- TRUNCATE TABLE Users;
-- INSERT INTO Users ( UserName, FirstName, LastName, Password ) VALUES( 'Jackless', 'Jack', 'Off', '1234' );
-- ALTER TABLE Users MODIFY COLUMN UserName varchar(45) AFTER UserID;
-- ALTER TABLE Users MODIFY Password VARCHAR(255);

UPDATE `test-db`.Users 
SET Email = 'jazz@jib.com'
-- SET LastName = 'Jones', Birthday = DATE(STR_TO_DATE('01/01/1970', '%m/%d/%Y')), Email = 'keep@lost.com'
WHERE UserID = 2;

-- INSERT INTO Users ( UserName, FirstName, LastName, Password ) VALUES( 'kk', 'kk', 'kk', 'kk' );

select UserID, UserName, FirstName, LastName, Email, DATE_FORMAT(Birthday, "%m/%d/%Y"), Password from Users where UserID = 1;

select UserID, UserName, FirstName, LastName, Email, DATE_FORMAT(Birthday, '%m/%d/%Y') As BDate, Password from Users;