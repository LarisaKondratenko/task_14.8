<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
    <title>SPA-pro</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php

if (!empty($_POST)) {
    include 'functions.php';

    $login = $_POST['login'] ?? null; // записываем логин
    $password = $_POST['password'] ?? null; // записываем пароль
    $time_input = $_POST['time_input'] ?? null; //записываем время входа на сайт
    $birthday_input = $_POST['date'] ?? null; //записываем дату рождения, если пользователь ее ввел

    //проверяем логин и пароль и стартуем сессию
    if (checkPassword($login, $password)) {
        
        session_start();      
        $_SESSION['message'] = 'Добро пожаловать, ' . $login . '!';

    }

        else {
            header('Location: login.php');
        }
}

?>

<header>
    <div class="header">

        <div class="logo">
		    <h1>SPA-салон</h1>   
	    </div>

        <div class="links">
            <a href="#">Консультация</a>
            <a href="#">Специалисты</a>
            <a href="#">Акции</a>
        </div>

        <div class = "msg">
        <?php
            if (!empty($_POST)) {
                //echo '<button onClick="window.location.href=window.location.href">Выход</button>';
                echo $_SESSION['message'] . '<br/>';
                echo "Вам предоставлена персональная скидка! <br/>";
                echo timeMessage($time_input) . '<br/>';
                echo birthdayMessage($birthday_input, $users3, $login) . '<br/>';
                echo '<button onClick="window.location.href=window.location.href">Выход</button>';
            }
            else {
                echo '<form action="login.php" method="get"><button type="submit" width = "100px">Вход на сайт</button></form>';
            }    
        ?> 
        </div>
    </div>   
</header>
<section class="spa_pro">
        <article>
            <a href="#">
                <h2 class>Массажи</h2>
            </a>
            <div class="article-meta">
                <a href="#">Подробнее</a>
            </div>
            <img src="images/jesse.jpg">
            <p>Наше тело и внутреннее состояние взаимосвязаны. Помогая телу, мы улучшаем себя и ментально. 
                Поэтому так важно получать качественный уход регулярно. Гости отмечают эффект уже после первого 
                посещения нашего массажного салона.
            </p>
        </article>

        <article>
            <a href="#">
                <h2>Спа-программы</h2>
            </a>
            <div class="article-meta">
                <a href="#">Подробнее</a>
            </div>
            <img src="images/ban.jpg">
            <p>Предлагаем следующие выиды спра-прогарамм: 1. воздействе воды(спа-бассейн, насыщенная ванна),
                 2.воздействие тепла(фитобочка, финская сауна, русская баня), 3.очишение и питание тела(скрабировние, обёртывание)
            </p>
        </article>

        <article>
            <a href="#">
                <h2>Аква-спа</h2>
            </a>
            <div class="article-meta">
                <a href="#">Подробнее</a>
            </div>
            <img src="images/alan.jpg">
            <p>Позвольте себе райский отдых. Пилинг ног, молочная ванна с 
               оттенками фруктов, цветотерапия помогут Вам отдохнуть и 
               настроиться на спокойный лад. Ванна расширит кровеносные сосуды, 
               полностью расслабит уставшие мышцы и подготовит ваше тело к 
               массажу. Релакс массаж гармонизирует ваше тело и напитает каждую 
               клеточку ароматами. Арома-масла подбираются индивидуально. 
               Шампанское и тарелка с фруктами завершат путешествие по облакам.
            </p>
        </article>

        <article>
            <a href="#">
                <h2>Тайский массаж</h2>
            </a>
            <div class="article-meta">
                <a href="#">Подробнее</a>
            </div>
            <img src="images/dana.jpg">
            <p>Тайский массаж - это эластичность мышц, растяжка, чувство тонуса,восстановление внутреннего баланса,
                гармонии, медитации, как телесная,так и духовная. 
 
            </p>
        </article>

        <article>
            <a href="#">
                <h2>Спа для двоих</h2>
            </a>
            <div class="article-meta">
                <a href="#">Подробнее</a>
            </div>
            <img src="images/salon.jpg">
            <p>Романтическое СПА – это способ возобновить гармонию в отношениях 
               и насладиться отдыхом с любимым. Походом в СПА для двоих вы 
               удивите и порадуете свою вторую половинку на день рождения, 
               годовщину или же в любой день, когда пожелаете стать ближе.
            </p>
        </article>

        <article>
            <a href="#">
                <h2>Спа для детей</h2>
            </a>
            <div class="article-meta">
                <a href="#">Подробнее</a>
            </div>
            <img src="images/huum.jpg">
            <p>Подводные пузырьки, меняющееся световая подсветка воды и море 
               нежной пены ждут Ваших деток на СПА-программе в аква-сьюте! 
               Девочки почувствуют себя сказочными русалочками, а мальчики 
               храбрыми капитанами корабля. Программа отлично подойдет для 
               празднования детского дня рождения. После веселья в гидромассажной 
               ванне, деток ждет полезный массаж с магнием. А в завершении отдых 
               и вкусный молочный коктейль.
            </p>
        </article>
    </section>


    <footer>
        <div class="links">
            <a href="#">Вакансии</a>
            <a href="#">Контакты</a>
            <a href="#">Реклама</a>
        </div>

        <div class="copyright">Copyright @ SPA_salon-pro 2023</div>
    </footer>

</body>
</html>