<?php

/** 
 * Author: Tiago César da Silva Lopes
 * Description: Repository of functions of 'Poupancas'
 * Date: 03/03/23
 */

namespace Model;

use model\Despensas;

require_once "conexao.php";
class Poupancas_repositorio
{

    public function cadastro_entrada($descricao, $valor, $data, $ano, $idStatus_despensa , $pdo)
    {
        try {
        
        // echo $idStatus_despensa;

        require_once "../view/conexao.php";
        // $sql = "Insert into clientes (descricao, valor, data, ano, quinzena, idstatus_Mes, idStatus_Despensa)
        //         Values ({$descricao}, {$valor}, {$data}, {$ano}, {$quinzena}, {$idstatus_Mes}, {$idStatus_despensa})";

        $stmt =  $pdo->prepare('INSERT INTO Poupancas (descricao, valor, dataPoupanca, ano, idStatus_despensa , idUsuario)
        VALUES (:descricao , :valor , :dataPoupanca , :ano , :statusDespensa, :idUsuario )  ');
        
        $stmt->execute(array(
            ':descricao' => $descricao ,
            ':valor' => $valor ,
            ':dataPoupanca' => $data ,
            ':ano' => $ano ,
            ':statusDespensa' => $idStatus_despensa,
            ':idUsuario' => 1
        ));

        // echo "funcionou!!";


        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    public function cadastro_Saida($descricao, $valor, $data, $ano, $idStatus_despensa , $pdo)
    {
        try {
        
        // echo $idStatus_despensa;

        require_once "../view/conexao.php";
        // $sql = "Insert into clientes (descricao, valor, data, ano, quinzena, idstatus_Mes, idStatus_Despensa)
        //         Values ({$descricao}, {$valor}, {$data}, {$ano}, {$quinzena}, {$idstatus_Mes}, {$idStatus_despensa})";

        $stmt =  $pdo->prepare('INSERT INTO Poupancas (descricao, valor, dataPoupanca, ano, idStatus_despensa , idUsuario)
        VALUES (:descricao , :valor , :dataPoupanca , :ano , :quinzena , :idstatus_Mes , :statusDespensa, :idUsuario )  ');
        
        $stmt->execute(array(
            ':descricao' => $descricao ,
            ':valor' => $valor ,
            ':dataPoupanca' => $data ,
            ':ano' => $ano ,
            ':statusDespensa' => $idStatus_despensa,
            ':idUsuario' => 1
        ));

        // echo "funcionou!!";


        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }


    public function consultarRegistro($descricao, $valor, $dataPoupanca , $idStatus_despensa ,$pdo ){
        
        $consulta = $pdo->query("SELECT * FROM poupancas WHERE descricao = '{$descricao}' and valor = '{$valor}' and dataPoupanca = '{$dataPoupanca}' and idStatus_despensa = '{$idStatus_despensa}'   ;");
        
       // var_dump( $consulta);

        while ($linha = $consulta->fetch(\PDO::FETCH_ASSOC)) {
            if ($descricao = $linha['descricao'] && $valor = $linha['valor'] && $dataPoupanca = $linha['dataPoupanca']){
                // ECHO "tá igual";
                return true;
            }
        }

        return false;
    
    }


    public function consultaById($id ,$pdo ){
        $consulta = $pdo->query("SELECT * FROM despensas WHERE id = '{$id}'   ;");
        
      //  var_dump( $consulta);

        while ($linha = $consulta->fetch(\PDO::FETCH_ASSOC)) {
            $Despensas = new Despensas();

            $Despensas->setDescricao($linha['descricao']);
            $Despensas->setValor($linha['valor']);
            $Despensas->setData($linha['dataPoupanca']);
            $Despensas->setAno($linha['ano']);
            $Despensas->setQuinzena($linha['quinzena']);
            $Despensas->setStatus($linha['status']);
        }

        return $Despensas;
    
    }

    public function excluir_registro($id , $pdo)
    {
        require_once "../view/conexao.php";

        try {
            $stmt = $pdo->prepare('DELETE FROM despensas WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
          
            // echo $stmt->rowCount();
          } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
          }



    }


    public function alterar($descricao, $valor, $dataPoupanca, $id , $pdo)
    {
        require_once "../view/conexao.php";
        try {

        $stmt =  $pdo->prepare('Update despensas  SET descricao = (:descricao), valor = (:valor) , dataPoupanca = (:dataPoupanca) , updated = current_time()

        Where id = (:id)');
        
        $stmt->execute(array(
            ':descricao' => $descricao, 
            ':valor' => $valor, 
            ':dataPoupanca' => $dataPoupanca, 
            ':id' => $id, 
        ));

        // echo "funcionou!!";


        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

}
