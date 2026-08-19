<?php

include "../infra/conexao.php";

$nome = $_POST["nome"];
$email = $_POST["email"];

$sql = "INSERT INTO usuarios (nome, email) VALUES (?, ?)";

$stmt = mysqli_prepare($conexao, $sql);

mysqli_stmt_bind_param($stmt, "ss", $nome, $email);

mysqli_stmt_execute($stmt);

header("Location: ../index.php?sucesso=usuario");
?>