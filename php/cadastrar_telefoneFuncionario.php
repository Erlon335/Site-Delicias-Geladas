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
$idFuncionario = $_POST['idFuncionario'];
$telefones = $_POST['telefones']; // Array de telefones

// Verificar se o funcionário existe antes de cadastrar o telefone
$sqlCheck = "SELECT idFuncionario FROM Funcionarios WHERE idFuncionario = ?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("i", $idFuncionario);
$stmtCheck->execute();
$result = $stmtCheck->get_result();

if ($result->num_rows === 0) {
    die("Erro: Funcionário não encontrado.");
}

$stmtCheck->close();

// Inserindo os telefones na tabela TelefoneFuncionario
foreach ($telefones as $telefone) {
    $sql = "INSERT INTO TelefoneFuncionario (telefoneFuncionario, idFuncionario) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $telefone, $idFuncionario);
    
    if ($stmt->execute()) {
        echo "Telefone $telefone cadastrado com sucesso!<br>";
    } else {
        echo "Erro ao cadastrar telefone $telefone: " . $stmt->error . "<br>";
    }

    $stmt->close();
}

// Fechando a conexão
$conn->close();
?>
