<?php
session_start();

$uploadDir = 'uploads/';

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
}

if (!isset($_FILES['image'])) {
    http_response_code(401);
    exit(json_encode([
        "message" => "Nenhuma imagem foi enviada."
    ]));
}

if ($_FILES['image']['error'] != UPLOAD_ERR_OK) {
    http_response_code(401);
    exit(json_encode([
        "message" => "Erro na imagem. Tente com outra."
    ])); 
}

if (!isset($_POST['title']) || !trim($_POST['title'])) {
    http_response_code(401);
    exit(json_encode([
        "message" => "O título não pode estar vazio."
    ]));
}

$title = $_POST['title'];
$filepath = $uploadDir . basename($_FILES['image']['name']);

$successOnMove = move_uploaded_file($_FILES['image']['tmp_name'], $filepath);

if (!$successOnMove) {
    http_response_code(500);
    exit(json_encode([
        "message" => "Ocorreu um erro interno."
    ]));
}

http_response_code(201);
exit(json_encode([
    "message" => "Imagem salva com sucesso"
]));
?>