<?php

class db {

    private $host = 'localhost';
    private $user = 'root';
    private $senha = '';
    private $database = 'twitter_clone';

    public function conecta_mysql(){
        $conection = mysqli_connect($this->host, $this->user, $this->senha, $this->database);

        mysqli_set_charset($conection, 'utf8');

        if(mysqli_connect_errno()){
            echo 'Erro ao conectar com base de dados ' .mysqli_connect_error();
        }
        return $conection;
    }

}

?>