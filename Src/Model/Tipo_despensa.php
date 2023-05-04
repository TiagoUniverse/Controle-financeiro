<?php

/**
 * ╔═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════╗
 * ║                                               CONTROLE FINANCEIRO                                                 ║
 * ║  ┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────┐  ║
 * ║  │ @description: Class model of tipo_despensa                                                                  │  ║
 * ║  | @dir: Model                                                                                                 │  ║
 * ║  │ @author: Tiago César da Silva Lopes                                                                         │  ║
 * ║  │ @date: 04/05/23                                                                                             │  ║
 * ║  └─────────────────────────────────────────────────────────────────────────────────────────────────────────────┘  ║
 * ║═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════║
 */

 namespace model;

 Class tipo_despensa{

    private int $id;

    private string $nome;

    private string $descricao;

    private string $created;


    public function __construct()
    {
        
    }

    public function getId() : int{
        return $this->id;
    }

    public function getNome() : string {
        return $this->nome;
    }

    public function getDescricao() : string {
        return $this->descricao;
    }

    public function getCreated() : string{
        return $this->created;
    }


    public function setId(int $id){
        $this->id = $id;
    }

    public function setNome(string $nome){
        $this->nome = $nome;
    }

    public function setDescricao(string $descricao){
        $this->descricao = $descricao;
    }

    public function setCreated(string $created){
        $this->created = $created;
    }

 }