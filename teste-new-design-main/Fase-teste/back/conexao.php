<?php
function novaConexao()
{
    $dsn = 'mysql:host=br612.hostgator.com.br;dbname=hubsap45_bd_studybuddy';
    $usuario = 'hubsap45_studybuddy_admin' ;
    $senha= 'studdy3udy#o9!!';

try
{
    $conexao = new PDO($dsn, $usuario,$senha);
    return $conexao;
}catch(PDOException $e)
{
    echo'erro ao tentar se conectar com o banco';
}
}
novaConexao();
?>

