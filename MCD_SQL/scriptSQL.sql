#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Type_Matériel
#------------------------------------------------------------

CREATE TABLE Type_Materiel(
        Reference_Interne     Varchar (50) NOT NULL ,
        Libelle_Type_Materiel Varchar (50) NOT NULL
	,CONSTRAINT Type_Materiel_PK PRIMARY KEY (Reference_Interne)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Type_Contrat
#------------------------------------------------------------

CREATE TABLE Type_Contrat(
        Reference_Type_Contrat Varchar (50) NOT NULL ,
        Delai_Intervention     Varchar (50) NOT NULL ,
        Taux_Applicable        Varchar (11) NOT NULL
	,CONSTRAINT Type_Contrat_PK PRIMARY KEY (Reference_Type_Contrat)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Agence
#------------------------------------------------------------

CREATE TABLE Agence(
        Numero_Agence    Varchar (50) NOT NULL ,
        Nom_Agence       Varchar (50) NOT NULL ,
        Adresse_Agence   Varchar (50) NOT NULL ,
        Telephone_Agence Varchar (50) NOT NULL
	,CONSTRAINT Agence_PK PRIMARY KEY (Numero_Agence)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Client
#------------------------------------------------------------

CREATE TABLE Client(
        Numero_Client     Varchar (50) NOT NULL ,
        Raison_Sociale    Varchar (50) NOT NULL ,
        Siren             Varchar (50) NOT NULL ,
        Code_Ape          Varchar (50) NOT NULL ,
        Adresse           Varchar (50) NOT NULL ,
        Telephone_Client  Varchar (50) NOT NULL ,
        Emails            Varchar (50) NOT NULL ,
        Duree_Deplacement Date NOT NULL ,
        Distance_KM       Varchar (11) NOT NULL ,
        Numero_Agence     Varchar (50) NOT NULL
	,CONSTRAINT Client_PK PRIMARY KEY (Numero_Client)

	,CONSTRAINT Client_Agence_FK FOREIGN KEY (Numero_Agence) REFERENCES Agence(Numero_Agence)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Contrat_Maintenance
#------------------------------------------------------------

CREATE TABLE Contrat_Maintenance(
        Numero_de_Contrat      Varchar (50) NOT NULL ,
        Date_Signature         Date NOT NULL ,
        Date_echeance          Date NOT NULL ,
        Numero_Client          Varchar (50) NOT NULL ,
        Reference_Type_Contrat Varchar (50) NOT NULL
	,CONSTRAINT Contrat_Maintenance_PK PRIMARY KEY (Numero_de_Contrat)

	,CONSTRAINT Contrat_Maintenance_Client_FK FOREIGN KEY (Numero_Client) REFERENCES Client(Numero_Client)
	,CONSTRAINT Contrat_Maintenance_Type_Contrat0_FK FOREIGN KEY (Reference_Type_Contrat) REFERENCES Type_Contrat(Reference_Type_Contrat)
	,CONSTRAINT Contrat_Maintenance_Client_AK UNIQUE (Numero_Client)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Matériel
#------------------------------------------------------------

CREATE TABLE Materiel(
        Numero_de_Serie   Varchar (50) NOT NULL ,
        Date_de_Vente     Date NOT NULL ,
        Date_Installation Date NOT NULL ,
        Prix_de_Vente     Float NOT NULL ,
        Emplacement       Varchar (11) NOT NULL ,
        Numero_de_Contrat Varchar (50) ,
        Numero_Client     Varchar (50) NOT NULL
	,CONSTRAINT Materiel_PK PRIMARY KEY (Numero_de_Serie)

	,CONSTRAINT Materiel_Contrat_Maintenance_FK FOREIGN KEY (Numero_de_Contrat) REFERENCES Contrat_Maintenance(Numero_de_Contrat)
	,CONSTRAINT Materiel_Client0_FK FOREIGN KEY (Numero_Client) REFERENCES Client(Numero_Client)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Employé
#------------------------------------------------------------

CREATE TABLE Employe(
        Matricule       Varchar (50) NOT NULL ,
        Nom_Employe     Varchar (50) NOT NULL ,
        Prenom_Employe  Varchar (50) NOT NULL ,
        Adresse_Employe Varchar (50) NOT NULL ,
        Date_Embauche   Date NOT NULL
	,CONSTRAINT Employe_PK PRIMARY KEY (Matricule)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Technicien
#------------------------------------------------------------

CREATE TABLE Technicien(
        Matricule        Varchar (50) NOT NULL ,
        Telephone_Mobile Varchar (50) NOT NULL ,
        Qualification    Varchar (50) NOT NULL ,
        Date_Obtention   Date NOT NULL ,
        Nom_Employe      Varchar (50) NOT NULL ,
        Prenom_Employe   Varchar (50) NOT NULL ,
        Adresse_Employe  Varchar (50) NOT NULL ,
        Date_Embauche    Date NOT NULL ,
        Numero_Agence    Varchar (50) NOT NULL
	,CONSTRAINT Technicien_PK PRIMARY KEY (Matricule)

	,CONSTRAINT Technicien_Employe_FK FOREIGN KEY (Matricule) REFERENCES Employe(Matricule)
	,CONSTRAINT Technicien_Agence0_FK FOREIGN KEY (Numero_Agence) REFERENCES Agence(Numero_Agence)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Intervention
#------------------------------------------------------------

CREATE TABLE Intervention(
        Numero_Intervention Varchar (50) NOT NULL ,
        Date_Visite         Date NOT NULL ,
        Heure_Visite        Varchar (11) NOT NULL ,
        Numero_Client       Varchar (50) NOT NULL ,
        Matricule           Varchar (50) NOT NULL
	,CONSTRAINT Intervention_PK PRIMARY KEY (Numero_Intervention)

	,CONSTRAINT Intervention_Client_FK FOREIGN KEY (Numero_Client) REFERENCES Client(Numero_Client)
	,CONSTRAINT Intervention_Technicien0_FK FOREIGN KEY (Matricule) REFERENCES Technicien(Matricule)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Appartenir
#------------------------------------------------------------

CREATE TABLE Appartenir(
        Reference_Interne Varchar (50) NOT NULL ,
        Numero_de_Serie   Varchar (50) NOT NULL
	,CONSTRAINT Appartenir_PK PRIMARY KEY (Reference_Interne,Numero_de_Serie)

	,CONSTRAINT Appartenir_Type_Materiel_FK FOREIGN KEY (Reference_Interne) REFERENCES Type_Materiel(Reference_Interne)




	=======================================================================
	   Désolé, il faut activer cette version pour voir la suite du script ! 
	=======================================================================
