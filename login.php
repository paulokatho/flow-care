<?php
include("conexao.php");



if ($_SERVER["REQUEST_METHOD"] == "POST") {


$email = $_POST['email_usuario']??'';
$senha = $_POST['senha_usuario']??'';



try {
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email_usuario AND senha = :senha_usuario");
 //$stmt = $pdo->prepare("INSERT INTO tbusuario (email_usuario, senha_usuario) VALUES (:email, :senha)");
$stmt->bindParam(':email_usuario', $email);
$stmt->bindParam(':senha_usuario', $senha);
$stmt->execute();



if($stmt->rowCount()==0){
  // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
  echo  "<script>alert('Login Inálido');</script>";
  echo "<script language='javaScript'>window.location.href='index.php'</script>";

}else{

    echo "entrou";
    header("Location:home.html");

}

} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
}

?>
