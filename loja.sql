drop database loja;

create database loja;

use loja;

create table produtos(
id int primary key auto_increment,
nome varchar(50) not null,
preco varchar(20) not null,
qtdestoque int default null,
nrserie int default null,
cod int default null,
marca varchar(20) not null 
);
select * from produtos;