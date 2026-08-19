<?php
include "../infra/conexao.php";

$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
$preco = $_POST["preco"];
$categoria = $_POST["categoria"];
$usuario_id = $_POST["usuario_id"];

$sql = "INSERT INTO pratos (nome, descricao, preco, categoria, usuario_id)
        VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conexao, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "ssdsi",
    $nome,
    $descricao,
    $preco,
    $categoria,
    $usuario_id
);

mysqli_stmt_execute($stmt);

header("Location: ../index.php");
exit;
?>