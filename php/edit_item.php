<?php
require 'config.php';

// Verifica se o ID do item a ser editado foi passado via GET
if (!isset($_GET['id'])) {
    exit("ID do item não especificado.");
}

// Obtém o ID do item a ser editado
$id = $_GET['id'];

// Query para selecionar o item específico pelo ID
try {
    $stmt = $conn->prepare("SELECT * FROM materiais WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$item) {
        exit("Item não encontrado.");
    }
} catch (PDOException $e) {
    echo "Erro ao buscar o item: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Item - Bosco Tools</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="../css/editem.css">
</head>
<body>

    <div>
        <h2>Editar Item</h2>
        <form action="update_item.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
            <label for="nome">Item:</label><br>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($item['nome'], ENT_QUOTES, 'UTF-8'); ?>"><br><br>
            <label for="quantidade">Quantidade:</label><br>
            <input type="number" id="quantidade" name="quantidade" value="<?php echo $item['quantidade']; ?>"><br><br>
            <label for="descricao">Descrição:</label><br>
            <input type="text" id="descricao" name="descricao" value="<?php echo htmlspecialchars($item['descricao'], ENT_QUOTES, 'UTF-8'); ?>"><br><br>
            <label for="preco_unitario">Preço Unitário (R$):</label><br>
            <input type="number" step="0.01" id="preco_unitario" name="preco_unitario" value="<?php echo $item['preco_unitario']; ?>"><br><br>
            <label for="data_cadastro">Data de Cadastro:</label><br>
            <input type="date" id="data_cadastro" name="data_cadastro" value="<?php echo $item['data_cadastro']; ?>"><br><br>
            <input type="submit" value="Salvar Alterações">
        </form>
    </div>

    <div>
        <button class="cancel_btn">
            <a href="stocktools.php">Cancelar Edição</a>
        </button>
    </div>

</body>
</html>

<?php
$conn = null;
?>
