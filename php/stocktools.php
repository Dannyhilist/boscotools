<?php
require 'config.php';

// Função para evitar XSS
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// Verifica se há ação de exclusão
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $stmt = $conn->prepare("DELETE FROM materiais WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        echo "Item excluído com sucesso.";
    } catch (PDOException $e) {
        echo "Erro ao tentar excluir o item: " . $e->getMessage();
    }
}

// Lista todos os itens
try {
    $sql = "SELECT * FROM materiais";
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar os itens: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bosco Tools - Estoque</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="../css/stocktools.css">
</head>
<body>

    <div>
        <h2>ESTOQUE ATUAL</h2>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantidade</th>
                    <th>Descrição</th>
                    <th>Preço Unitário (R$)</th>
                    <th>Data de Cadastro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo h($row['nome']); ?></td>
                        <td><?php echo h($row['quantidade']); ?></td>
                        <td><?php echo h($row['descricao']); ?></td>
                        <td><?php echo h($row['preco_unitario']); ?></td>
                        <td><?php echo h($row['data_cadastro']); ?></td>
                        <td>
                            <a class="edit_btn" href="edit_item.php?id=<?php echo h($row['id']); ?>">Editar</a> |
                            <a class="delete_btn" href="?action=delete&id=<?php echo h($row['id']); ?>" onclick="return confirm('Tem certeza que deseja excluir este item?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div>
        <button class="back_btn">
            <a href="../index.html">Voltar ao Cadastro de Itens</a>
        </button>
    </div>

</body>
</html>

<?php
$conn = null;
?>
