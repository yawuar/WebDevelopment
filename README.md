# WebDevelopment
Assignment of Web Development

# MySQL

## Create new users
The following command can be used to create new users

		CREATE USER '<username>'@'<localhost>' IDENTIFIED BY '<password>';

Commando to give all the access for the user

		GRANT ALL PRIVILEGES ON * . * TO '<username>'@'<localhost>';

Best practice is to reload all the privileges

		FLUSH PRIVILEGES;

## No connection?

If you're trying to migrate something and it always return the error message connection is refused,
you have to go the following path:

		sudo nano /etc/mysql/mysql.conf.d/mysqld.cnf

You have to comment 2 things in the file:

		skip-external-locking
		bind-address

