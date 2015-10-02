<?= $model->error ? $model->error : ''; ?>

<h1>Buildings</h1>

<h3>
    Resources:
    <p>Gold: <?= $model->gold; ?></p>
    <p>Food: <?= $model->food; ?></p>
</h3>

<table border="1">
    <tr>
        <td>Building name</td>
        <td>Level</td>
        <td>Gold</td>
        <td>Food</td>
        <td>Action</td>
    </tr>
    <?php foreach($model->buildings as $building): ?>
        <tr>
            <td><?= $building['name'] ?></td>
            <td><?= $building['level'] ?></td>
            <td><?= $building['gold'] ?></td>
            <td><?= $building['food'] ?></td>
            <td><a href="buildings/<?=$building['building_id']?>">Build</a></td>
        </tr>
    <?php endforeach; ?>
</table>