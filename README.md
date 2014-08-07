
require Zend Framework 2

=========================
setup database

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


=====================
setup postfix

sudo apt-get install postfix postfix-mysql

edit /etc/postfix/main.cf, add:

virtual_alias_maps = proxy:mysql:/etc/postfix/mysql-virtual-mailbox-users.cf

edit /etc/postfix/master.cf
myfilter unix - n n - - pipe
  flags=F user=www-data argv=/home/ubuntu/bin/email-line/postfix.php ${sender} ${size} ${recipient}
mtp      inet  n       -       -       -       -       smtpd
         -o content_filter=myfilter:dummy


in /etc/postfix/mysql-virtual-mailbox-users.cf

user = your-db-username
password = your-db-password
hosts = 127.0.0.1
dbname = emailline
query = SELECT Email as email FROM users WHERE Email='%s'
