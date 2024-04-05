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

        /* Estilos para o formulário */
        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
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
                <h2>Bem-vindo, <span id="username"></span>!</h2>
            </header>
            <section>
                <h3>Postagem Forms </h3>
                <p>Seja bem-vindo</p>
                <form id="upload-form" method="post" action="upload.php" enctype="multipart/form-data">
                    <label for="title">Título:</label>
                    <input type="text" id="title" name="title" required>
                    <label for="image">Anexar Imagem:</label>
                    <input type="file" id="image" name="image" required accept="image/*">
                    <button type="submit">Enviar</button>
                </form>
                <div id="message"></div>
            </section>
        </div>

        <footer>
            <p>Desenvolvido por Marcos (indio)</p>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var username = localStorage.getItem('username');
            if (username) {
                document.getElementById('username').textContent = username;
            }
        });

        var sidebar = document.getElementById('sidebar');
        var menuIcon = document.getElementById('menu-icon');

        menuIcon.addEventListener('click', function () {
            sidebar.classList.toggle('show');
        });

        var menuItems = document.querySelectorAll('.sidebar ul li');
        menuItems.forEach(function (item) {
            item.addEventListener('click', function (e) {
                if (e.target.nextElementSibling && e.target.nextElementSibling.classList.contains('dropdown')) {
                    e.target.nextElementSibling.classList.toggle('show');
                }
            });
        });

        document.getElementById('menu-icon').addEventListener('click', function () {
            var mainContent = document.getElementById('main-content');
            mainContent.classList.toggle('shifted');
        });

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
    </script>
</body>
</html>
