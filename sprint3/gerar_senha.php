<?php
    $senha = "555";
    $hash_admin = password_hash($senha, PASSWORD_DEFAULT);
    $hash_usuario = password_hash($senha, PASSWORD_DEFAULT);

    echo "Hash para admin:" . $hash_admin . "<br>";
    echo "Hash para usuario:" . $hash_usuario . "<br>";
    echo $senha;
    
?>