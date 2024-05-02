<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name = "viewport" content="width=device-width, initial-scale=1.0">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css” />
    <link rel="stylesheet" href="style.css">
        <title>Буняев Д.А.</title>
    </head>
    <body>

        <div class="container nav_bar">
            <div class="row">
                <div class="row">
                    <div class="col-3 nav_logo"></div>
                    <div class="col-9">
                        <div class="nav_text"> Что, о чем и почему?</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Новости личной жизни</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <h2>
                        Здесь будет новости из моей жизни, поездки,
                        прогулки,мои мысли. 
                        По сути вы сможете, смотреть за мной, 
                        как в сериале.
                    </h2>
                </div>
                <div class="col-4">
                    <div class="row" id ="main_photo"></div>
                    <div class="row"><p>Буняев Д.А.<p></div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3> Организация выезда в Ягодное.</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-8">
                    <p>
                        На протяжение месяца я и мои команда готовила мероприятие для 100 человек на турбазе.
                        Есть несколько блоков для дня, за каждый из них отвечает один человек из команды и вместе мы их наполняем.
                        Цель очень простая: знакомство участников,обед, станционка - так называема хождение по местам и выполнения заданий у организаторов(нас),стратегия - большая игра на 1,5-2 часа, чтобы побегать и с тактикой,обед и концерт.
                        Прекрасное чувство, когда большинство наших планов исполнилось.
                    </p>
                </div>
                <div class="col-4">
                    <div class="row" id="yagonoe"></div>
                    <div class="row"><p> Ночное ягодное</p></div>
                    <div class="row" id="yagonoe_house"></div>
                    <div class="row"><p> Дом в ягодном</p></div>
                </div>
            </div>
            <hr>
        <div>

     <div class="container">
        <div class="row">
            <div class="button_js col-12"></div>
            <button id="myButton">Нажми меня</button>
            <p id="demo">Здесь первая попытка</p>
        </div>
     </div>


    <div class="container">
        <div class ="row">
            <div class="col-12">
                <h1 class="hello">
                    Hello, <?php echo $_COOKIE['User']; ?>
                </h1>
            </div>
            <div class="col-12">
                <form method="POST" action="profile.php" enctype="multipart/form-data" name="upload">
                    <input type="text" class="form" name="title" placeholder="Main name of post">
                    <textarea name="text" cols="50" rows="10" placeholder="Write text new post..."></textarea><br>
                    <input type="file" name="file" /><br>
                    <button type="submit" class="btn_red" name="submit">Save post</button>
                </form>
            </div>
        </div>
    </div>
    
        <script type="text/javascript" src="js/Button.js"></script>
    </body> 
</html>

<?php
require_once('db.php');
$link= mysqli_connect('127.0.0.1', 'root', 'kali', 'first');
if (isset($_POST['submit'])){
    $title = strip_tags($_POST['title']);
    $main_text = strip_tags($_POST['text']);
    $title = mysqli_real_escape_string($link, $title);
    $main_text = mysqli_real_escape_string($link, $main_text);
    if (!$title || !$main_text) die ("Заполните все поля");
    $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $main_text = htmlspecialchars($main_text, ENT_QUOTES, 'UTF-8');
    $sql = "INSERT INTO posts (title, main_text) VALUES ('$title', '$main_text')";
    if (!mysqli_query($link, $sql)) die ("Не удалось добавить пост");

    if(isset($_FILES["file"]))
    {
        $errors = [];
        $allowedTypes = ['image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg', 'image/x-png', 'image/png'];
        $maxFileSize = 102400; //100KB
        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK){
            $errors[] = 'Произошла ошибка при загрузке файла.';

        }

        $realFileSize = filesize($_FILES['file']['tmp_name']);
        if ($realFileSize > $maxFileSize){
            $errors[] = 'Файл слишком большой';
        }
        $fileType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['file']['tmp_name']);
        if (!in_array($fileType, $allowedTypes)) {
            $errors[] = 'Недопустимый тип файла.';
        } 
        
        if (empty($errors)) {
            $tempPath = $_FILES['file']['tmp_name'];
            $destinationPath = 'upload/' . uniqid() . '_' . basename($_FILES['file']['name']);
            if (move_uploaded_file($tempPath, $destinationPath)) {
                echo "Файл загружен успешно: " . $destinationPath;
            } else {
                $errors[] = 'Не удалось переместить загруженный файл.';
            }
        } else {
            foreach ($errors as $error) {
                echo $error . '';
            }
        }

    }

}
?>