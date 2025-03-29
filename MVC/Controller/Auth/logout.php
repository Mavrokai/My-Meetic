<?php
session_start();
session_unset();
session_destroy();
header('Location: ../../vue/Auth/login.php');
exit;