<?php

/** 
 * Author: Tiago César da Silva Lopes
 * Description: Repository of functions of 'despensas'
 * Date: 15/02/23
 */

namespace Model;


require_once "conexao.php";
class Despensas_repositorio
{

    public function cadastro_entrada($descricao, $valor, $data, $ano, $quinzena, $idstatus_Mes, $idStatus_despensa , $pdo)
    {
        try {
        
        // echo $idStatus_despensa;

        require_once "../view/conexao.php";
        // $sql = "Insert into clientes (descricao, valor, data, ano, quinzena, idstatus_Mes, idStatus_Despensa)
        //         Values ({$descricao}, {$valor}, {$data}, {$ano}, {$quinzena}, {$idstatus_Mes}, {$idStatus_despensa})";

        $stmt =  $pdo->prepare('INSERT INTO despensas (descricao, valor, dataDespensa, ano, quinzena, idstatus_Mes, idStatus_despensa)
        VALUES (:descricao , :valor , :dataDespensa , :ano , :quinzena , :idstatus_Mes , :statusDespensa )  ');
        
        $stmt->execute(array(
            ':descricao' => $descricao ,
            ':valor' => $valor ,
            ':dataDespensa' => $data ,
            ':ano' => $ano ,
            ':quinzena' => $quinzena ,
            ':idstatus_Mes' => $idstatus_Mes ,
            ':statusDespensa' => '3'
        ));

        // echo "funcionou!!";


        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }


    public function cadastro_StatusDespensas($nome , $pdo)
    {
        require_once "../view/conexao.php";
        try {

        $stmt =  $pdo->prepare('INSERT INTO status_despensas (nome) VALUES (:nome) ');
        
        $stmt->execute(array(
            ':nome' => $nome 
        ));

        // echo "funcionou!!";


        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }


    public function consultarRegistro($descricao, $valor, $dataDespensa ,$pdo ){
        $consulta = $pdo->query("SELECT * FROM despensas WHERE descricao = '{$descricao}' and valor = '{$valor}' and dataDespensa = '{$dataDespensa}'   ;");
        
        var_dump( $consulta);

        while ($linha = $consulta->fetch(\PDO::FETCH_ASSOC)) {
            if ($descricao = $linha['descricao'] && $valor = $linha['valor'] && $dataDespensa = $linha['dataDespensa']){
                // ECHO "tá igual";
                return true;
            }
        }

        return false;
    
    }


    public function excluir_registro($descricao, $valor, $data, $ano, $quinzena, $idstatus_Mes, $idStatus_despensa , $pdo)
    {
        require_once "../view/conexao.php";

        try {
            $stmt = $pdo->prepare('DELETE FROM despensas WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
          
            echo $stmt->rowCount();
          } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
          }



    }

}
