<?php
session_start();

$uploadDir = 'uploads/';

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'])) {
    if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $title = $_POST['title'];
        $filepath = $uploadDir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $filepath);
        echo json_encode(["success" => true, "message" => "Imagem enviada com sucesso"]);
        exit;
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao enviar imagem. Tente novamente."]);
        exit;
    }
} else {
    echo json_encode(["success" => false, "message" => "Nenhuma imagem foi enviada."]);
    exit;
}
?>
