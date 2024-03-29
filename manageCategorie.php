<?php
require 'functions.php';

$title = $_POST['modify-title'];
$description = $_POST['modify-description'];
$order = $_POST['modify-order'];
$image = $_POST['modify-image'];
$id = $_GET['idTopic'];
$InputPwd = $_POST['modify-adminPasswordInput'];

if(
    !isset($title) ||
    !isset($description) ||
    !isset($order) ||
    empty($InputPwd) ||
    count($_POST) != 4
){
    header('Location: error404.php');
    die();
}

$userId = $_SESSION['userId']; // l'id de l'user connecté (logiquement, l'admin)
$db = database();

$adminPwdInDbQuery = $db->prepare("SELECT password FROM RkU_USER WHERE id=:id");
$adminPwdInDbQuery->execute(["id"=>$userId]);
$adminPwdInDb = $adminPwdInDbQuery->fetch()['password'];

if(!password_verify($InputPwd, $adminPwdInDb)){
    setMessage('Delete', ["Mot de passe incorrect, attention \"l'admin\", plus que x essais !"], 'warning');
    header('Location: users.php');
    die();
}

$userModifyQuery = $db->prepare("UPDATE RkU_TOPIC SET title=:title, description=:description, topicOrder=:topicOrder WHERE id=:idTopic");
$userModifyQuery->execute([
    "title" => $title,
    "description" => $description,
    "idTopic" => $id,
    "topicOrder"=> $order
]);
setMessage('Modify', ["La catégorie a bien été modifiée."], 'success');
header('Location: forum.php');
die();