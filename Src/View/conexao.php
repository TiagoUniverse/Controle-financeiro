<?php

$hostname = "localhost";
$bancodedados = "padaria";
$usuario = "root";
$senha = "";

$mysqli = new mysqli ($hostname, $usuario, $senha, $bancodedados);
if ($mysqli->connect_errno){
    die ("Falha ao conectar : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}