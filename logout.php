<?php
/**
 * Created by PhpStorm.
 * User: kratos
 * Date: 2019/01/04
 * Time: 6:34 PM
 */
session_start();
$_SESSION = array();

session_destroy();

header("location:login.php");
exit;

?>

