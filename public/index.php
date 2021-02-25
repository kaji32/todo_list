<?php 

require_once(__DIR__.'/../app/config.php');


createToken();



if($_SERVER['REQUEST_METHOD'] === 'POST'){
   validateToken();

    $action = filter_input(INPUT_GET, 'action');
    switch($action)
    {   
        case 'add': 
            addTodo($db);
            break;
        
        case 'toggle':
            toggleTodo($db);
            break;
        
        case 'delete':
            deleteTodo($db);
            break;
        
        default:
            exit;

    }

    header('location:index.php');
    
    exit;
}

$todos = getTodos($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main>
<h1>Todo List</h1>

<form action="?action=add" method="post">
    <input type="text" name="title">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']);?>">
    <button name="add" value="ADD">ADD</button>
</form>


<ul>
<?php foreach($todos as $todo): ?>
    <li>
        <form action="?action=toggle" method="post">
            <input type="checkbox" <?= $todo[isDone] ? 'checked' : '' ; ?>>
            <input type="hidden" name='id' value='<?= h($todo[id]); ?>'>
            <input type="hidden" name="token" value="<?= h($_SESSION['token']);?>">
        </form>

        <span class=<?= $todo[isDone] ? 'done' : '' ;?>>
            <?= h($todo[title]); ?>
        </span>
    

<form action="?action=delete" method="post" class="delete-form">
    <span class="delete">X</span>
    <input type="hidden" name='id' value='<?= h($todo[id]); ?>'>
    <input type="hidden" name="token" value="<?= h($_SESSION['token']);?>">
</form>
</li>

<?php endforeach;?>
</ul>
</main>
   <script src="js/main.js"></script>
</body>
</html>