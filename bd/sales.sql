CREATE SCHEMA `sales` DEFAULT CHARACTER SET utf8mb4 ;

use sales;

create table users(
				id_users int auto_increment,
				name varchar(50),
				lastname varchar(50),
				email varchar(50),
				password text(50),
				dateCapture date,
				primary key(id_users)
					);

create table categories (
				id_categories int auto_increment,
				id_users int not null,
				nameCategories varchar(150),
				dateCapture date,
				primary key(id_categories)
						);

create table images(
				id_image int auto_increment,
				id_categories int not null,
				name varchar(500),
				route varchar(500),
				dateUploaded date,
				primary key(id_image)
					);
create table articles(
				id_product int auto_increment,
				id_categories int not null,
				id_image int not null,
				id_users int not null,
				name varchar(50),
				description varchar(500),
				amount int,
				price float,
				dateCapture date,
				primary key(id_product)

						);

create table customers(
				id_customer int auto_increment,
				id_users int not null,
				name varchar(200),
				lastname varchar(200),
				address varchar(200),
				email varchar(200),
				phone varchar(200),
				rfc varchar(200),
				primary key(id_customer)
					);
-- Recuerda agregar el id de users por favor 
create table sales(
				id_sale int not null,
				id_customer int,
				id_product int,
				id_users int,
				price float,
				purchaseDate date
					);