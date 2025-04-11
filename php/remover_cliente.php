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

    // Primeiro, remove os telefones associados
    $sqlTelefone = "DELETE FROM TelefoneCliente WHERE idCliente = $idCliente";

    if ($conn->query($sqlTelefone) === TRUE) {
        // Depois, remove o cliente
        $sqlCliente = "DELETE FROM Clientes WHERE idCliente = $idCliente";

        if ($conn->query($sqlCliente) === TRUE) {
            echo "Cliente removido com sucesso!";
        } else {
            echo "Erro ao remover cliente: " . $conn->error;
        }
    } else {
        echo "Erro ao remover telefone: " . $conn->error;
    }
}

$conn->close();
?>
