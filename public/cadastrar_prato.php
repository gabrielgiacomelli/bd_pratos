<?php
// Volta um nível para acessar a pasta infra
include "../infra/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário de pratos
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $usuario_id = $_POST['usuario_id']; // ID vindo do <select> dinâmico

    // Limpa os dados contra SQL Injection
    $nome = mysqli_real_escape_string($conexao, $nome);
    $descricao = mysqli_real_escape_string($conexao, $descricao);
    $preco = mysqli_real_escape_string($conexao, $preco);
    $categoria = mysqli_real_escape_string($conexao, $categoria);
    $usuario_id = intval($usuario_id); // Garante que é um número inteiro

    // Prepara o comando SQL respeitando as colunas do seu banco
    $sql = "INSERT INTO pratos (usuario_id, nome, descricao, preco, categoria) 
            VALUES ($usuario_id, '$nome', '$descricao', '$preco', '$categoria')";

    // Executa a query
    if (mysqli_query($conexao, $sql)) {
        // Se der certo, redireciona de volta para a index.php
        header("Location: ../index.php");
        exit();
    } else {
        echo "Erro ao cadastrar prato: " . mysqli_error($conexao);
    }
}
?>