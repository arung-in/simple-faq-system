<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if (isset($title)) : ?>
        <h1><?= htmlspecialchars($title) ?></h1>
    <?php endif; ?>
    <h1>I'm Arun G & this is templeate file </h1>
</body>
</html>