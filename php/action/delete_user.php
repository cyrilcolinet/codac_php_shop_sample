<?php

require_once dirname(__FILE__) . '/../models/User.php';

if (!isset($_GET['id']))
    return;

$user = User::findById($_GET['id']);
$success = true;

if ($user == null) {
    $success = false;
} else {
    $success = $user->delete();
}

$host = explode('?', $_SERVER['HTTP_REFERER']);
header("Location: " . $host[0] . "?userDeleted=" . $success);
