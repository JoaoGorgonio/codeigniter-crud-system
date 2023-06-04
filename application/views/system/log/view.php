<link rel="stylesheet" href="<?= base_url('assets/css/views/log.css'); ?>">
<section class="log-view my-5">
    <div class="container">
        <div class="row">
            <div class="user-title">
                <h1>Exibição de <span>Logs</span></h1>
            </div>
            <div class="log-table">
                <?php if (count($logs) > 0) { ?>
                    <table class="mt-4 text-center col-sm-12">
                        <thead>
                            <tr>
                                <th>Nome do Usuário</th>
                                <th>Código do Usuário</th>
                                <th>Ação no Sistema</th>
                                <th>Data</th>
                                <th>Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($logs as $log) { ?>
                                <tr>
                                    <td><?= $log->nm_usuario; ?></td>
                                    <td><?= $log->cd_usuario; ?></td>
                                    <td><?= $log->nm_tipo_log; ?></td>
                                    <td>
                                        <?php $date = $log->dt_log;
                                        $formattedDate = date('d/m/Y', strtotime($date));
                                        echo $formattedDate; ?>
                                    </td>
                                    <td><?= $log->hr_log; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <p class="mt-5">Não existem logs cadastrados no momento.</p>
                <?php } ?>
            </div>
        </div>
    </div>
</section>