<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Delicias_Geladas";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeCliente = $_POST["nomeCliente"];
    $cidade = $_POST["cidade"];
    $uf = $_POST["uf"];
    $rua = $_POST["rua"];
    $numero = $_POST["numero"];
    $bairro = $_POST["bairro"];
    $cep = $_POST["cep"];
    $telefone = $_POST["telefone"];

    // Inserindo cliente
    $sqlCliente = "INSERT INTO Clientes (nomeCliente, cidade, uf, rua, numero, bairro, cep) 
                   VALUES ('$nomeCliente', '$cidade', '$uf', '$rua', '$numero', '$bairro', '$cep')";

    if ($conn->query($sqlCliente) === TRUE) {
        $idCliente = $conn->insert_id; // Obtém o ID gerado

        // Inserindo telefone
        $sqlTelefone = "INSERT INTO TelefoneCliente (telefoneCliente, idCliente) 
                        VALUES ('$telefone', '$idCliente')";

        if ($conn->query($sqlTelefone) === TRUE) {
            echo "Cliente cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar telefone: " . $conn->error;
        }
    } else {
        echo "Erro ao cadastrar cliente: " . $conn->error;
    }
}

$conn->close();
?>
