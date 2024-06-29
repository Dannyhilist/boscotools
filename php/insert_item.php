<?php
require 'config.php';

header('Content-Type: text/plain');

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $quantidade = $_POST['quantidade'];
        $descricao = $_POST['descricao'];
        $preco_unitario = $_POST['preco_unitario'];
        $data_cadastro = $_POST['data_cadastro'];

        if (empty($nome) || empty($quantidade) || empty($preco_unitario) || empty($data_cadastro)) {
            throw new Exception("Por favor, preencha todos os campos obrigatórios.");
        }

        $sql = "INSERT INTO materiais (nome, quantidade, descricao, preco_unitario, data_cadastro)
                VALUES (:nome, :quantidade, :descricao, :preco_unitario, :data_cadastro)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco_unitario', $preco_unitario);
        $stmt->bindParam(':data_cadastro', $data_cadastro);

        $stmt->execute();
        echo "O item já está disponível no estoque!";
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
} catch (PDOException $e) {
    echo "Erro no banco de dados: " . $e->getMessage();
}

$conn = null;
?>
