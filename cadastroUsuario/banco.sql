create database if not exists aulaphp;
use aulaphp;

create table tb_usuario(
	id int not null auto_increment,
	nm_usuario varchar(50) not null,
    nm_login varchar(30) not null,
    ds_email varchar(80) not null,
    ds_password varchar(150) not null,
    constraint pk_usuario primary key(id)
);

select * from tb_usuario;
SELECT * FROM tb_usuario WHERE nm_login	= "robson"