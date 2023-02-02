
Create table Usuario (
id 			INT  NOT NULL PRIMARY KEY  AUTO_INCREMENT,
nome		VARCHAR(300) 	NOT NULL,
email	VARCHAR(300)	NOT NULL, 
senha VARCHAR(300) NOT NULL,
status 	VARCHAR(300) 	NOT NULL DEFAULT 'ATIVO' ,
created	DATETIME NOT NULL  DEFAULT NOW(),
updated DATETIME NULL

);


Create table Status_despensas (
id 			INT  NOT NULL PRIMARY KEY AUTO_INCREMENT,
nome		VARCHAR(300) 	NOT NULL,
descricao	VARCHAR(300) 	NOT NULL,
created	DATETIME NOT NULL DEFAULT NOW()

);

/*  INSERT INTO */
insert into status_despensas (nome, descricao) values ('Despensas: Entrada da casa' , '');
insert into status_despensas (nome, descricao) values ('Despensas: Saida da casa' , '');

insert into status_despensas (nome, descricao) values ('Despensas: Entrada dos gastos pessoais' , '');
insert into status_despensas (nome, descricao) values ('Despensas: Saída dos gastos pessoais' , '');

insert into status_despensas (nome, descricao) values ('Poupanca: Entrada da casa' , '');
insert into status_despensas (nome, descricao) values ('Poupanca: Saida da casa' , '');

insert into status_despensas (nome, descricao) values ('Despensas: Entrada dos gastos pessoais' , '');
insert into status_despensas (nome, descricao) values ('Despensas: Saída dos gastos pessoais' , '');


Create table Status_mes (
id 			INT  NOT NULL PRIMARY KEY AUTO_INCREMENT,
nome		VARCHAR(300) 	NOT NULL,
created	DATETIME NOT NULL DEFAULT NOW()

);

Create table Despensas (
id 			INT  NOT NULL PRIMARY KEY AUTO_INCREMENT,
descricao		VARCHAR(300) 	NOT NULL,
valor	float	NOT NULL, 
data 	date 	 NULL,
/* Ano vai ser usado pelo sistema  */
ano     VARCHAR(300) NOT NULL,
quinzena VARCHAR(300) NOT NULL,
status 	VARCHAR(300) 	NOT NULL DEFAULT 'ATIVO' ,
created	DATETIME NOT NULL DEFAULT NOW(),
updated DATETIME NULL,
IdStatus_mes INT NOT NULL,
idStatus_despensa INT NOT NULL,


FOREIGN KEY (IdStatus_mes) REFERENCES status_mes(id),
FOREIGN KEY (idStatus_despensa) REFERENCES status_despensas(id)

);


insert into usuario (nome, email, senha) values ('Tiago', 'tiagocesar68@gmail.com',  sha1('tiago123')    ) ;


insert into status_mes ( nome ) values (' Janeiro ' );

/* Busca de despensa de gasto pessoais da quinzena 1 de janeiro/2023  */
Select * from despensas where status = "ATIVO" and ano = "2023"  and IdStatus_mes = "1" and quinzena = "Quinzena 01" and ( idStatus_despensa = 3 OR idstatus_despensa = 4 );
