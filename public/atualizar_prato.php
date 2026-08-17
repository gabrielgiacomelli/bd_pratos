<?php

include "../infra/conexao.php";
$id = $_POST["id"];
$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
$preco = $_POST["preco"];
$categoria = $_POST["categoria"];

$sql = "UPDATE pratos SET nome=?,descricao=?,preco=?, categoria=? WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("sssdi", $nome, $descricao, $preco, $categoria, $id);
$stmt->execute();

header("Location: ../index.php");

?>
