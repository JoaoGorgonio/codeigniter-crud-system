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
        <script src="<?= base_url('assets/js/script.js'); ?>"></script>
        
        <script>
            const url = '<?= site_url(''); ?>';
        </script>
    </body>
</html>
