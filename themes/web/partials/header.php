<header>
    <div id="menu-button">
        <img src="<?= assets('web', 'icons/menu.svg') ?>">
    </div>

    <div id="mid-menu">
        <ul>
            <li><a href=" <?= url() ?>">tênis</a></li>
            <li><a href="<?= url() ?>">skate</a></li>
            <li><a href="<?= url() ?>">vestuário</a></li>
            <li><a href="<?= url() ?>"><img src="<?= assets('web', 'icons/siboon-logo.png') ?>" style="width: 180px;height: 90px"></a></li>
            <li><a href="<?= url() ?>">sale</a></li>
            <li><a href="<?= url() ?>">novidades</a></li>
            <li><a href="<?= url() ?>">marcas</a></li>
        </ul>
    </div>

    <div id="option-menu">
        <img src="<?= assets('web', 'icons/search.svg') ?>">
        <a href="<?= url("entrar") ?>"><img src="<?= assets('web', 'icons/user.svg') ?>"></a>
        <img id="cart-button" src="<?= assets('web', 'icons/shopping-bag.svg') ?>">
    </div>
</header>
