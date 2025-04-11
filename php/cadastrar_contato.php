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
$cnpj = preg_replace('/[^0-9]/', '', $_POST['cnpj']); // Remove caracteres não numéricos
$tipo = $_POST['tipo'];
$valor = trim($_POST['valor']);
$observacao = trim($_POST['observacao']);

// Verificar se a empresa com esse CNPJ existe antes de cadastrar o contato
$sqlCheck = "SELECT cnpj FROM Empresa WHERE cnpj = ?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("s", $cnpj);
$stmtCheck->execute();
$result = $stmtCheck->get_result();

if ($result->num_rows === 0) {
    die("Erro: Empresa com CNPJ $cnpj não encontrada.");
}

$stmtCheck->close();

// Inserindo o contato na tabela contatos
$sql = "INSERT INTO contatos (cnpj, tipo, valor, observacao) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $cnpj, $tipo, $valor, $observacao);

if ($stmt->execute()) {
    echo "Contato cadastrado com sucesso para a empresa $cnpj!";
} else {
    echo "Erro ao cadastrar contato: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
