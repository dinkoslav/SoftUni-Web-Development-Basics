<h1>Hello, <?= $data->getUsername(); ?> </h1>
<h3>
    Resources:
    <p>Gold: <?= $data->getGold(); ?></p>
    <p>Food: <?= $data->getFood(); ?></p>
</h3>
<form method="POST">
    <input type="text" name="username" value="<?= $data->getUsername(); ?>">
    <input type="password" name="password">
    <input type="password" name="confirm">
    <input type="submit" name="edit" value="Edit">
</form>
<br>

<?php if (isset($_GET['error'])): ?>
<h2>An error occurred!</h2>
<?php elseif (isset($_GET['success'])): ?>
<h2>Profile edited successfully!</h2>
<?php endif; ?>

Go to:
<div class="menu">
    <a href="buildings.php">Buildings</a>
</div>

