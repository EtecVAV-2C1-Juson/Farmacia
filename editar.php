<?php 
require_once 'config/conexao.php';
require_once 'includes/header.php'; 

$id = $_GET['id'] ?? null;
$produto = null;

if ($id) {
    // 1. Busca os dados atuais para mostrar no formulário
    $sql = "SELECT * FROM produtos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);
}

// 2. Se o formulário for enviado, atualiza os dados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "UPDATE produtos SET nome = :nome, fabricante = :fab, preco = :preco, estoque = :est WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome'  => $_POST['nome'],
        ':fab'   => $_POST['fabricante'],
        ':preco' => $_POST['preco'],
        ':est'   => $_POST['estoque'],
        ':id'    => $_POST['id']
    ]);
    header("Location: visualizar.php?msg=editado");
    exit;
}
?>

<main class="container">
    <h2>✏️ Editar Produto</h2>
    <?php if ($produto): ?>
        <form method="POST" class="form-style">
            <input type="hidden" name="id" value="<?= $produto['id'] ?>">
            
            <label>Nome do Medicamento:</label>
            <input type="text" name="nome" value="<?= $produto['nome'] ?>" required>
            
            <label>Fabricante:</label>
            <input type="text" name="fabricante" value="<?= $produto['fabricante'] ?>" required>
            
            <label>Preço (R$):</label>
            <input type="number" step="0.01" name="preco" value="<?= $produto['preco'] ?>" required>
            
            <label>Estoque:</label>
            <input type="number" name="estoque" value="<?= $produto['estoque'] ?>" required>
            
            <button type="submit" class="btn-acao">Atualizar Dados</button>
            <a href="visualizar.php" class="btn-cancelar">Cancelar</a>
        </form>
    <?php else: ?>
        <p>Produto não encontrado.</p>
    <?php endif; ?>
</main>

<?php require_once 'includes/footer.php'; ?>