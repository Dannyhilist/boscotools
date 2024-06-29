<?php
require 'config.php';

// Verifica se os dados foram submetidos via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos necessários estão presentes
    if (isset($_POST['id'], $_POST['nome'], $_POST['quantidade'], $_POST['descricao'], $_POST['preco_unitario'], $_POST['data_cadastro'])) {
        // Obtém os dados do formulário
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $quantidade = $_POST['quantidade'];
        $descricao = $_POST['descricao'];
        $preco_unitario = $_POST['preco_unitario'];
        $data_cadastro = $_POST['data_cadastro'];

        try {
            // Query para atualizar o item no banco de dados
            $sql = "UPDATE materiais SET nome = :nome, quantidade = :quantidade, descricao = :descricao, preco_unitario = :preco_unitario, data_cadastro = :data_cadastro WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':quantidade', $quantidade);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':preco_unitario', $preco_unitario);
            $stmt->bindParam(':data_cadastro', $data_cadastro);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Redireciona de volta para a página de estoque após a atualização
            header("Location: stocktools.php");
            exit();
        } catch (PDOException $e) {
            echo "Erro ao tentar atualizar o item: " . $e->getMessage();
        }
    } else {
        echo "Todos os campos devem ser preenchidos.";
    }
} else {
    // Se não for um pedido POST, redireciona para a página de estoque
    header("Location: stocktools.php");
    exit();
}
?>