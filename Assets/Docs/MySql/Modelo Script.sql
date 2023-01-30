Create table Agruamentos (
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