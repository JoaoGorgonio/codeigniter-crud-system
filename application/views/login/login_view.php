<link rel="stylesheet" href="<?= base_url('assets/css/views/login.css'); ?>">
<section class="login">
    <div class="container-fluid g-0">
        <div class="row g-0">
            <div class="col-lg-6 d-lg-block d-none login-banner">
                <img src="<?= base_url('assets/images/login/banner.jpg')?>" alt="Sistema" class="vh-100 object-fit-cover w-100">
            </div>
            <div class="col-lg-6 col-12 login-container d-flex flex-column justify-content-center align-items-center vh-100">
                <img src="<?= base_url('assets/images/logo-white.png')?>" alt="Logo" class="col-xxl-3 col-lg-4 col-6 mb-5">
                <form class="login-form d-flex flex-column p-5 col-xxl-6 col-xl-7 col-lg-9 col-10 rounded-3" method="POST">
                    <h1 class="text-center">Acessar Conta</h1>
                    <div class="mt-5 col-12">
                        <label for="login-email">E-mail:</label>
                        <input type="email" name="email" class="col-12 rounded-1 p-2" id="login-email" value="teste@gmail.com">
                    </div>
                    <div class="mt-5 col-12">
                        <label for="login-password">Senha:</label>
                        <input type="password" name="password" class="col-12 rounded-1 p-2" id="login-password" value="senha123">
                    </div>
                    <button class="mt-5 py-2 rounded-3 enviar-form" type="submit">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="<?= base_url('assets/js/views/login.js'); ?>" defer></script>