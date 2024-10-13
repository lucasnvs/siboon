<?php $this->layout("master", ["title" => $title]); ?>
<?php $this->start("specific-script"); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="module" src="<?= assets('home/home.js', "admin") ?>" async></script>
<?php $this->end(); ?>
<?php $this->start("specific-style"); ?>
<link rel="stylesheet" href="<?= assets('home/home.css', 'admin') ?>">
<?php $this->end(); ?>

<div class="dashboard-container">
    <div class="dashboard-header">
        <div>
            <h1>Dashboard Siboon Skateshop</h1>
            <p>Bem-vindo de volta, admin!</p>
        </div>
        <div>
            <p>Data: <span id="current-date"></span></p>
        </div>
    </div>

    <div class="chart-container">

        <div class="container-section">
            <div class="container-section-header">
                <p>Vendas dos Últimos 7 Dias</p>
            </div>
            <div class="container-section-body">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <div class="container-section">
            <div class="container-section-header">
                <p>Top Produtos Mais Vendidos</p>
            </div>
            <div class="container-section-body">
                <canvas id="topProductsChart"></canvas>
            </div>
        </div>
    </div>
    <br>
    <div class="chart-container">
        <div class="container-section">
            <div class="container-section-header">
                <p>Categorias</p>
            </div>
            <div class="container-section-body">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>

        <div class="container-section">
            <div class="container-section-header">
                <p>Receita Mensal (R$)</p>
            </div>
            <div class="container-section-body">
                <canvas id="monthlyRevenueChart"></canvas>

            </div>
        </div>
    </div>

</div>