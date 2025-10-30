<?php
try {
    //$pdo = new PDO("mysql:host=localhost;dbname=flowcare", "root", "");
    $pdo = new PDO("mysql:host=localhost;dbname=agendamentos_db", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}
?>
