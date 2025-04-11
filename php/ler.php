<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Delicias_Geladas";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Função para exibir dados de uma tabela
function exibirTabela($conn, $tabela) {
    $sql = "SELECT * FROM $tabela";
    $result = $conn->query($sql);
    
    echo "<h2>Tabela: $tabela</h2>";
    if ($result->num_rows > 0) {
        echo "<table border='1'><tr>";
        while ($field = $result->fetch_field()) {
            echo "<th>" . $field->name . "</th>";
        }
        echo "</tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum dado encontrado na tabela $tabela.<br>";
    }
    echo "<br>";
}

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco de Dados</title>
    
</head>
<body>

<?php
// Listar e exibir os dados das tabelas
$tabelas = ["Empresa", "Funcionarios", "Sabores", "Clientes", "Contatos", "TelefoneFuncionario", "TelefoneCliente"];
foreach ($tabelas as $tabela) {
    exibirTabela($conn, $tabela);
}

$conn->close();
?>

</body>
</html>
