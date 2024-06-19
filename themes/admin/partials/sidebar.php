
<aside class="sidebar">
    <header>
        <img class="logo-img" src="<?= assets(resourcePath: "icons/siboon-logo.png") ?>">
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