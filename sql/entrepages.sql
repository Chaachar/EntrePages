-- Création des tables
CREATE TABLE utilisateur(
	id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
	nom VARCHAR(50) NOT NULL,
	prenom VARCHAR(50) NOT NULL,
	pseudo VARCHAR(50) NOT NULL,
	email VARCHAR(255) NOT NULL,
	mot_de_passe VARCHAR(255) NOT NULL,
	photo_profil VARCHAR(255) NULL,
	CONSTRAINT email_unique UNIQUE (email)
);

-- Ajout de la contrainte d'unicité sur le pseudo 
ALTER TABLE utilisateur,
ADD CONSTRAINT pseudo_unique UNIQUE (pseudo)

-- Ajout d'informations complémentaires du profil
ALTER TABLE utilisateur,
ADD description TEXT NULL,
ADD citation TEXT NULL

CREATE TABLE livre(
	isbn CHAR(13) PRIMARY KEY,
	titre VARCHAR(255) NOT NULL,
	auteur VARCHAR(255) NOT NULL,
	resume TEXT NULL,
	url_couverture VARCHAR(255) NULL
);

CREATE TABLE exemplaire(
	id_exemplaire INT PRIMARY KEY AUTO_INCREMENT,
	disponible BOOLEAN DEFAULT TRUE,
	date_ajout DATETIME DEFAULT CURRENT_TIMESTAMP,
	commentaire TEXT NULL,
	isbn CHAR(13) NOT NULL,
	id_proprietaire INT NOT NULL,
	CONSTRAINT fk_exemplaire_livre FOREIGN KEY (isbn) REFERENCES livre(isbn),
	CONSTRAINT fk_exemplaire_proprietaire FOREIGN KEY (id_proprietaire) REFERENCES utilisateur(id_utilisateur)
);

CREATE TABLE emprunt(
	id_emprunt INT PRIMARY KEY AUTO_INCREMENT,
	date_emprunt DATETIME NOT NULL,
	date_retour DATETIME NULL,
	id_emprunteur INT NOT NULL,
	id_exemplaire INT NOT NULL,

	CONSTRAINT fk_emprunt_emprenteur FOREIGN KEY (id_emprunteur) REFERENCES utilisateur(id_utilisateur),
	CONSTRAINT fk_emprunt_exemplaire FOREIGN KEY (id_exemplaire) REFERENCES exemplaire(id_exemplaire)
);
