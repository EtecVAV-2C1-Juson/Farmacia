<?php 
// 1. Inclui a conexão e o cabeçalho (Modularização)
require_once 'config/conexao.php';
require_once 'includes/header.php';

// Lógica de Inserção (C do CRUD)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pegamos os dados do formulário
    $nome = $_POST['nome'];
    $fabricante = $_POST['fabricante'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];

    try {
        // 2. PREPARAR: Usamos os "buracos" (:nome, etc) para segurança contra SQL Injection
        $sql = "INSERT INTO produtos (nome, fabricante, preco, estoque) VALUES (:nome, :fab, :preco, :est)";
        $stmt = $pdo->prepare($sql);

        // 3. EXECUTAR: O PDO vincula os valores com segurança
        $sucesso = $stmt->execute([
            ':nome'  => $nome,
            ':fab'   => $fabricante,
            ':preco' => $preco,
            ':est'   => $estoque
        ]);

        // 4. CONFIRMAÇÃO
        if ($sucesso) {
            echo "<script>alert('Sucesso! Produto cadastrado com ID: " . $pdo->lastInsertId() . "');</script>";
        }
    } catch (PDOException $e) {
        echo "<p style='color:red; text-align:center;'>Erro ao cadastrar: " . $e->getMessage() . "</p>";
    }
}
?>

<main class="container">
    <h2>Cadastrar Medicamento</h2>

    <form action="cadastro.php" method="POST" class="form-style">
        
        <div class="form-group">
            <label for="nome">Nome do Produto</label>
            <input type="text" id="nome" name="nome" placeholder="Ex: Paracetamol 500mg" required>
        </div>

        <div class="form-group">
            <label for="fabricante">Fabricante / Laboratório</label>
            <input type="text" id="fabricante" name="fabricante" placeholder="Ex: Medley, EMS..." required>
        </div>

        <div class="form-group">
            <label for="preco">Preço de Venda (R$)</label>
            <input type="number" id="preco" step="0.01" name="preco" placeholder="0.00" required>
        </div>

        <div class="form-group">
            <label for="estoque">Quantidade em Estoque</label>
            <input type="number" id="estoque" name="estoque" placeholder="Ex: 100" required>
        </div>

        <button type="submit" class="btn-acao">Salvar no Sistema</button>
        
        <a href="visualizar.php" class="btn-link">Visualizar Estoque Atual →</a>
    </form>
</main>

<?php 
// Inclui o rodapé
require_once 'includes/footer.php'; 
?>