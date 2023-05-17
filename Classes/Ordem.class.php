<?php
    require_once("Conexao.class.php");

    class Ordem{
        private $con;
        private $codigo;
        private $cod_terceirizado;
        private $data_servico;
        private $status;
        private $data;

        public function __construct(){
            $this->con = new Conexao();
        }

        public function consultaStatusUsuario($status){
            try {
                $this->status = $status;
                
                $query = $this->con->conectar()->prepare("SELECT count(*) AS total
                FROM ordem WHERE status = ?");
                $query->bindParam(1,$this->status);
                $query->execute();
                $total = $query->fetchAll(PDO::FETCH_ASSOC);
                return $total;

            } catch (PDOException $ex) {
                return 'error'.$ex->getMessage();
            }
        }

        public function listaOrdem(){

            $query = $this->con->conectar()->prepare("SELECT
                                            o.cod AS cod,
                                            c.nome AS nome_cliente,
                                            t.nome AS nome_terceirizada,
                                            s.nome AS nome_servico,
                                            o.data_servico AS data_servico,
                                            o.status AS status
                                        FROM  
                                            ordem o,servico s, cliente c, 
                                            terceirizado t
                                        where 
                                            o.cod_cliente = c.cod AND
                                            o.cod_servico = s.cod AND
                                            o.cod_terceirizado = t.cod");
        
            $query->execute();
            $lista = $query->fetchAll(PDO::FETCH_ASSOC);
            return $lista;
        }

        public function buscaOrdemeditar($codigo){
            try {   
                $this->codigo = $codigo;

                $query = $this->con->conectar()->prepare("SELECT 
                                            o.cod AS cod,
                                            c.nome AS nome_cliente,
                                            t.nome AS nome_terceirizada,
                                            s.nome AS nome_servico,
                                            o.data_servico AS data_servico,
                                            o.status AS status,
                                            t.cod AS cod_terceirizado
                                        FROM 
                                            ordem o,
                                            servico s,
                                            cliente c,
                                            terceirizado t 
                                        WHERE 
                                            o.cod_cliente = c.cod AND 
                                            o.cod_servico = s.cod AND 
                                            o.cod_terceirizado = t.cod AND 
                                            o.cod = ?");
                $query->bindParam(1, $this->codigo);
                $query->execute();
                $dados = $query->fetch(PDO::FETCH_ASSOC);
        
            return $dados;
            } catch (PDOException $ex) {
                return 'error' . $ex->getMessage();
            }
        }

        public function editarOrdem($codigo,$cod_terceirizado,$data_servico,$status,$data){
            try {

                $this->codigo = $codigo;
                $this->cod_terceirizado = $cod_terceirizado;
                $this->data = $data_servico;
                $this->status = $status;
                $this->data = $data;


                $query = $this->con->conectar()->prepare("SELECT * FROM ordem WHERE cod = ?");
                $query->bindParam(1,$codigo);
                $query->execute();
                $retorno = $query->fetch(PDO::FETCH_ASSOC);
            
                if(count($retorno) > 0){
                    $query = $this->con->conectar()->prepare("UPDATE ordem SET cod_terceirizado = ?, data_servico = ?, status = ?, data = ? WHERE cod = ?");
                    $query->bindParam(1, $this->cod_terceirizado);
                    $query->bindParam(2, $this->data_servico);
                    $query->bindParam(3, $this->status);
                    $query->bindParam(4, $this->data);
                    $query->bindParam(5, $this->codigo);
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

        public function listaOrdemCliente(){
            try {
                $query = $this->con->conectar()->prepare("SELECT
                    o.cod AS cod,
                    c.nome AS nome_cliente,
                    t.nome AS nome_terceirizada,
                    s.nome AS nome_servico,
                    o.data_servico AS data_servico,
                    o.status AS status
                FROM  
                    ordem o,servico s, cliente c, 
                    terceirizado t
                where 
                    o.cod_cliente = c.cod AND
                    o.cod_servico = s.cod AND
                    o.cod_terceirizado = t.cod AND
                    o.cod_cliente = ?
                ORDER by o.status ASC");

                $query->bindParam(1, $_SESSION['cod_usu']);

                $query->execute();
                $lista = $query->fetchAll(PDO::FETCH_ASSOC);
                return $lista;
            } catch (PDOException $ex) {
                return 'error' . $ex->getMessage();
            }
        }
        
        public function listaOrdemTerceirizado(){
            try {
                $query = $this->con->conectar()->prepare("SELECT
                    o.cod AS cod,
                    c.nome AS nome_cliente,
                    t.nome AS nome_terceirizada,
                    s.nome AS nome_servico,
                    o.data_servico AS data_servico,
                    o.status AS status
                FROM  
                    ordem o,servico s, cliente c, 
                    terceirizado t
                where 
                    o.cod_cliente = c.cod AND
                    o.cod_servico = s.cod AND
                    o.cod_terceirizado = t.cod AND
                    o.cod_terceirizado = ?
                ORDER by o.status ASC");

                $query->bindParam(1, $_SESSION['cod_usu']);

                $query->execute();
                $lista = $query->fetchAll(PDO::FETCH_ASSOC);
                return $lista;
            } catch (PDOException $ex) {
                return 'error' . $ex->getMessage();
            }
        }

        public function buscaOrdemadd (){
            try {
                $query = $this->con->conectar()->prepare("Select 
                    c.nome AS nome_cliente,
                    t.nome AS nome_terceirizada,
                    s.nome AS nome_servico,
                    s.valor AS valor_servico,
                    o.data_servico AS data_servico,
                    o.status AS status
                From 
                    ordem o,servico s, cliente c,
                        terceirizado t 
                Where 
                    o.cod_cliente = c.cod AND 
                    o.cod_servico = s.cod AND 
                    o.cod_terceirizado = t.cod
                ORDER BY o.cod DESC LIMIT 1");
                $query->execute();
                $lista = $query->fetch(PDO::FETCH_ASSOC);
                return $lista;
            } catch (PDOException $ex) {
                return 'error' . $ex->getMessage();
            }
        }
        
    }
?>