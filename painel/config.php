<?php

class Configuration {

    private $pdo;
    public $msgErro = "";

    public function conectar($nome, $host, $usuario, $senha) {
        try {
            $this->pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->msgErro = "Erro ao conectar ao banco de dados: " . $e->getMessage();
        }        
    }

    public function inserir($numsinan, $unidade, $cnes, $semana, $lote, $situacao) {
        //verifica se já existe cadastro
        $sql = $this->pdo->prepare("SELECT id FROM semana WHERE unidade = :u AND semana_epidemiologica = :s");
        $sql->bindValue(":u", $unidade);
        $sql->bindValue(":s", $semana);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return false; //já cadastrado
        } else {
            $sql = $this->pdo->prepare("INSERT INTO semana(numero, unidade, cnes, semana_epidemiologica, lote, situacao)
                                       VALUES (:n, :u, :c, :s, :l, :i)"); 
            $sql->bindValue(":n", $numsinan);
            $sql->bindValue(":u", $unidade);
            $sql->bindValue(":c", $cnes);
            $sql->bindValue(":s", $semana);
            $sql->bindValue(":l", $lote);
            $sql->bindValue(":i", $situacao);
            $sql->execute();
            return true;
        }
    }

    public function inserirFaixa($inicio, $fim) {
        //verifica se já existe cadastro
        $sql = $this->pdo->prepare("SELECT id FROM numero WHERE inicio = :i");
        $sql->bindValue(":i", $inicio);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return false; //já cadastrado
        } else {
            $sql = $this->pdo->prepare("INSERT INTO numero(inicio, fim) VALUES (:i, :f)"); 
            $sql->bindValue(":i", $inicio);
            $sql->bindValue(":f", $fim);
            $sql->execute();
            return true;
        }
    }

    public function listar() {
        try {
            $sql = "SELECT * FROM semana";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erro na consulta: " . $e->getMessage());
        }
    }

    public function atualizar($id, $numsinan, $unidade, $cnes, $semana, $lote, $situacao) {
        try {
            $sql = "UPDATE semana SET numero = :num, unidade = :uni, cnes = :cnes, semana_epidemiologica = :sem, lote = :lot, situacao = :sit WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->bindValue(":num", $numsinan);
            $stmt->bindValue(":uni", $unidade);
            $stmt->bindValue(":cnes", $cnes);
            $stmt->bindValue(":sem", $semana);
            $stmt->bindValue(":lot", $lote);
            $stmt->bindValue(":sit", $situacao);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die("Erro na atualização: " . $e->getMessage());
        }
    }
}

?>
