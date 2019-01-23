<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
</head>
<body>
    <ul>
        <?php foreach ($tasks as $task) : ?>
        <li>
            <?php if ($task->completed) : ?>
                <s><?= $task->description ?></s>
            <?php else : ?>
                <?= $task->description ?>
            <?php endif ?>
        </li>
        <?php endforeach ?>
    </ul>
</body>
</html>