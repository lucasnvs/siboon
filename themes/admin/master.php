<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= assets(resourcePath: 'icons/siboon-logo-icon.svg') ?>">
    <title> ADMIN | Siboon Skate Shop </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>
    <link rel="stylesheet" href="<?= assets(resourcePath: 'css/global.css') ?>">
    <link rel="stylesheet" href="<?= assets('admin', 'css/layout_admin.css') ?>">
    <?php if ($this->section("specific-style")): ?>
        <?= $this->section("specific-style") ?>
    <?php endif; ?>
    <?php if ($this->section("specific-script")): ?>
        <?= $this->section("specific-script"); ?>
    <?php endif; ?>
</head>
<body>
    <?php $this->insert('partials/sidebar') ?>

    <section id="main">
        <?= $this->section("content") ?>
    </section>
</body>
</html>