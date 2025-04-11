<?php
// Configuração do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Delicias_Geladas";

// Criando conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Obtendo os dados do formulário
$idContato = $_POST['idContato'];
$cnpj = preg_replace('/[^0-9]/', '', $_POST['cnpj']); // Remove caracteres não numéricos

// Verificar se o contato existe antes de remover
$sqlCheck = "SELECT idContato FROM contatos WHERE idContato = ? AND cnpj = ?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("is", $idContato, $cnpj);
$stmtCheck->execute();
$result = $stmtCheck->get_result();

if ($result->num_rows === 0) {
    die("Erro: Contato não encontrado para o CNPJ $cnpj.");
}

$stmtCheck->close();

// Removendo o contato
$sqlDelete = "DELETE FROM contatos WHERE idContato = ? AND cnpj = ?";
$stmtDelete = $conn->prepare($sqlDelete);
$stmtDelete->bind_param("is", $idContato, $cnpj);

if ($stmtDelete->execute()) {
    echo "Contato removido com sucesso!";
} else {
    echo "Erro ao remover contato: " . $stmtDelete->error;
}

$stmtDelete->close();
$conn->close();
?>