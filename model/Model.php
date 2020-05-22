<?php

    class Model {
        private $connexion = null;
        private $DSN = "mysql:host=localhost;dbname=vod" ;
        private $USER = "root" ;
        private $PWD = "" ;
        private $OPTIONS = array (
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        );

        private function connexionBDD(){
            try{
                $this->connexion = new PDO( $this->DSN, $this->USER, $this->PWD, $this->OPTIONS);
            }catch(PDOException $exception){
                printf("Echec de connexion ! exception => %s", $exception->getMessage());
                $this->connexion = null;
            }
           
        
        }

        public function consulterFilms(){
            $this->connexionBDD();
            
            if($this->connexion == true){
                $requete = "SELECT * FROM FILM";
                $resultat = $this->connexion->query($requete); //permet de pouvoir exécuter la requete si notre connexion est ok ($this->connexion)
                $resultat = $resultat->fetchAll();
                $this->connexion = null;
                return $resultat;

            }else return false;

        }

        public function rechercherFilms($nomFilm){
            $this->connexionBDD();
            
            if($this->connexion == true){
                $requete = $this->connexion->prepare("SELECT * FROM FILM WHERE titre = :nomFilm");
                $requete->bindParam(':nomFilm', $nomFilm, PDO::PARAM_STR);
                $requete->execute();
                $nombreDeFilms = $requete->rowCount();

                $this->connexion = null;

                if($nombreDeFilms > 0){
                    return $requete->fetchAll();
                }
                return null;
                

            }else return false;

        }

        private function getMaxFilm(){
            $this->connexionBDD();

            if($this->connexion == true){
                
                $resultat = $this->connexion->query("SELECT max(numFilm) as idMaxFilm FROM Film");
                $resultat = $resultat->fetchAll();
                $this->connexion = null;
                if(count($resultat) > 0){
                    return $resultat[0]['idMaxFilm'];
                }
                return 0;
                
            }
        }

        public function insererFilm($titre,$annee, $realisateur){

            $idFilm = $this->getMaxFilm() + 1;
            $this->connexionBDD();
            if($this->connexion == true){

                $requete = $this->connexion->prepare("
                
                    INSERT INTO FILM (numFilm, titre, annee, realisateur) VALUES (:numFilm, :titre, :annee, :realisateur)
                
                ");
                $requete->bindParam(':numFilm',$idFilm);
                $requete->bindParam(':titre',$titre);
                $requete->bindParam(':annee',$annee);
                $requete->bindParam(':realisateur',$realisateur);

                $requete->execute();
                if ($requete->rowCount() > 0){
                    
                    return $requete->rowCount();
                }

                return 0;
            }
            return False;

        }
        

    }


?>