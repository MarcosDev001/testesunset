<?php
// Verifica se a solicitação é do tipo POST e se o parâmetro 'image_id' está definido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['image_id'])) {
    // Obtém o ID da imagem a ser excluída
    $imageId = $_POST['image_id'];
    
    // Aqui você deve adicionar a lógica para excluir a imagem do seu sistema de arquivos ou do banco de dados
    // Por exemplo, para excluir um arquivo do sistema de arquivos:
    $uploadDir = 'uploads/';
    $imagePath = $uploadDir . $imageId;
    
    // Verifica se o arquivo existe e tenta excluí-lo
    if (file_exists($imagePath)) {
        if (unlink($imagePath)) {
            // Se a exclusão for bem-sucedida, envia uma resposta JSON com sucesso
            echo json_encode(["success" => true, "message" => "Imagem excluída com sucesso"]);
            exit;
        } else {
            // Se ocorrer algum erro ao excluir o arquivo, envia uma resposta JSON com erro
            echo json_encode(["success" => false, "message" => "Erro ao excluir a imagem"]);
            exit;
        }
    } else {
        // Se a imagem não existir, envia uma resposta JSON com erro
        echo json_encode(["success" => false, "message" => "Imagem não encontrada"]);
        exit;
    }
} else {
    // Se a solicitação não for do tipo POST ou se o parâmetro 'image_id' não estiver definido, envia uma resposta JSON com erro
    echo json_encode(["success" => false, "message" => "Requisição inválida"]);
    exit;
}
?>
