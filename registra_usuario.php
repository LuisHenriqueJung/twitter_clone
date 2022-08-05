<?php
require_once 'db_class.php';

$usuario_existe = false;
$email_existe = false;

$usuario = $_POST["usuario"];
$email = $_POST["email"];
$senha = md5($_POST["senha"]);

$objConexao = new db();
$conexao = $objConexao->conecta_mysql();

$sql = "SELECT * FROM usuario WHERE usuario = '$usuario'";

if($resultado_id = mysqli_query($conexao,$sql)){

    $dados_usuario = mysqli_fetch_array($resultado_id);

    if(isset($dados_usuario['usuario'])){
        $usuario_existe = true;
    }else{
        echo 'Usuário disponível';
    }
}
$sql = "SELECT * FROM usuario WHERE email = '$email'";

if($resultado_id = mysqli_query($conexao, $sql)){

    $dados_usuario = mysqli_fetch_array($resultado_id);

    if(isset($dados_usuario['email'])){
        $email_existe = true;
    }else{
        echo 'E-mail disponível';
    }

}
if($usuario_existe || $email_existe){
    $retorno_get = '';
    if($usuario_existe){
        $retorno_get.= "erro_usuario=1&";
    }
    if($email_existe){
        $retorno_get.= "erro_email=1&";
    }
    header('Location: inscrevase.php?' .$retorno_get);
}


$sql = " INSERT INTO usuario(usuario, email, senha) VALUES ('$usuario', '$email', '$senha')";

 //executar a query
 if(mysqli_query($conexao, $sql)){
    echo "Usuário registrado com sucesso!";
}else{
    echo "Erro ao registrar o usuário!";
}
?>