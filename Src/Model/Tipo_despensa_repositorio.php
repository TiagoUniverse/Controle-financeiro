<?php

/**
 * ╔═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════╗
 * ║                                               CONTROLE FINANCEIRO                                                 ║
 * ║  ┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────┐  ║
 * ║  │ @description: Repository of 'Tipo_despensa'                                                                 │  ║
 * ║  | @dir: Model                                                                                                 │  ║
 * ║  │ @author: Tiago César da Silva Lopes                                                                         │  ║
 * ║  │ @date: 04/05/23                                                                                             │  ║
 * ║  └─────────────────────────────────────────────────────────────────────────────────────────────────────────────┘  ║
 * ║═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════║
 */

namespace model;

use PDOException;

class Tipo_despensa_repositorio{

    public function listar($tipo_despensa, $pdo){
        try{

            $stmt = $pdo->prepare ("Select * from tipo_despensas");

            $stmt->execute();

            $listagem = array();

            while ($linha = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $tipo_despensa = new tipo_despensa();

                $tipo_despensa->setId($linha['id']);
                $tipo_despensa->setNome($linha['nome']);
                $tipo_despensa->setDescricao($linha['descricao']);
                $tipo_despensa->setCreated($linha['created']);

                // var_dump($tipo_despensa);

                $listagem[] = $tipo_despensa;

            }

            var_dump($listagem);

            return $listagem;

        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


}
