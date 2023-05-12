<?php

/** 
 * Author: Tiago César da Silva Lopes
 * Description: Repository of functions of 'despensas'
 * Date: 15/02/23
 */

namespace Model;

use model\Despensas;

require_once "conexao.php";
class Despensas_repositorio
{

    public function cadastro_entrada($descricao, $valor, $data, $ano, $quinzena, $idstatus_Mes, $idStatus_despensa , $idUsuario , $tipo_despensa , $pdo)
    {
        try {
        
        // echo $idStatus_despensa;

       // require_once "../view/conexao.php";
        // $sql = "Insert into clientes (descricao, valor, data, ano, quinzena, idstatus_Mes, idStatus_Despensa)
        //         Values ({$descricao}, {$valor}, {$data}, {$ano}, {$quinzena}, {$idstatus_Mes}, {$idStatus_despensa})";

        $stmt =  $pdo->prepare('INSERT INTO despensas (descricao, valor, dataDespensa, ano, quinzena, idstatus_Mes, idStatus_despensa , idUsuario , idTipoDespensa)
        VALUES (:descricao , :valor , :dataDespensa , :ano , :quinzena , :idstatus_Mes , :statusDespensa , :idUsuario , :idTipoDespensa )  ');
        
        $stmt->execute(array(
            ':descricao' => $descricao ,
            ':valor' => $valor ,
            ':dataDespensa' => $data ,
            ':ano' => $ano ,
            ':quinzena' => $quinzena ,
            ':idstatus_Mes' => $idstatus_Mes ,
            ':statusDespensa' => $idStatus_despensa,
            ':idUsuario' => $idUsuario,
            ':idTipoDespensa' => $tipo_despensa
        ));

        // echo "funcionou!!";


        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    public function cadastro_Saida($descricao, $valor, $data, $ano, $quinzena, $idstatus_Mes, $idStatus_despensa , $idUsuario , $tipo_despensa, $pdo)
    {
        try {
        
        // echo $idStatus_despensa;

       // require_once "../view/conexao.php";
        // $sql = "Insert into clientes (descricao, valor, data, ano, quinzena, idstatus_Mes, idStatus_Despensa)
        //         Values ({$descricao}, {$valor}, {$data}, {$ano}, {$quinzena}, {$idstatus_Mes}, {$idStatus_despensa})";

        $stmt =  $pdo->prepare('INSERT INTO despensas (descricao, valor, dataDespensa, ano, quinzena, idstatus_Mes, idStatus_despensa , idUsuario , idTipoDespensa)
        VALUES (:descricao , :valor , :dataDespensa , :ano , :quinzena , :idstatus_Mes , :statusDespensa , :idUsuario , :idTipoDespensa )  ');
        

        $stmt->execute(array(
            ':descricao' => $descricao ,
            ':valor' => $valor ,
            ':dataDespensa' => $data ,
            ':ano' => $ano ,
            ':quinzena' => $quinzena ,
            ':idstatus_Mes' => $idstatus_Mes ,
            ':statusDespensa' => $idStatus_despensa,
            ':idUsuario' => $idUsuario,
            ':idTipoDespensa' => $tipo_despensa
        ));

        // echo "funcionou!!";


        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }


    public function cadastro_StatusDespensas($nome , $pdo)
    {
       // require_once "../view/conexao.php";
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



    public function listarGastos_Anuais($ano, $idStatusDespensa, $idUsuario , $pdo){
        try{

            $stmt = $pdo->prepare ("Select id, descricao, valor, DATE_FORMAT(dataDespensa, '%d/%m/%Y') as dataDespensa, ano, quinzena, IdStatus_mes, idTipoDespensa 
            from despensas where status = 'ATIVO' 
            and ano = :ano  and ( idstatus_despensa = :idStatusDespensa )  and idUsuario = :idUsuario   Order By month(dataDespensa)");

            $stmt->execute(array(
                ':ano' => $ano,
                'idStatusDespensa' => $idStatusDespensa,
                'idUsuario' => $idUsuario
            ));

            $somatorio = 0;

            while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $somatorio += $linha['valor'];
            }
            // var_dump($somatorio);
            return $somatorio;

        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    public function listarGastosMensais_ByAno($ano, $idStatusDespensa, $idUsuario , $idStatusMes, $pdo){
        try{

            $stmt = $pdo->prepare ("Select id, descricao, valor, DATE_FORMAT(dataDespensa, '%d/%m/%Y') as dataDespensa, ano, quinzena, IdStatus_mes, idTipoDespensa 
            from despensas where status = 'ATIVO'  and IdStatus_mes = :idStatusMes
            and ano = :ano  and ( idstatus_despensa = :idStatusDespensa )  and idUsuario = :idUsuario   Order By month(dataDespensa)");

            $stmt->execute(array(
                'idStatusMes' => $idStatusMes,
                ':ano' => $ano,
                'idStatusDespensa' => $idStatusDespensa,
                'idUsuario' => $idUsuario
            ));

            $somatorio = 0;

            while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $somatorio += $linha['valor'];
            }
            // var_dump($somatorio);
            return $somatorio;

        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    public function listarGastosAnuais_ByTipoDespensa($ano, $idStatusDespensa, $idUsuario , $idTipoDespensa, $pdo){
        try{

            $stmt = $pdo->prepare ("Select id, descricao, valor, DATE_FORMAT(dataDespensa, '%d/%m/%Y') as dataDespensa, ano, quinzena, IdStatus_mes, idTipoDespensa 
            from despensas where status = 'ATIVO'  and idTipoDespensa = :idTipoDespensa
            and ano = :ano  and ( idstatus_despensa = :idStatusDespensa )  and idUsuario = :idUsuario   Order By month(dataDespensa)");

            $stmt->execute(array(
                ':idTipoDespensa' => $idTipoDespensa,
                ':ano' => $ano,
                'idStatusDespensa' => $idStatusDespensa,
                ':idUsuario' => $idUsuario
            ));

            $somatorio = 0;

            while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $somatorio += $linha['valor'];
            }
            // var_dump($somatorio);
            return $somatorio;

        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    public function listarGastosMensais_ByTipoDespensa($ano, $idStatusDespensa, $idUsuario , $idTipoDespensa, $idStatusMes , $pdo){
        try{

            $stmt = $pdo->prepare ("Select id, descricao, valor, DATE_FORMAT(dataDespensa, '%d/%m/%Y') as dataDespensa, ano, quinzena, IdStatus_mes, idTipoDespensa 
            from despensas where status = 'ATIVO'  and idTipoDespensa = :idTipoDespensa and idStatus_mes = :idStatusMes
            and ano = :ano  and ( idstatus_despensa = :idStatusDespensa )  and idUsuario = :idUsuario   Order By month(dataDespensa)");

            $stmt->execute(array(
                ':idTipoDespensa' => $idTipoDespensa,
                ':idStatusMes' => $idStatusMes,
                ':ano' => $ano,
                'idStatusDespensa' => $idStatusDespensa,
                ':idUsuario' => $idUsuario
            ));

            $somatorio = 0;

            while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $somatorio += $linha['valor'];
            }
            // var_dump($somatorio);
            return $somatorio;

        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }




    public function consultarRegistro($descricao, $valor, $dataDespensa , $idStatus_despensa ,$pdo ){
        
        $consulta = $pdo->query("SELECT * FROM despensas WHERE descricao = '{$descricao}' and valor = '{$valor}' and dataDespensa = '{$dataDespensa}' and idStatus_despensa = '{$idStatus_despensa}'   ;");
        
       // var_dump( $consulta);

        while ($linha = $consulta->fetch(\PDO::FETCH_ASSOC)) {
            if ($descricao = $linha['descricao'] && $valor = $linha['valor'] && $dataDespensa = $linha['dataDespensa']){
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
            $Despensas->setData($linha['dataDespensa']);
            $Despensas->setAno($linha['ano']);
            $Despensas->setQuinzena($linha['quinzena']);
            $Despensas->setStatus($linha['status']);
            $Despensas->setIdTipoDespensa($linha['idTipoDespensa']);
        }

        return $Despensas;
    
    }

    public function excluir_registro($id , $pdo)
    {
       // require_once "../view/conexao.php";

        try {
            $stmt = $pdo->prepare('DELETE FROM despensas WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
          
            // echo $stmt->rowCount();
          } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
          }



    }


    public function alterar($descricao, $valor, $dataDespensa, $id , $idTipoDespensa, $pdo)
    {
       // require_once "../view/conexao.php";
        try {

        $stmt =  $pdo->prepare('Update despensas  SET descricao = (:descricao), valor = (:valor) , dataDespensa = (:dataDespensa) , idTipoDespensa = (:idTipoDespensa), 
        updated = current_time()

        Where id = (:id)');
        
        $stmt->execute(array(
            ':descricao' => $descricao, 
            ':valor' => $valor, 
            ':dataDespensa' => $dataDespensa, 
            ':id' => $id, 
            'idTipoDespensa' => $idTipoDespensa
        ));

        // echo "funcionou!!";


        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

}
