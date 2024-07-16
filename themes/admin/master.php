<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= assets('assets/icons/siboon-logo-icon.svg') ?>">
    <title> ADMIN | Siboon Skate Shop </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>
    <link rel="stylesheet" href="<?= assets('assets/css/global.css') ?>">
    <link rel="stylesheet" href="<?= assets('assets/css/layout_admin.css', 'admin') ?>">
    <?php if ($this->section("specific-style")): ?>
        <?= $this->section("specific-style") ?>
    <?php endif; ?>
    <script src="<?= assets("assets/js/admin.js", 'admin') ?>" async></script>
    <?php if ($this->section("specific-script")): ?>
        <?= $this->section("specific-script"); ?>
    <?php endif; ?>
</head>
<body>
    <aside class="sidebar">
        <div id="button-toggle-sidebar">
            <i class="material-symbols-outlined">arrow_left</i>
        </div>
        <header>
            <img class="logo-img" src="<?= assets("assets/icons/siboon-logo.png") ?>">
        </header>
        <nav id="navigation">
            <a href="<?= url("admin/") ?>">
                <button>
                    <span>
                        <i class="material-symbols-outlined">home</i>
                        <span>Home</span>
                    </span>
                </button>
            </a>
            <a>
                <button>
                    <span>
                        <i class="material-symbols-outlined">store</i>
                        <span>Vendas</span>
                    </span>
                </button>
            </a>
            <a href="<?= url("admin/produtos") ?>">
                <button>
                    <span>
                        <i class="material-symbols-outlined">package_2</i>
                        <span>Produtos</span>
                    </span>
                </button>
            </a>
            <a>
                <button>
                    <span>
                        <i class="material-symbols-outlined">groups</i>
                        <span>Clientes</span>
                    </span>
                </button>
            </a>
            <a>
                <button>
                    <span>
                        <i class="material-symbols-outlined">public</i>
                        <span>Website</span>
                    </span>
                </button>
            </a>
            <a href="<?= url("admin/faq") ?>">
                <button>
                    <span>
                        <i class="material-symbols-outlined">quiz</i>
                        <span>FAQ</span>
                    </span>
                </button>
            </a>
            <a href="<?= url("admin/institucional") ?>">
                <button>
                    <span>
                        <i class="material-symbols-outlined">domain</i>
                        <span>Institucional</span>
                    </span>
                </button>
            </a>
        </nav>

        <footer>
            <a href="<?= url("admin/institucional") ?>">
                <button>
                    <span>
                        <i class="material-symbols-outlined">settings</i>
                        <span>Configurações</span>
                    </span>
                </button>
            </a>
            <a href="<?= url("admin/institucional") ?>">
                <button>
                    <span>
                        <i class="material-symbols-outlined">arrow_back</i>
                        <span>Sair</span>
                    </span>
                </button>
            </a>
        </footer>
    </aside>

    <section id="main">
        <?= $this->section("content") ?>
    </section>
</body>
</html>