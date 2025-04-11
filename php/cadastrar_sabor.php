<?php
// cadastrar_sabor.php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Delicias_Geladas";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $ingredientes = $_POST["ingredientes"];
    $preco = $_POST["preco"];
    $foto = $_FILES["foto"]["name"] ;
    $disponibilidade = isset($_POST["disponibilidade"]) ? 1 : 0;
    
    $pasta = "Fotos";
    move_uploaded_file($_FILES["foto"]["tmp_name"], $pasta."/". $_FILES["foto"]["name"]);
    
    $sql = "INSERT INTO Sabores (nome, descricao, ingredientes, preco, foto, disponibilidade) 
            VALUES ('$nome', '$descricao', '$ingredientes', '$preco',  '$foto', '$disponibilidade')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Sabor cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}
$conn->close();
?>