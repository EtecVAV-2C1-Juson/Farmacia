<?php 
require_once 'config/conexao.php';
require_once 'includes/header.php'; 

try {
    $sql = "SELECT * FROM produtos ORDER BY nome ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao consultar: " . $e->getMessage());
}
?>

<main class="container">
    <div class="topo-lista">
        <h2>Estoque de Medicamentos</h2>
        <a href="cadastro.php" class="btn-novo">+ Novo Cadastro</a>
    </div>

    <div class="tabela-responsiva">
        <table class="tabela-estoque">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Fabricante</th>
                    <th>Preço</th>
                    <th>Qtd</th>
                    <th style="text-align: center;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($produtos): ?>
                    <?php foreach ($produtos as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><strong><?= $p['nome'] ?></strong></td>
                        <td><?= $p['fabricante'] ?></td>
                        <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
                        <td><?= $p['estoque'] ?></td>
                        <td class="acoes">
                            <a href="editar.php?id=<?= $p['id'] ?>" class="btn-editar">✏️</a>
                            <a href="excluir.php?id=<?= $p['id'] ?>" class="btn-excluir" 
                               onclick="return confirm('Excluir <?= $p['nome'] ?>?')">🗑️</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="celula-vazia">
                            <div class="msg-vazia">O estoque está atualmente vazio.</div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>