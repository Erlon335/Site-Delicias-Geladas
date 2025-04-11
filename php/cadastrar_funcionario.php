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

// Obtendo os dados do formulário
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$dataNascimento = $_POST['dataNascimento'];
$email = $_POST['email'];
$nome = $_POST['nome'];
$uf = $_POST['uf'];
$cidade = $_POST['cidade'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cep = $_POST['cep'];
$dataInicio = $_POST['dataInicio'];
$tipo = $_POST['tipo'];
$telefones = $_POST['telefones']; // Array de telefones

// Inserindo o funcionário na tabela Funcionarios
$sql = "INSERT INTO Funcionarios (cpf, RG, dataNascimento, email, nome, uf, cidade, rua, numero, bairro, cep, dataInicio, tipo)
        VALUES ('$cpf', '$rg', '$dataNascimento', '$email', '$nome', '$uf', '$cidade', '$rua', '$numero', '$bairro', '$cep', '$dataInicio', '$tipo')";

if ($conn->query($sql) === TRUE) {
    $idFuncionario = $conn->insert_id; // ID do funcionário inserido

    // Inserindo os telefones na tabela TelefoneFuncionario
    foreach ($telefones as $telefone) {
        $sqlTelefone = "INSERT INTO TelefoneFuncionario (telefoneFuncionario, idFuncionario)
                        VALUES ('$telefone', '$idFuncionario')";
        if ($conn->query($sqlTelefone) !== TRUE) {
            echo "Erro ao inserir telefone: " . $conn->error;
        }
    }
    echo "Novo funcionário cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar funcionário: " . $conn->error;
}

// Fechando a conexão
$conn->close();
?>
