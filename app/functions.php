<?php

function addTodo($db){
    $title = trim(filter_input(INPUT_POST, 'title'));
    if($title===''){
        return;
    }

    $stmt = $db->prepare("INSERT INTO todos(title) VALUES (:title)");
    $stmt->bindValue('title', $title, PDO::PARAM_STR);
    $stmt->execute();
}

function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function getTodos($db){
$stmt = $db->query("select * from todos order by id desc;");
$todos = $stmt->fetchAll();
return $todos;
}

function createToken()
{
    if(!isset($_SESSION['token'])){
        $_SESSION['token'] =bin2hex(random_bytes(32));
    }
}

function validateToken()
{
    if
    (empty($_SESSION['token'])||
    $_SESSION['token'] !== filter_input(INPUT_POST, 'token')
    ){
        exit('Invalid post request');
    }
}

function toggleTodo($db){
    $id = filter_input(INPUT_POST, 'id');
    if(empty($id)){
        return;
    }

    $stmt = $db->prepare("UPDATE todos SET isDone = NOT isDone WHERE id = :id" );
    $stmt->bindValue('id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

function deleteTodo($db){
    $id = filter_input(INPUT_POST, 'id');
    if(empty($id)){
        return;
    }

    $stmt = $db->prepare("DELETE FROM todos WHERE id= :id");
    $stmt->bindValue('id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

?>
