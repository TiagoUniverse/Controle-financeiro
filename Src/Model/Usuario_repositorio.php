<?php

/**
 * ╔═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════╗
 * ║                                               CONTROLE FINANCEIRO                                                 ║
 * ║  ┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────┐  ║
 * ║  │ @description: Repository of 'Usuario'                                                                       │  ║
 * ║  | @dir: Model                                                                                                 │  ║
 * ║  │ @author: Tiago César da Silva Lopes                                                                         │  ║
 * ║  │ @date: 08/03/23                                                                                             │  ║
 * ║  └─────────────────────────────────────────────────────────────────────────────────────────────────────────────┘  ║
 * ║═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════║
 */

 namespace model;

 class Usuario_repositorio{

    public function cadastrar($nome,  $email, $senha , $pdo){
        try{

            $stmt = $pdo->prepare("Insert INTO Usuario (nome, email, senha)
            VALUES ( :nome , :email , sha1( :senha )  ) ");

            $stmt->execute(array(
                ':nome' => $nome ,
                ':email' => $email ,
                ':senha' => $senha
            ));

        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

 }