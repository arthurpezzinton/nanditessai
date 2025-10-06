CREATE TABLE toi_data (
	id INT NOT NULL UNIQUE AUTO_INCREMENT,
	rowid DECIMAL(30, 2),
	toi DECIMAL(30, 2),
	toipfx DECIMAL(30, 2),
	tid DECIMAL(30, 2),
	ctoi_alias DECIMAL(30, 2),
	pl_pnum DECIMAL(30, 2),
	tfopwg_disp VARCHAR(10),
	rastr VARCHAR(100),
	ra DECIMAL(30, 2),
	decstr VARCHAR(100),
	dec_ DECIMAL(30, 2),
	st_pmra DECIMAL(30, 2),
	st_pmraerr1 DECIMAL(30, 2),
	st_pmraerr2 DECIMAL(30, 2),
	st_pmdec DECIMAL(30, 2),
	st_pmdecerr1 DECIMAL(30, 2),
	st_pmdecerr2 DECIMAL(30, 2),
	pl_tranmid DECIMAL(30, 2),
	pl_tranmiderr1 DECIMAL(30, 2),
	pl_tranmiderr2 DECIMAL(30, 2),
	pl_orbper DECIMAL(30, 2),
	pl_orbpererr1 DECIMAL(30, 2),
	pl_orbpererr2 DECIMAL(30, 2),
	pl_trandurh DECIMAL(30, 2),
	pl_trandurherr1 DECIMAL(30, 2),
	pl_trandurherr2 DECIMAL(30, 2),
	pl_trandep DECIMAL(30, 2),
	pl_trandeperr1 DECIMAL(30, 2),
	pl_trandeperr2 DECIMAL(30, 2),
	pl_rade DECIMAL(30, 2),
	pl_radeerr1 DECIMAL(30, 2),
	pl_radeerr2 DECIMAL(30, 2),
	pl_insol DECIMAL(30, 2),
	pl_eqt DECIMAL(30, 2),
	st_tmag DECIMAL(30, 2),
	st_tmagerr1 DECIMAL(30, 2),
	st_tmagerr2 DECIMAL(30, 2),
	st_dist DECIMAL(30, 2),
	st_disterr1 DECIMAL(30, 2),
	st_disterr2 DECIMAL(30, 2),
	st_teff DECIMAL(30, 2),
	st_tefferr1 DECIMAL(30, 2),
	st_tefferr2 DECIMAL(30, 2),
	st_logg DECIMAL(30, 2),
	st_loggerr1 DECIMAL(30, 2),
	st_loggerr2 DECIMAL(30, 2),
	st_rad DECIMAL(30, 2),
	st_raderr1 DECIMAL(30, 2),
	st_raderr2 DECIMAL(30, 2),
	percentual DECIMAL(30, 2),
	PRIMARY KEY (id)
);

CREATE INDEX toi_data_percentual ON toi_data (percentual);
CREATE INDEX toi_data_toi ON toi_data (toi);
CREATE INDEX toi_data_tfopwg_disp ON toi_data (tfopwg_disp);

CREATE TABLE teorias (
	id INT NOT NULL UNIQUE AUTO_INCREMENT,
	nome VARCHAR(255),
	titulo VARCHAR(500),
	descricao VARCHAR(3000),
	hipotese VARCHAR(5000),
	metodologia VARCHAR(3000),
	resultados VARCHAR(3000),
    registro DATETIME,
	PRIMARY KEY (id)
);

CREATE TABLE estrelas (
	id INT NOT NULL UNIQUE AUTO_INCREMENT,
	nome VARCHAR(50),
	classe VARCHAR(1),
	teff DECIMAL(30, 2),
	mag DECIMAL(30, 2),
	dist DECIMAL(30, 2),
	raio DECIMAL(30, 2),
	PRIMARY KEY (id)
);

INSERT INTO estrelas VALUES(0,'HD 16417','G',5777,8.2,25.3,1);
INSERT INTO estrelas VALUES(0,'Kepler-442','K',4402,14.76,370,0.6);
INSERT INTO estrelas VALUES(0,'HD 40307','K',4977,7.17,12.8,0.77);
INSERT INTO estrelas VALUES(0,'Próxima Centauri','M',3042,11.13,1.3,0.154);
INSERT INTO estrelas VALUES(0,'TRAPPIST-1','M',2559,18.80,12.4,0.117);
INSERT INTO estrelas VALUES(0,'HD 164922','G',5293,7,22.1,0.95);

CREATE TABLE planetas (
	id INT NOT NULL UNIQUE AUTO_INCREMENT,
	estrela INT NOT NULL,
	nome VARCHAR(50),
	p DECIMAL(30, 2),
	a DECIMAL(30, 3),
	m DECIMAL(30, 2),
	descricao VARCHAR(50),
	PRIMARY KEY (id),
	FOREIGN KEY (estrela) REFERENCES estrelas (id)
);

INSERT INTO planetas VALUES(0,1,'HD 16417 b',17.2,0.140,68.1,'Neptune-like');
INSERT INTO planetas VALUES(0,2,'Kepler-442 b',112.3,0.409,2.3,'Super Earth');
INSERT INTO planetas VALUES(0,3,'HD 40307 g',197.8,0.6,7.1,'Super Earth');
INSERT INTO planetas VALUES(0,4,'Próxima Centauri b',11.2,0.049,1.2,'Terrestrial');
INSERT INTO planetas VALUES(0,5,'TRAPPIST-1 e',6.1,0.028,0.8,'Terrestrial');
INSERT INTO planetas VALUES(0,5,'TRAPPIST-1 f',9.2,0.037,1,'Terrestrial');