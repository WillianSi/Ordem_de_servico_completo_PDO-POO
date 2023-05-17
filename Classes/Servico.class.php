<?php
    require_once("Conexao.class.php");

    class Servicos{
        private $con;
        private $nome;
        private $data;
        private $valor;
        private $codigo;

        public function __construct(){
            $this->con = new Conexao();
        }

        public function editarServico($codigo,$nome,$valor,$data){
            try {

                $this->codigo = $codigo;
                $this->nome = $nome;
                $this->valor = $valor;
                $this->data = $data;

                $query = $this->con->conectar()->prepare("SELECT * FROM servico WHERE cod = ?");
                $query->bindParam(1,$this->codigo);
                $query->execute();
                $retorno = $query->fetch(PDO::FETCH_ASSOC);
            
                if(count($retorno) > 0){
                    $query = $this->con->conectar()->prepare("UPDATE servico SET nome = ?, valor = ?, data = ? WHERE cod = ?");
                    $query->bindParam(1, $this->nome);
                    $query->bindParam(2, $this->valor);
                    $query->bindParam(3, $this->data);
                    $query->bindParam(4, $this->codigo);
                    $retorno = $query->execute();//retorno boolean padrao TRUE
                    if($retorno){
                        return 1;
                    } else{
                        return 0;
                    }
                }      
            } catch (PDOException $ex) {
                return 'error' . $ex->getMessage();
            }
        }
    }
?>