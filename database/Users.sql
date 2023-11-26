Table: Users
Columns:
	UserID	int AI PK
	UserName	varchar(45)
	FirstName	varchar(45)
	LastName	varchar(45)
	Birthday	date
	Email	varchar(60)
	Password	varchar(255)


-- NOTE: various queries with various formats. More to come...
SELECT * FROM `test-db`.Users;
select UserID, UserName, FirstName, LastName, Email, DATE_FORMAT(Birthday, "%m/%d/%Y"), Password from Users where UserID = 1;
select UserID, UserName, FirstName, LastName, Email, DATE_FORMAT(Birthday, '%m/%d/%Y') As BDate, Password from Users;