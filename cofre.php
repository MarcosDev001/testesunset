<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Imagens</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="menu.css">
    <style>
    body {
            font-family: 'Montserrat', sans-serif;
            background-color: #ffffff;
            color: #fff;
            padding: 20px;
            margin: 0;
        }

        .dashboard {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            height: 100%;
            background: rgb(255, 214, 88);
            background: linear-gradient(0deg, rgba(255, 214, 88, 1) 0%, rgba(255, 100, 160, 1) 100%);
            padding: 20px;
            color: #fff;
            margin-left: -250px;
            position: fixed;
            transition: margin-left 0.5s;
     
            margin-top: -19px;
        }

        .sidebar.show {
            margin-left: -19px;
        }

        .menu-icon {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #fff;
            font-size: 24px;
            cursor: pointer;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .main-content header h2 {
            margin-bottom: 20px;
            margin-left: 63px;
        }

        .main-content section {
            background: rgb(255, 214, 88);
            background: linear-gradient(0deg, rgba(255, 214, 88, 1) 0%, rgba(255, 100, 160, 1) 100%);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 54px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;

        }

        .sidebar ul li a:hover {
            background-color: #555;
        }

        .sidebar ul .dropdown {
            margin-left: 20px;
            overflow: hidden;

            height: 0;

            transition: height 0.3s ease;
    
        }

        .sidebar ul .dropdown.show {
            display: block;
            height: auto;
       
        }

        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .main-content {
                padding-top: 50px;
            }
        }

        .main-content {
            flex: 1;
            padding: 20px;
            margin-left: 0;

            transition: margin-left 0.5s;

        }

        .main-content.shifted {
            margin-left: 250px;
   
        }

        .geral {
            margin-left: -20px;
        }

        .image-gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .image-item {
            margin: 10px;
        }

        .image-item img {
            max-width: 200px;
            max-height: 200px;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="sidebar" id="sidebar">
            <h2 style="margin-top: 57px;">DarkPanel</h2>
            <ul>
                <li><a href="#" class="active">Página Inicial</a></li>
                <li>
                    <a href="#">Administração</a>
                    <ul class="dropdown">
                        <li><a href="postar.php">Configurações</a></li>
                        <li><a href="#">Configurações</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Usuários</a>
                    <ul class="dropdown">
                        <li><a href="#">Gerenciar Usuários</a></li>
                        <li><a href="#">Permissões</a></li>
                    </ul>
                </li>
                <li><a href="#">Outros</a></li>
            </ul>
        </div>
        <div class="menu-icon" id="menu-icon">
            <i class="fas fa-bars"></i>
        </div>

        <div class="main-content" id="main-content">
            <header>
                <h2>Gerenciar Imagens</h2>
            </header>
            <section>
                <form id="upload-form" method="post" enctype="multipart/form-data">
                
                </form>
                <div id="message"></div>
                <div class="image-gallery">
                    <?php
                    $uploadDir = 'uploads/';
                    $images = glob($uploadDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                    foreach ($images as $image) {
                        echo '<div class="image-item">';
                        echo '<img src="' . $image . '" alt="Imagem">';
                        echo '<div class="image-options">';
                        echo '<button onclick="deleteImage(\'' . basename($image) . '\')">Excluir</button>';
                        echo '<button onclick="toggleStatus(\'' . basename($image) . '\')">Ativar/Inativar</button>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </section>
        </div>

        <footer>
            <p>Desenvolvido por Marcos (indio)</p>
        </footer>
    </div>

    <script>
    document.getElementById('upload-form').addEventListener('submit', function (event) {
    event.preventDefault();
    var formData = new FormData(this);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'upload.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                document.getElementById('message').innerHTML = '<p style="color: green;">' + response.message + '</p>';
                refreshImageGallery(); // Atualiza a galeria de imagens após o envio bem-sucedido
            } else {
                document.getElementById('message').innerHTML = '<p style="color: red;">' + response.message + '</p>';
            }
        }
    };
    xhr.onerror = function () {
        document.getElementById('message').innerHTML = '<p style="color: red;">Erro ao enviar requisição.</p>';
    };
    xhr.send(formData);
});

function refreshImageGallery() {
    var gallery = document.querySelector('.image-gallery');
    gallery.innerHTML = ''; // Limpa a galeria atual
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            gallery.innerHTML = xhr.responseText; // Atualiza a galeria com as novas imagens
        }
    };
    xhr.open('GET', 'get_images.php', true);
    xhr.send();
}

function deleteImage(imageId) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'delet.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Faça algo após a exclusão bem-sucedida
                refreshImageGallery(); // Atualiza a galeria após exclusão bem-sucedida
            } else {
                // Trate caso a exclusão falhe
            }
        }
    };
    xhr.onerror = function () {
        // Trate erros de requisição
    };
    xhr.send('image_id=' + encodeURIComponent(imageId));
}

    </script>
</body>
</html>
