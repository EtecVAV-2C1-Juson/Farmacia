<?php 
require_once 'config/conexao.php';
require_once 'includes/header.php'; 
?>

<main class="container-central">
    <div class="boas-vindas">
        <h2>Gerenciamento de Estoque</h2>
        <p>Selecione uma das opções abaixo para gerenciar a FarmAí.</p>
    </div>

    <div class="dashboard">
        <a href="cadastro.php" class="card-link">
            <div class="card">
                <h3>Novo Produto</h3>
                <p>Cadastrar novos medicamentos no sistema.</p>
            </div>
        </a>

        <a href="visualizar.php" class="card-link">
            <div class="card">
                <h3>Ver Estoque</h3>
                <p>Consultar, editar ou excluir itens existentes.</p>
            </div>
        </a>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>