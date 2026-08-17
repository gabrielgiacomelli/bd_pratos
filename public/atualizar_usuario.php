<?php

include "../infra/conexao.php";
$id = $_POST["id"];
$nome = $_POST["nome"];
$email = $_POST["email"];

$sql = "UPDATE usuarios SET nome=?,email=? WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("ssi", $nome, $email, $id);
$stmt->execute();

header("Location: ../index.php");

?>
