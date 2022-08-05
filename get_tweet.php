<?php

session_start();

if(!isset($_SESSION['usuario'])){
    header('Location: index.php?erro=1');
}

require_once 'db_class.php';


$id_usuario = $_SESSION['id_usuario'];

$sql = "SELECT DATE_FORMAT(t.data_inclusao,'%d %b %Y %T') as data_inclusao_formatada, t.tweet,u.usuario FROM tweet AS t JOIN usuario AS u ON (t.id_usuario = u.id) WHERE id_usuario = $id_usuario ORDER BY data_inclusao DESC";

$objConexao = new db();
$conexao = $objConexao->conecta_mysql();
$resultado_id = mysqli_query($conexao, $sql);



$resultado_id = mysqli_query($conexao, $sql);

if($resultado_id){

    while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
        echo'<a href="#" class="list-group-item">';
            echo '<h4 class="list-group-item-heading"> '.$registro['usuario'].'<small> - '.$registro['data_inclusao_formatada'].'</small></h4>';
            echo '<p class= "list-group-item-text">'.$registro['tweet'].'</p>';
        echo '</a>';
    }

}else{
    echo 'Erro ao carregar tweets!';
}


?>