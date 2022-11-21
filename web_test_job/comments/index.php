<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <title>Comments</title>
</head>
<body>
    <?php
        require "rb-mysql.php";
        R::setup('mysql:host=localhost;dbname=comments', 'root', '');
        R::useFeatureSet( 'novice/latest' );
        $connect = mysqli_connect('localhost', 'root', '', 'comments');

        if (isset($_POST['submit'])) {
            if (trim($_POST['name']) == "" || trim($_POST['message']) == "") {
                echo $err = 'Заполните все поля!';
            }
            else {
                $comments = R::dispense('comments');
                $comments->name = $_POST['name'];
                $comments->date = date("d.m.y H:i");
                $comments->message = $_POST['message'];

                R::store($comments);
                header('location: /comments');
            }
        }

        $id = $_GET['id'];
        mysqli_query($connect, "DELETE FROM `comments` WHERE `comments`.`id` = '$id'")
    ?>

        <form class="form" action="" method="post">
            <h2>Комментарий</h2>
            <input class="form_name" type="text" name="name" placeholder="Имя">
            <textarea class="form_text" name="message" cols="20" rows="5" placeholder="Текст комментария"></textarea>
            <div class="g-recaptcha" data-sitekey="6LfmNRgjAAAAAGXfzy3hGqQrsztIVzpnDcj-8ZBJ"></div>
            <div class="text-danger" id="recaptchaError"></div>
            <button class="btn" type="submit" name="submit">Добавить комментарий</button>
        </form>

        <?php $comments_select = mysqli_query($connect, "SELECT * FROM `comments`"); ?>
        <?php while($comments_fetch = mysqli_fetch_assoc($comments_select)) { ?>
                <div class="comment_info">
                    <div class="name"><?= $comments_fetch['name'] ?></div>
                    <div class="date"><?= $comments_fetch['date'] ?></div>
                </div>
                <div class="comment_content">
                    <div class="message"><?= $comments_fetch['message'] ?></div>
                </div>
                <a class="delete" href="index.php?id=<?=$comments_fetch['id'] ?>">Удалить</a>
        <?php } ?>
</body>
</html>