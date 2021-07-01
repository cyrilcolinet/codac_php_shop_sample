<?php

require_once dirname(__FILE__) . '/../models/User.php';

if (!isset($_POST['submit']))
    return;

$values = $_POST;
$user = User::findById($values['id']);
$success = true;

if ($user == null) {
    $success = false;
} else {
    $success = $user->edit($values);
}

$host = explode('?', $_SERVER['HTTP_REFERER']);
header("Location: " . $host[0] . "?userEdited=" . $success);
