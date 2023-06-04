<link rel="stylesheet" href="<?= base_url('assets/css/views/user.css'); ?>">
<section class="user-view my-5">
    <div class="container">
        <div class="row">
            <div class="user-title">
                <h1>Usuários</h1>
            </div>
            <div class="user-content mt-5">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <a class="btn col-lg-auto col-12" href="<?= base_url('dashboard/user/create') ?>">Criar Usuário</a>
                    <form class="mt-4 mt-lg-0 d-flex align-items-center col-lg-auto col-12" id="search-form" method="POST">
                        <input type="search" placeholder="Pesquisar Usuário" name="search" class="input col-lg-auto col-10">
                        <button type="submit" class="btn col-lg-auto col-2 search-btn">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
                <div class="user-table">
                <?php if (count($users) > 0) { ?>
                    <table class="mt-4 text-center col-sm-12">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Estado</th>
                                <th>Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) { ?>
                                <tr>
                                    <td><?= $user->nm_usuario; ?></td>
                                    <td><?= $user->cd_email; ?></td>
                                    <td>
                                        <?php if ($user->ic_ativo == 1) { ?>
                                            <span class="active-user"><i class="fa-solid fa-unlock me-2"></i> Ativo</span>
                                        <?php }
                                        else { ?>
                                            <span class="inactive-user"><i class="fa-solid fa-lock me-2"></i> Inativo</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($user->ic_ativo == 1) { ?>
                                            <a class="edit-user" href="<?= base_url('dashboard/user/edit/') . $user->cd_usuario ?>">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        <?php }
                                        else { ?>
                                            Indisponível
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <p class="mt-5">Não existem usuários cadastrados no momento.</p>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?= base_url('assets/js/views/user.js'); ?>" defer></script>