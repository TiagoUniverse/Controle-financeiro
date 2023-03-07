<?php


if ($adicionando_registro != null && $adicionando_registro == "SALVANDO REGISTRO ENTRADA") {

    // Mensagem do resultado
    if ($mensagemVermelha) {
    echo "       <div class="alert alert-danger" role='alert'> "
    
    }else{
    ?>
        <div class="alert alert-success" role="alert">
    <?php
    }

    echo $mensagem;
    ?>
        </div>
    <?php

}