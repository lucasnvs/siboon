<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Não Encontrada - 404</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        h1 {
            font-size: 5rem;
            color: #d9534f; /* Cor de destaque */
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        p {
            margin-bottom: 2rem;
        }

        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #5bc0de; /* Cor do botão */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #31b0d5; /* Cor do botão ao passar o mouse */
        }
    </style>
</head>
<body>
<div class="container">
    <h1>404</h1>
    <h2>Página Não Encontrada</h2>
    <p>Desculpe, mas a página que você está procurando não existe ou foi removida.</p>
    <a href="<?=url("/")?>" class="btn">Voltar para a Página Inicial</a>
</div>
</body>
</html>
