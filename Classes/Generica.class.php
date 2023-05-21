<?php
require_once("Conexao.class.php");

class Generica
{
    private $con;
    private $tabela;
    private $codigo;
    private $status;
    private $data;

    public function __construct()
    {
        $this->con = new Conexao();
    }

    public function checaLogin($tabela, $email, $senha)
    {
        try {

            $this->tabela = $tabela;
            $senhamd5 = md5($senha);

            $query = $this->con->conectar()->prepare("SELECT * FROM $this->tabela WHERE email = ? AND senha = ?");
            $query->bindParam(1, $email);
            $query->bindParam(2, $senhamd5);
            $query->execute();
            $retorno = $query->fetch(PDO::FETCH_ASSOC);

            return $retorno;
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

    public function buscaDadoseditarPerfil($tabela, $codigo)
    {
        try {

            $this->tabela = $tabela;
            $this->codigo = $codigo;

            $query = $this->con->conectar()->prepare("SELECT * FROM $this->tabela
                            WHERE cod = ?");

            $query->bindParam(1, $this->codigo);
            $query->execute();
            $lista = $query->fetch(PDO::FETCH_ASSOC);

            return $lista;
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

    public function editarSenha($tabela, $codigo, $senha)
    {
        try {

            $this->tabela = $tabela;

            $query = $this->con->conectar()->prepare("SELECT * FROM $this->tabela WHERE cod = ?");
            $query->bindParam(1, $codigo);
            $query->execute();
            $retorno = $query->fetch(PDO::FETCH_ASSOC);
            if (count($retorno) > 0) {
                $query = $this->con->conectar()->prepare("UPDATE $this->tabela SET senha = ? WHERE cod = ?");
                $query->bindParam(1, $senha);
                $query->bindParam(2, $codigo);
                $retorno = $query->execute(); //retorno boolean padrao TRUE
                if ($retorno) {
                    return 1;
                } else {
                    return 0;
                }
            }
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

    public function consultaEmail($tabela,$email){
        try {

            $this->tabela = $tabela;

            $query = $this->con->conectar()->prepare("SELECT * FROM $this->tabela
                        WHERE email = ?");
        
            $query->bindParam(1,$email);
            $query->execute();
            $retorno = $query->fetch(PDO::FETCH_ASSOC);
            if ($retorno) {
                return 1;
            }else{
                return 0;
            }   
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

    public function removeDados($tabela,$codigo){
        try {

            $this->tabela = $tabela;
            
            $query = $this->con->conectar()->prepare("DELETE FROM $this->tabela
            WHERE cod = ?");

            $query->bindParam(1,$codigo);
            $query->execute();
            $retorno = $query->execute();
            if ($retorno) {
                return 1;
            }else{
                return 0;
            }
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

    public function listaDados($tabela){
        try {

            $this->tabela = $tabela;

            $query = $this->con->conectar()->prepare("SELECT * FROM $this->tabela
                    ORDER BY nome");
    
            $query->execute();
            $lista = $query->fetchAll(PDO::FETCH_ASSOC);
    
        return $lista;
        } catch (PDOException $ex){
            return 'error'.$ex->getMessage(); 
        }
    }

    public function cadastrarDados($tabela, $dados){
        try {
            $colunas = array_keys($dados);
            $valores = array_values($dados);
            $parametros = implode(",", array_fill(0, count($colunas), "?"));
            
            $query = $this->con->conectar()->prepare("INSERT INTO $tabela (".implode(",", $colunas).") VALUES ($parametros)");
            
            $i = 1;
            foreach ($valores as $valor) {
                $query->bindValue($i++, $valor);
            }
            
            $retorno = $query->execute();
            if ($retorno) {
                return 1;
            } else {
                return 0;
            }
        } catch (PDOException $ex) {
            return 'error'.$ex->getMessage();
        }
    }

    public function queryEditar ($tabela,$codigo,$status,$data){
        try {

            $this->tabela = $tabela;
            $this->codigo = $codigo;
            $this->status = $status;
            $this->data = $data;
            
            $query = $this->con->conectar()->prepare("SELECT * FROM $this->tabela WHERE cod = ?");
            $query->bindParam(1,$codigo);
            $query->execute();
            $retorno = $query->fetch(PDO::FETCH_ASSOC);
        
            if(count($retorno) > 0){
                $query = $this->con->conectar()->prepare("UPDATE $this->tabela SET status = ?, data = ? WHERE cod = ?");
                $query->bindParam(1, $status);
                $query->bindParam(2, $data);
                $query->bindParam(3, $codigo);
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
