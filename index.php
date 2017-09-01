<?php
    require_once 'config.php';

    $guestbook = new Guestbook($db);

    if(isset($_POST['send'])) {
        $guestbook->insert($_POST['name'], $_POST['text']);
    }
    if(isset($_POST['opdater'])) {
         $guestbook->update($_POST['editName'], $_POST['editText'], $_GET['edit']);
         header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation-float.css">
    <title>Document</title>
</head>
<body class="row">
<div class="small-6 columns">
<h3>Ny besked</h3>
    <form action="" method="post">
        <label for="name">Dit navn:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="text">Din besked:</label><br>
        <textarea name="text" id="text" cols="30" rows="10"></textarea><br>
        <button name="send" class="button" type="submit">Send</button>
    </form>
</div>
<?php if(isset($_GET['id'])):  ?>
    <?php $data = $guestbook->getOne($_GET['id']); ?>
    <div class="small-6 columns">
    <h3><?= $data->name ?></h3>
    <p><?= $data->msg ?></p>
    </div>
<?php elseif(isset($_GET['del'])): $guestbook->deleteOne($_GET['del']); header('Location: index.php');?>

<?php elseif(isset($_GET['edit'])): ?>
<?php $data = $guestbook->getOne($_GET['edit']); ?>
<div class="small-6 columns">
<h3>Rediger - <?= $data->name ?></h3>
    <form action="" method="post">
        <label for="editName">Dit navn:</label><br>
        <input type="text" id="editName" name="editName" value ="<?= $data->name ?>"><br>
        <label for="editText">Din besked:</label><br>
        <textarea name="editText" id="editText" cols="30" rows="10"><?= $data->msg ?></textarea><br>
        <button name="opdater" class="success button" type="submit">Opdater</button>
    </form>
</div>

<?php endif; //else: ?>

    <table>
                    <tr>
                        <th>Navn</th>
                        <th></th>
                        <th></th>
                    </tr>
    <?php
        foreach($guestbook->getAll() as $value){
?>
                    <tr>
                        <td><a href="index.php?id=<?= $value->id ?>"><h3><?= $value->name ?></h3></a></td>
                        <td><a href="index.php?del=<?= $value->id ?>" onclick="return confirm('Are you sure you want to Remove?');"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        <td><a href="index.php?edit=<?= $value->id ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                    </tr>
                    <?php
        }
    //endif;
    ?>
     </table>
</body>
</html>
