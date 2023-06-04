<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title><?= $title ?></title>

        <link rel="icon" href="<?= base_url('assets/images/favicon.png')?>">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,900&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="<?= base_url('assets/libs/bootstrap/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/libs/fontawesome/all.min.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
    </head>
    <body>
        <header>
            <?php if (isset($my_user)) { ?> 
                <link rel="stylesheet" href="<?= base_url('assets/css/components/header.css'); ?>">
                <div class="container">
                    <div class="row">
                        <div class="navbar-header d-flex flex-wrap align-items-center justify-content-between py-3">
                            <a href="<?= base_url('dashboard'); ?>"  class="col-lg-2 col-5">
                                <img class="header-logo w-100" src="<?= base_url('assets/images/logo-white.png'); ?>" alt="Logo">
                            </a>
                            <div class="col-lg-8 col-12 d-lg-block d-none">
                                <a href="<?= base_url('dashboard/user') ?>" class="px-5">Usuários</a>
                                <?php if ($my_user->ic_admin == 1) { ?>
                                    <a href="<?= base_url('dashboard/logs') ?>">Logs do Sistema</a>
                                <?php } ?>
                            </div>
                            <a href="<?= base_url('logout'); ?>" class="col-lg-2 col-12 justify-content-end align-items-center d-lg-flex d-none ">
                                Logout <i class="fa-solid fa-right-from-bracket ms-3"></i>
                            </a>
                            <button class="navbar-toggler d-block d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#conteudo-mobile" aria-controls="conteudo-mobile" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fa-solid fa-bars"></i>
                            </button>
                        </div>
                    </div>
                    <div class="collapse conteudo-header-mobile" id="conteudo-mobile">
                        <div class="d-flex flex-column py-4">
                            <a href="<?= base_url('dashboard/user') ?>" class="mt-3">Usuários</a>
                            <?php if ($my_user->ic_admin == 1) { ?>
                                <a href="<?= base_url('dashboard/logs') ?>" class="mt-3">Logs do Sistema</a>
                            <?php } ?>
                            <a href="<?= base_url('logout'); ?>" class="col-12 justify-content-end align-items-center mt-3">
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </header>

        <main id="content">
            <?= $content; ?>
        </main>

        <footer>
        </footer>

        <script src="<?= base_url('assets/libs/jquery/jquery.min.js'); ?>"></script>
        <script src="<?= base_url('assets/libs/jquery/jquery.mask.min.js'); ?>"></script>
        <script src="<?= base_url('assets/libs/jquery/jquery.validate.min.js'); ?>"></script>
        <script src="<?= base_url('assets/libs/bootstrap/bootstrap.min.js'); ?>"></script>
        <script src="<?= base_url('assets/libs/fontawesome/all.min.js'); ?>"></script>
        <script src="<?= base_url('assets/libs/sweetalert/sweetalert.min.js'); ?>"></script>
        <script src="<?= base_url('assets/js/script.js'); ?>"></script>
        
        <script>
            const base_url = '<?= site_url(''); ?>';
        </script>
    </body>
</html>
