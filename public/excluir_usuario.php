<?php

include "../infra/conexao.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$id = $_GET["id"] ?? null;

if (!$id) {
    header("Location: ../index.php");
    exit;
}


// Verifica se o usuário possui pratos cadastrados
$sql = "SELECT COUNT(*) AS quantidade FROM pratos WHERE usuario_id = ?";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();
$dados = $resultado->fetch_assoc();

$quantidadePratos = $dados["quantidade"];

$stmt->close();


// Se tiver pratos, não exclui o usuário
if ($quantidadePratos > 0) {

    header("Location: ../index.php?erro=usuario_com_pratos");
    exit;
}


// Se não tiver pratos, pode excluir
$sql = "DELETE FROM usuarios WHERE id = ?";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();


// Volta para o index
header("Location: ../index.php?sucesso=usuario_excluido");
exit;

?>