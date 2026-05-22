<?php
require_once 'config/conexao.php';

// Pega o ID da URL
$id = $_GET['id'] ?? null;

if ($id) {
    try {
        // Prepara a exclusão
        $sql = "DELETE FROM produtos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        // Verifica se realmente apagou alguém (rowCount)
        if ($stmt->rowCount() > 0) {
            // Volta para a lista com um aviso na URL
            header("Location: visualizar.php?msg=sucesso");
            exit;
        } else {
            // Se o ID não existia no banco
            header("Location: visualizar.php?msg=nao_encontrado");
            exit;
        }

    } catch (PDOException $e) {
        // Se der erro de banco de dados (ex: chave estrangeira), ele avisa aqui
        die("Erro ao excluir: " . $e->getMessage());
    }
} else {
    // Se tentarem acessar excluir.php sem passar um ID na URL
    header("Location: visualizar.php");
    exit;
}
?>