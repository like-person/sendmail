<?php

$out = array('success' => true, 'message' => 'Сообщение принято');
$error = '';
//Поля формы
$fields = array('name' => 'ФИО', 'phone' => 'Телефон', 'email' => 'E-mail', 'comment' => 'Комментарий');
//Обязательные поля
$require_fields = array('name', 'phone', 'email');

$message = '';

//Проверка на обязательность полей, валидация емайла и формирование сообщения для обратной связи
foreach ($fields as $field => $fname) {
    if (in_array($field, $require_fields) && empty($_POST[$field])) {
        $error .= 'Поле "' . $fname . '" обязательно к заполнению<br>';
    }
    $message .= '<b>' . $fname . ':</b> ' . $_POST[$field] . '<br>';
}
if (!empty($_POST['email']) && !preg_match('/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i', $_POST['email'])) {
    $error .= 'Поле "E-mail" неверного формата.';
}

//Отправка емайл
if (empty($error)) {
    $sitename = $_SERVER['SERVER_NAME'];
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: $sitename <info@$sitename>\r\n";
    if (!mail('like-person@mail.ru', 'Обратная связь', $message, $headers)) {
        $error = 'Сообщение не отправлено';
    }
    
    //Логирование
    $logtext = empty($error) ? 'OK: Сообщение отправлено' : 'ERROR: '.$error;
    $real_log_file = dirname(__FILE__) . '/logs.log';
    $h = fopen($real_log_file , 'ab');
    fwrite($h, date('Y-m-d H:i:s ') . '[' . addslashes($_SERVER['REMOTE_ADDR']) . '] ' . $logtext . "\n");
    fclose($h);

}
if( !empty($error) ) $out = array('success' => false, 'message' => $error.  serialize($_POST));

echo json_encode($out);