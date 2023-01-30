Create table Agrupamentos (
id 			INT  NOT NULL PRIMARY KEY,
nome		VARCHAR(300) 	NOT NULL,
descricao	VARCHAR(300)	NOT NULL, 
limite_economia 	VARCHAR(300) 	 NULL,
status 	VARCHAR(300) 	NOT NULL,
created	DATETIME NOT NULL,
updated DATETIME NULL,
idUsuario INT NOT NULL,


FOREIGN KEY (idUsuario) REFERENCES Usuario(id)


);

Create table Despensas (
id 			INT  NOT NULL PRIMARY KEY,
descricao		VARCHAR(300) 	NOT NULL,
valor	float	NOT NULL, 
data 	date 	 NULL,
status 	VARCHAR(300) 	NOT NULL,
created	DATETIME NOT NULL,
updated DATETIME NULL,
idAgrupamento INT NOT NULL,
idStatus_despensa INT NOT NULL,


FOREIGN KEY (idAgrupamento) REFERENCES agrupamentos(id),
FOREIGN KEY (idStatus_despensa) REFERENCES status_despensas(id)


);
