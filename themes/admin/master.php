<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/icons/siboon-logo-icon.svg">
    <title> ADMIN | Siboon Skate Shop </title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/layout_admin.css">
</head>
<body>
    <aside id="aside-navbar">
        <img id="logo" src="assets/icons/siboon-logo.png">

        <ul id="navigation">
            <li><a>Home</a></li>
            <li><a>Produtos</a></li>
            <li><a>Website</a></li>
            <li><a>Perguntas e Respostas</a></li>
            <li><a>INFO</a></li>
        </ul>
    </aside>
    <section id="main">
        <?= $this->section("content") ?>
    </section>
</body>
</html>