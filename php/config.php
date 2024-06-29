<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stock_tools";

try {
    $conn = new PDO("mysql:host=$servername;charset=utf8;dbname=$dbname;charset=utf8", $username, $password);

    // executa exceções em caso de possíveis erros
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexão bem-sucedida! ";
} catch(PDOException $e) {
    echo "A conexão com seu banco falhou, dá um jeito nisso!" . $e->getMessage(); //MUDA A MENSAGEM!!!
}
?>
