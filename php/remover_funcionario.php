<?php
// Configuração do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Delicias_Geladas";

// Criando a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obtendo o ID do funcionário a ser removido
$idFuncionario = $_POST['idFuncionario'];

// Removendo os telefones do funcionário
$sqlTelefone = "DELETE FROM TelefoneFuncionario WHERE idFuncionario = $idFuncionario";
if ($conn->query($sqlTelefone) !== TRUE) {
    echo "Erro ao remover telefones: " . $conn->error;
} else {
    // Removendo o funcionário da tabela Funcionarios
    $sqlFuncionario = "DELETE FROM Funcionarios WHERE idFuncionario = $idFuncionario";
    if ($conn->query($sqlFuncionario) === TRUE) {
        echo "Funcionário removido com sucesso!";
    } else {
        echo "Erro ao remover funcionário: " . $conn->error;
    }
}

// Fechando a conexão
$conn->close();
?>
