<?php $this->layout("master", ["title" => $title, "products" => $products]); ?>
<?php $this->start("specific-style"); ?>
    <link rel="stylesheet" href="<?= assets('product/product.css', 'admin') ?>">
    <link rel="stylesheet" href="<?= assets('components/table/table.css', 'shared') ?>">
<?php $this->end(); ?>

<?php
    $header = ["Cód. Item", "Produto", "Valor", "Qtd. Estoque", "Ações"];
?>

<div class="big-options-container">
    <a href="<?= url("admin/produtos/registrar") ?>"><button class="btn green">Novo Produto</button></a>
</div>

<div class="container-section">
    <div class="container-section-header">
        <p>Tabela de Produtos</p>
    </div>
    <div class="container-section-body">
        <table class="default-table">
            <thead>
            <?php foreach ($header as $th): ?>
                <th> <?= $th ?> </th>
            <?php endforeach; ?>
            </thead>
            <tbody>
            <?php foreach ($products as $tr): ?>
                <tr>
                    <td><?= $tr["id"] ?></td>
                    <td><?= $tr["name"] ?></td>
                    <td><?= $tr["formated_price_brl"] ?></td>
                    <td>54</td>
                    <td style="text-align: center">
                        <a href="#">
                            <button class="btn green" >Add. Estoque</button>
                        </a>
                        <a href="<?= url("admin/produtos/{$tr['id']}/editar") ?>">
                            <button class="btn">Editar</button>

                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>