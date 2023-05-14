<?php
    require_once("Conexao.class.php");

    class Generica{
        private $con;

        public function __construct(){
            $this->con = new Conexao();
        }

        public function checaLogin($tabela,$email, $senha){
            try{

               $senhamd5 = md5($senha);
               
                $query = $this->con->conectar()->prepare("SELECT * FROM $tabela WHERE email = ? AND senha = ?");
                $query->bindParam(1,$email);
                $query->bindParam(2,$senhamd5);
                $query->execute();
                $retorno = $query->fetch(PDO::FETCH_ASSOC);
               
                return $retorno;

            }catch (PDOException $ex){
                return 'error'.$ex->getMessage();

            }
        }

        function buscaDadoseditarPerfil($tabela,$codigo){
            try {

                $query = $this->con->conectar()->prepare("SELECT * FROM $tabela
                            WHERE cod = ?");
            
                $query->bindParam(1,$codigo);
                $query->execute();
                $lista = $query->fetch(PDO::FETCH_ASSOC);
            
                return $lista;
            } catch (PDOException $ex){
                return 'error'.$ex->getMessage();

            }
        }
    }
?>
