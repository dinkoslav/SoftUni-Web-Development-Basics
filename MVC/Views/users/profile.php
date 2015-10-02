<?= $model->error ? $model->error : ''; ?>

<h1>Hello, <?= htmlspecialchars($model->username); ?></h1>
<h3>
    Resources:
    <p>Gold: <?= $model->gold; ?></p>
    <p>Food: <?= $model->food; ?></p>
</h3>

<form action="" method="post">
    <div>
        <input type="text" name="username" value="<?= $model->username; ?>">
        <input type="password" name="password">
        <input type="password" name="confirm">
        <input type="submit" name="edit" value="Edit">
    </div>
</form>

Go to:
<div class="menu">
    <a href="buildings">Buildings</a>
</div>
