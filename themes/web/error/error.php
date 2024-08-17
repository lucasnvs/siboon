<?php $this->data(['title' => $title]); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<style>
    body {
        position: absolute;
        display: flex;
        flex-direction: column;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        background-color: #f2f2f2;
    }

    header {
        background-color: #fff;
        padding: 20px;
        text-align: center;
    }

    h1 {
        font-size: 90px;
        color: #333;
    }

    main {
        position: relative;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        padding: 50px;
        height: calc(100% - 150px);
    }

    a {
        color: #FFF;
        padding: 30px;
        background-color: var(--primary-color);
        border-radius: 10px;
    }

    footer {
        height: 50px;
        width: calc(100% - 20px);
        position: absolute;
        align-self: flex-end;
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 10px;
        bottom: 0;
    }
</style>

    <main>
        <h1><?= $title ?></h1>
        <h3>Oooops! Algo deu errado.</h3>
        <a href="<?= url('/') ?>">Voltar para à página principal</a>
    </main>

    <footer>
        <p>&copy; Siboon SkateShop</p>
    </footer>
</body>
</html>