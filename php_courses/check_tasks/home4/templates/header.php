<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/main_menu.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/include/login.php';
include $_SERVER['DOCUMENT_ROOT'] . '/include/password.php';

$isAuth = null;

if (!empty($_POST)) {

    $login = trim(htmlspecialchars($_POST['login']));
    $password = trim(htmlspecialchars($_POST['password']));
    $isAuth = false;
    if (!empty($login) && !empty($password)) {
        for ($i = 0; $i < count($usersLogin); $i++) {
            if ($login === $usersLogin[$i] && $password == $usersPasswords[$i]) {
                $isAuth = true;
                break;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="../../styles.css" rel="stylesheet">
    <title>Project - ведение списков</title>
</head>
<body>
