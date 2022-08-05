<?php

    session_start();
    require_once 'db_class.php';
    
    $usuario = $_POST["usuario"];
    $senha = md5($_POST["senha"]);

    $sql = " SELECT * FROM usuario WHERE usuario = '$usuario' AND senha = '$senha'";

    $objConexao = new db();
    $conexao = $objConexao->conecta_mysql();
    $resultado_id = mysqli_query($conexao, $sql);

    if($resultado_id){
        $dados_usuario = mysqli_fetch_array($resultado_id);

        if(isset($dados_usuario['usuario'])){

            $_SESSION['usuario'] = $dados_usuario['usuario'];
            $_SESSION['email'] = $dados_usuario['email'];
            
            header('Location: home.php');
        }else{
            header('Location: index.php?erro=1');
        }
    }else{
        echo 'Erro na execução da consulta';
    }

?>