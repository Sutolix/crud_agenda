<?php

include_once("connection.php");

$table = 'contacts';
$query = "SHOW TABLES LIKE :table";

$stmt = $conn->prepare($query);
$stmt->bindParam(":table", $table);

try {
  $stmt->execute();
  if($stmt->rowCount() === 0) {
    $create_table = "CREATE TABLE contacts(
      id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(150),
      phone VARCHAR(20),
      observations TEXT
    )";
    $stmt_create = $conn->prepare($create_table);
    $stmt_create->execute();
    echo "Tabela criada com sucesso!";
  } else {
    echo "Tabela já existe.";
  }
} catch (PDOException $e) {
  $error = $e->getMessage();
  echo "Erro: $error";
}