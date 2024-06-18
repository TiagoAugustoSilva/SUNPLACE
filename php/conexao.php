<?php
$host = "localhost"; // Endereço do banco de dados
$user = "root"; // Nome de usuário do banco de dados
$pass = ""; // Senha do banco de dados
$dbname = "sunplace_upx"; // Nome do banco de dados
$port = 3306; // Porta do banco de dados (opcional, padrão é 3306 para MySQL)

try {
    // Cria uma conexão PDO com o banco de dados
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $pass);

    // Define o modo de erro para exceção para que o PDO lance exceções em caso de erros
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Em caso de erro, exibe a mensagem de erro
    echo "Erro na conexão: " . $e->getMessage();
}