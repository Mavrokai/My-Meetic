<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    setFlashMessage('error', 'Session expirée, veuillez vous reconnecter');
    redirect('../vue/Auth/login.php');
    exit;
}




function setFlashMessage($type, $message)
{
    $_SESSION['flash'][$type] = $message;
}

function redirect($url)
{
    header("Location: $url");
    exit;
}

function redirectBack()
{
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
