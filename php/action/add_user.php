<?php

require_once dirname(__FILE__) . '/../models/User.php';

if (!isset($_POST['submit']))
    return;

$values = $_POST;
$user = User::create($values['firstName'], $values['lastName'], $values['email'], $values['password']);
$success = true;

if ($user == null) {
    $success = false;
}
$host = explode('?', $_SERVER['HTTP_REFERER']);
header("Location: " . $host[0] . "?userAdded=" . $success);
