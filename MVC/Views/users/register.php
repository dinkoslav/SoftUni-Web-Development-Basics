<?= $model->error ? $model->error : '' ?>

<form action="" method="POST">
    <label for="username">Username: </label>
    <input type="text" name="username" id="username"><br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password"><br>
    <input type="submit" value="Register">
</form>