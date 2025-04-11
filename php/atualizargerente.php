    <?php
    // Conexão com o banco de dados
    $host = 'localhost'; // Alterar conforme necessário
    $dbname = 'Delicias_Geladas'; // Nome do banco de dados
    $user = 'root'; // Usuário do banco
    $password = ''; // Senha do banco

 
    // Conexão com o banco de dados
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=Delicias_Geladas;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erro: " . $e->getMessage());
    }
    
    // Verifica se os dados foram enviados via POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['cnpj']) && !empty($_POST['idGerente'])) {
        $stmt = $pdo->prepare("UPDATE Empresa SET idGerente = ? WHERE cnpj = ?");
        if ($stmt->execute([$_POST['idGerente'], $_POST['cnpj']])) {
            echo "Atualização realizada com sucesso!";
        } else {
            echo "Erro ao atualizar o ID do gerente.";
        }
    } else {
        echo "CNPJ e ID do gerente são obrigatórios.";
    }
    ?>
    
    