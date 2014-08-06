mysql -u root -p


//creating new database user with select,insert,delete and update privileges on emailline database

create user 'email-line'@'localhost' identified by 'your-email-user-db-password';

grant select,insert,delete,update on emailline.* to 'email-line'@'localhost';


 //creating and using emailline database

 create database emailline;

 use emailline;


 //creating email user table with index on Email

 create table users(P_Id int not null auto_increment, Email varchar(50) not null default '',FirstName varchar(50),LastName varchar(50),Primary Key(P_Id), unique(Email));

 create index Email_Index on users(Email);


 //creating test table

 create table test(P_Id int not null auto_increment, Name varchar(50) not null default '', Description varchar(500), Value int, Notes varchar(500),Primary Key(P_Id));
