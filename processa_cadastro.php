<?php
// Configurações do banco
$host = 'localhost';
$db   = 'productnexus';  // nome do seu banco
$user = 'root';          // seu usuário do MySQL (pode ser diferente)
$pass = '';              // sua senha do MySQL (geralmente vazio no WAMP)

// Cria conexão
$conn = new mysqli($host, $user, $pass, $db);

// Verifica conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Pega os dados do formulário
$codigo = $_POST['codigo'];
$marca = $_POST['marca'];
$tipo = $_POST['tipo'];
$categoria = $_POST['categoria'];
$preco = $_POST['preco'];
$custo = $_POST['custo'];
$observacoes = $_POST['obs'];

// Prepara e executa o SQL para evitar SQL Injection
$stmt = $conn->prepare("INSERT INTO produtos (codigo, marca, tipo, categoria, preco, custo, observacoes) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssdds", $codigo, $marca, $tipo, $categoria, $preco, $custo, $observacoes);

if ($stmt->execute()) {
    echo "Produto cadastrado com sucesso!";
} else {
    echo "Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
