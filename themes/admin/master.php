<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= assets('icons/siboon-logo-icon.svg') ?>">
    <title> ADMIN | Siboon Skate Shop </title>
    <link rel="stylesheet" href="<?= assets(resourcePath: 'css/global.css') ?>">
    <link rel="stylesheet" href="<?= assets('admin', 'css/layout_admin.css') ?>">
    <?php if ($this->section("specific-style")): ?>
        <?= $this->section("specific-style") ?>
    <?php endif; ?>
</head>
<body>
    <?php $this->insert('partials/aside') ?>

    <section id="main">
        <?= $this->section("content") ?>
    </section>
</body>
</html>