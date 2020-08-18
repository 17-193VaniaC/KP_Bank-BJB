<nav class="navbar navbar-expand-lg navbar-light " style="background-color: #204d95; position: fixed; width: 100%; padding-left: 0;">
    <a class="navbar-brand" href="<?= base_url('dashboard'); ?>" style="margin-left: 20px; color: white; margin-right: 20px;">Bank BJB</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="nav-item dropdown ml-auto">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-right: 100px; text-decoration: none; color: white;">
                <?= $user['NAMA'] ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown"">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>"><b>Logout</b></a>
            </div>
        </div>
    </div>
</nav>
<br>
<br>