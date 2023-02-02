
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


insert into status_mes ( nome ) values (' Janeiro ' )
