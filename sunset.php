<?php
$uploadDir = 'uploads/';

$handle = opendir($uploadDir);
$imagens = [];

while (false !== ($entry = readdir($handle))) {
    if ($entry !== '.' && $entry !== '..')
        array_push($imagens, $entry);
}

closedir($handle);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['image_name'])) {
    $imageName = $_POST['image_name'];
    $imagePath = $uploadDir . $imageName;
   
    if (file_exists($imagePath)) {
        unlink($imagePath);
        echo json_encode(["success" => true, "message" => "Imagem excluída com sucesso"]);
        exit;
    } else {
        echo json_encode(["success" => false, "message" => "A imagem não foi encontrada"]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SunsetMusic</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="sunset.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    link
   
</head>

<body>

    <div class="nav">
        <input type="checkbox" id="nav-check">
        <div class="nav-header">
            <div class="nav-title">
                Logo sunset
            </div>
        </div>
        <div class="nav-btn">
            <label for="nav-check">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>

        <div class="nav-links">
            <ul>
                <li class="dropdown">
                    <a href="#">Home</a>
                    <div class="dropdown-content">
                        <a href="#">Submenu 1</a>
                        <a href="#">Submenu 2</a>
                        <a href="#">Submenu 3</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="#">Home</a>
                    <div class="dropdown-content">
                        <a href="#">Submenu 1</a>
                        <a href="#">Submenu 2</a>
                        <a href="#">Submenu 3</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="#">Home</a>
                    <div class="dropdown-content">
                        <a href="#">Submenu 1</a>
                        <a href="#">Submenu 2</a>
                        <a href="#">Submenu 3</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="#">Home</a>
                    <div class="dropdown-content">
                        <a href="#">Submenu 1</a>
                        <a href="#">Submenu 2</a>
                        <a href="#">Submenu 3</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="#">Home</a>
                    <div class="dropdown-content">
                        <a href="#">Submenu 1</a>
                        <a href="#">Submenu 2</a>
                        <a href="#">Submenu 3</a>
                    </div>
                </li>
                <a class="icon">
                    <i class="fa fa-twitter"></i>
                    <i class="fa fa-linkedin"></i>
                    <i class="fa fa-youtube"></i>

                </a>
            </ul>
        </div>
    </div>

    <h2 style="text-align: center; color: #ff329d; margin-top: 40px;">Anuncios</h2>

    <div class="slider-container">
        <button class="prev" onclick="plusSlides(-1)">❮</button>
        <div class="slide">
            <img src="https://ppanel.radiohabblet.com.br/imagem/temas/header-aaae4a4158d31409308324f874730f7c.png"
                alt="Imagem 2">
        </div>
        <div class="slide">
            <img src="https://ppanel.radiohabblet.com.br/imagem/temas/header-aaae4a4158d31409308324f874730f7c.png"
                alt="Imagem 2">
        </div>
        <div class="slide">
            <img src="https://ppanel.radiohabblet.com.br/imagem/temas/header-aaae4a4158d31409308324f874730f7c.png"
                alt="Imagem 2">
        </div>
        <button class="next" onclick="plusSlides(1)">❯</button>
    </div>
    <div class="divider"></div>
    <div class="ads-container">
        <h2 class="ads-title">Lana Del Rey: <br>
            The Norman Fucking Rockwell! Tour</h2>
        <div class="ads-banner">
            <div class="h2-text">
                <h1 class="h1-about">Quem Somos ?</h1>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                    industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                    and scrambled it to make a type specimen book. It has survived not only five centuries, but also
                    the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the
                    1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                    desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
            </div>
            <div class="image-container" id="gallery">
            </div>
        </div>
    </div>

   <div class="ads-banner-yellow">
    <h1 class="title-yellow">Galeria</h1>
    <div id="gallery" style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 32px">    
        <?php foreach($imagens as $imagem): ?>
            <div class="grid-item">
                <img src="/uploads/<?= $imagem ?>" alt="Imagem 1">
                <div class="overlay">
                 <div class="divisor-white"></div>
                    <div class="text">Título da Imagem 1 <br> <h1 style="font-size:20px;    margin-left: -48px;
    font-size: 14px;
">03/04/2024</h1></div>
                </div>
            </div>
    
        <?php endforeach; ?>
         
            <!-- <div class="grid-item">
                <img src="https://painel.habbletdreams.com/assets/uploads/noticias/noticia-e7739c43a51a03b3fc7145c3fcc86488.png" alt="Imagem 2">
                <div class="overlay">
                    <div class="text">Título da Imagem 2</div>
                </div>
            </div>
            <div class="grid-item">
                <img src="https://painel.habbletdreams.com/assets/uploads/noticias/noticia-e7739c43a51a03b3fc7145c3fcc86488.png" alt="Imagem 3">
                <div class="overlay">
                    <div class="text">Título da Imagem 3</div>
                </div>
            </div> -->
        <!-- <div class="grid-row">
        
            <div class="grid-item">
                <img src="https://painel.habbletdreams.com/assets/uploads/noticias/noticia-e7739c43a51a03b3fc7145c3fcc86488.png" alt="Imagem 4">
                <div class="overlay">
                    <div class="text">Título da Imagem 4</div>
                </div>
            </div>
            <div class="grid-item">
                <img src="https://painel.habbletdreams.com/assets/uploads/noticias/noticia-e7739c43a51a03b3fc7145c3fcc86488.png" alt="Imagem 5">
                <div class="overlay">
                    <div class="text">Título da Imagem 5</div>
                </div>
            </div>
            <div class="grid-item">
                <img src="https://painel.habbletdreams.com/assets/uploads/noticias/noticia-e7739c43a51a03b3fc7145c3fcc86488.png" alt="Imagem 6">
                <div class="overlay">
                    <div class="text">Título da Imagem 6</div>
                </div>
            </div>
        </div> -->
    </div>
</div>
    <footer>
        <div class="ads-banner-blue">
            k
        </div>
    </footer>
    sdsd
    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            const slides = document.getElementsByClassName("slide");
            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex - 1].style.display = "block";
        }

        const uploadForm = document.getElementById('upload-form');

 
        uploadForm.addEventListener('submit', function (event) {
            event.preventDefault();

            var formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
              
                        var imageUrl = data.image;
                        var title = formData.get('title');
                        addImageToGallery(imageUrl, title);
                    } else {
                 
                        alert("Erro ao enviar a imagem: " + data.message);
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                });
        });


        function addImageToGallery(imageUrl, title) {
          
            var newDiv = document.createElement('div');
            newDiv.className = 'grid-item';

     
            var imgElement = document.createElement('img');
            imgElement.src = imageUrl;
            imgElement.alt = title; 
            newDiv.appendChild(imgElement);

     
            var overlayDiv = document.createElement('div');
            overlayDiv.className = 'overlay';

          
            var textDiv = document.createElement('div');
            textDiv.className = 'text';
            textDiv.textContent = title; 
            overlayDiv.appendChild(textDiv);

            newDiv.appendChild(overlayDiv);

            var lastRow = document.querySelector('.grid-container');


            lastRow.appendChild(newDiv);
        }
    </script>

</body>

</html>
