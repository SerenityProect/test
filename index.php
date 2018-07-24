<?php
require 'Controller.php';
require 'Database.php';

$controller = new Controller();

if($controller->isFilter()) {
    $users = $controller->filterUsersByEmail($_GET['email']);
} else {
    $users = $controller->getAllUsers();
}
if($controller->isCreate()) {
    $controller->createUser();
}
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='//fonts.googleapis.com/css?family=Arimo:400,700&subset=hebrew,latin' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="conteiner">
    <h1>Users</h1>

    <form action="" method="GET">
        <input type="text"
               name="email"
               placeholder="filter by email"
               value="<?php echo isset($_GET['email']) ? $_GET['email'] : '' ?>">
        <input type="submit" name="action" value="filter">
         <?php if ($controller->isFilter()) : ?>
            <a href="<?php echo $controller->getConfig('base_url'); ?>">
                clear
            </a>
        <?php endif; ?>
    </form>


    <table cellpadding="5" cellspacing="5">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>password</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['password']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Create user</h2>

    <?php if(! empty($controller->createErrors)): ?>
        <h3>Errors</h3>
        <ul>
            <?php foreach ($controller->createErrors as $error): ?>
            <li>
                <?php echo $error; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="" method="POST">
        <p>
            <label for="username">Nmae</label>
            <input type="text" name="username" id="username">
        </p>
        <p>
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
        </p>
        <p>
            <label for="password">Password</label>
            <input type="text" name="password" id="password">
        </p>
        <input type="submit" name="action" value="create">
    </form>
</div>
</body>
</html>