<?php
// remover_sabor.php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Delicias_Geladas";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idSabor = $_POST["idSabor"];
    
    $sql = "DELETE FROM Sabores WHERE idSabor = $idSabor";
    
    if ($conn->query($sql) === TRUE) {
        echo "Sabor removido com sucesso!";
    } else {
        echo "Erro ao remover: " . $conn->error;
    }
}
$conn->close();
?>