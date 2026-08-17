<?php
// Como este arquivo está dentro da pasta 'public', precisamos voltar um nível (../) para achar a conexão
include "../infra/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário de usuário
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    // Evita SQL Injection limpando as strings
    $nome = mysqli_real_escape_string($conexao, $nome);
    $email = mysqli_real_escape_string($conexao, $email);

    // Prepara o comando SQL de inserção
    $sql = "INSERT INTO usuarios (nome, email) VALUES ('$nome', '$email')";

    // Executa no banco de dados
    if (mysqli_query($conexao, $sql)) {
        // Se der certo, redireciona de volta para a index.php
        header("Location: ../index.php");
        exit();
    } else {
        echo "Erro ao cadastrar usuário: " . mysqli_error($conexao);
    }
}
?>