<?php
    require_once("Conexao.class.php");

    class Usuario{
        private $con;
        private $codigo;
        private $nome;
        private $email;
        private $data;

        public function __construct(){
            $this->con = new Conexao();
        }

        public function editarPerfilUsuario($codigo,$nome,$email,$data){
            try {

                $this->codigo = $codigo;
                $this->nome = $nome;
                $this->email = $email;
                $this->data = $data;

                $query = $this->con->conectar()->prepare("SELECT * FROM usuario WHERE cod = ?");
                $query->bindParam(1,$codigo);
                $query->execute();
                $retorno = $query->fetch(PDO::FETCH_ASSOC);
                if(count($retorno) > 0){
                    $query = $this->con->conectar()->prepare("UPDATE usuario SET nome = ?, email = ?, data = ? WHERE cod = ?");
                    $query->bindParam(1, $this->nome);
                    $query->bindParam(2, $this->email);
                    $query->bindParam(3, $this->data);
                    $query->bindParam(4, $this->codigo);
                    $retorno = $query->execute();//retorno boolean padrao TRUE
                    if($retorno){
                        return 1;
                    } else{
                        return 0;
                    }
                }     
            } catch (PDOException $ex){
                return 'error'.$ex->getMessage(); 
            }
        
        }

    }
?>