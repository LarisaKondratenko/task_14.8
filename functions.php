<?php

    //1.Для начала создайте несколько полезных функций и выделите их в отдельный файл:
function getUsersList() { //1) Функция, которая возвращает массив всех пользователей и хэш паролей
    return
    [
        ['login'=> 'admin', 'password' => 'b54d1440584feaa9c2e9f29e76487cd3', 'b_day' => '1995-01-12'],//admin123
        ['login' => 'Alisa', 'password' => '6b52c479ec73a4fea208ae447ded9ca4', 'b_day' => '1990-06-22'],//al123 
        ['login' => 'Anna', 'password' => '$2y$10$oCNfTkfxFPvLvZIWfDUNLOPdbemzX2ZIf3BOFj7pliCBvQNRTIAp2', 'b_day' => '1994-03-15'],//anna123
        
    ];

}
function existsUser($login) { //2) Функция, которая проверяет - существует ли пользователь с заданным логином
    return in_array( $login, array_column( getUsersList(),'login' ) );  //in_array - проверяет, есть ли в масииве значение. array_column - возвращает массив из значений одного столбца входного массива.
}

function getUser($login) {  //функция, которая возвратит информацию о пользователе с таким логином или null
    $users = getUsersList();
    foreach ($users as $user) {             //перебираем логин пользователей
        if ($login == $user['login']) {
            return $user;
        }
    }
}

//проверяет, существует ли пользователь с указанным логином, возвращает true, если такой пользователь есть
function checkPassword($login, $password) { //3) функция, которая возвращает true тогда, когда существует пользователь с указанным логином и введенный им пароль прошел проверку.
    if ( true === existsUser($login) ) { //проверка существует ли пользователь с таким логином
        if ( password_verify( $password, getUser($login)['password'] ) ) { //если логин пользователя найден проверяем хэш пароля пользователя
            return true;
        }
    }
    return false;
}

// возвращает либо имя вошедшего на сайт пользователя, либо null
function getCurrentUser(){
    return $_POST['login'] ?? null;
}



// функция для определения времени до окончания акции
 function timeMessage ($time_input) {
    $current_time = time(); //записываем текущее время
    $time_deadline = ($time_input + 86400) - $current_time;//вычисляем время дедлайна по акции
    $minutes = floor($time_deadline / 60); // считаем минуты
    $hours = floor($minutes / 60); // считаем количество полных часов
    $minutes = $minutes - ($hours * 60);  // считаем количество оставшихся минут
    $message = nl2br('До окончания скидки: ' . $hours. ' ч. ' . $minutes . ' мин.');
    return $message;
}

//функция для вывода сообщения о дне рождении
function birthdayMessage($birthday_input, $users3, $login) {
    
    if(!$users3[$login]['b_day'] && !$birthday_input) {
        $message = nl2br('Сообщите свою дату рождения и получите дополнительную скидку!');//если день рождения не введен и не записан в массиве пользователей
    }
    else {

        $todayNumber = date('j'); //число текущего дня
        $todayMonth = date('n'); //число текущего месяца

        if(!$users3[$login]['b_day']) {
            $birthday = $birthday_input;  //если введена дата и ее нет в массиве пользователей
        }
            else {
                $birthday = $users3[$login]['b_day']; //дату рождения берем из массива
            }

        $birthdayNumber = date('j', strtotime($birthday)); //число рождения
        $birthdayMonth = date('n', strtotime($birthday)); //месяц рождения

        if($todayNumber == $birthdayNumber && $todayMonth == $birthdayMonth) {

            $message = 'Сегодня, в Ваш день рождения, получите дополнительную скидку 10% на все услуги салона!'; //если день рождения сегодня
        }
            else {
                $bd = explode('-', $birthday); //получаем массив из даты рождения
                $bd = mktime(0, 0, 0, $bd[1], $bd[2], date('Y') + ($bd[1].$bd[2] <= date('md'))); //вычисляем дату в секундах, как если бы она была в этом году
                $days_until = ceil(($bd - time()) / 86400); //дельта между ДР и текущим днем с округлением

                $message = 'До Вашего дня рождения осталось дней: ' . $days_until . '.'; //сколько осталось до дня рождения
            }
        }
    return $message;
}
?>
 