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
    $idCliente = $_POST["idCliente"];
    $telefoneCliente = $_POST["telefoneCliente"];

    // Verifica se o cliente existe antes de adicionar o telefone
    $verificaCliente = "SELECT idCliente FROM Clientes WHERE idCliente = $idCliente";
    $resultado = $conn->query($verificaCliente);

    if ($resultado->num_rows > 0) {
        // Insere o telefone associado ao cliente
        $sql = "INSERT INTO TelefoneCliente (telefoneCliente, idCliente) VALUES ('$telefoneCliente', '$idCliente')";

        if ($conn->query($sql) === TRUE) {
            echo "Telefone cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar telefone: " . $conn->error;
        }
    } else {
        echo "Erro: Cliente não encontrado.";
    }
}

$conn->close();
?>
