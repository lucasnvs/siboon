<?php $this->layout("master", ["title" => $title]); ?>
<?php $this->start("specific-script"); ?>
<script type="module" src="<?= assets('website/website.js', "admin") ?>" async></script>
<?php $this->end(); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('website/website.css', 'admin') ?>">
<?php $this->end(); ?>

<h2>Aqui você pode gerenciar suas informações do site.</h2>
<br>
<div class="container-section">
    <div class="container-section-header">
        <p>Gerenciar Seções</p>
    </div>
    <div class="container-section-body">
        <ul class="section-list" id="section-list">
            <!-- Seções serão carregadas aqui -->
        </ul>

        <div class="new-section">
            <input type="text" id="new-section-name" placeholder="Nome da nova seção">
            <button id="add-section">Adicionar Seção</button>
        </div>
    </div>
</div>
<br>
<button id="addFeaturedItemBtn" class="btn green" style="margin-bottom: 10px">Adicionar Item Destacado</button>
<div class="container-section">
    <div class="container-section-header">
        <p>Gerenciar Itens Exibidos</p>
    </div>
    <div class="container-section-body">
        <table id="featuredItemsTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Ordem de Exibição</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody id="featuredItemsBody">
                <!-- Itens destacados serão inseridos aqui -->
            </tbody>
        </table>
    </div>
</div>