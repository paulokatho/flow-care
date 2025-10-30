<?php
require_once 'conexao.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:email, :senha)";
$stmt = $conn->prepare($sql);
//$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $password);

if ($stmt->execute()) {
    header("Location: home.html"); 
} else {
    echo "Erro ao cadastrar!";
}
?>
