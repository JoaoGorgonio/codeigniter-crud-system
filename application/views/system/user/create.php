<link rel="stylesheet" href="<?= base_url('assets/css/views/user.css'); ?>">
<section class="user-create my-5">
    <div class="container">
        <div class="row g-0">
            <div class="user-title">
                <h1>Cadastro de <span>Usuários<span></h1>
            </div>
            <form method="POST" class="mt-3 form-user" id="register-form">
                <div class="register-step d-flex flex-wrap align-items-center">
                    <div class="first-step steps active-step col-sm-6 col-12">
                        <i class="fa-solid fa-circle-info me-2"></i> Informações Inicias
                    </div>
                    <div class="last-step steps col-sm-6 col-12">
                        <i class="fa-solid fa-house me-2"></i> Endereço
                    </div>
                </div>
                <div class="user-information mt-5 px-5">
                    <div class="d-flex flex-wrap align-items-center justify-content-between col-12">
                        <div class="col-lg-6 col-12 pe-lg-2 d-flex flex-column">
                            <label for="user-name" class="label">Nome completo:</label>
                            <input type="text" name="user_name" class="input w-100 mt-2" id="user-name">
                        </div>
                        <div class="col-lg-6 col-12 ps-lg-2 mt-lg-0 mt-3 d-flex flex-column">
                            <label for="user-email" class="label">E-mail:</label>
                            <input type="email" name="user_email" class="input w-100 mt-2" id="user-email">
                        </div>
                    </div>

                    <div class="d-flex flex-wrap align-items-center justify-content-between col-12 mt-3">
                        <div class="col-lg-6 col-12 pe-lg-2 d-flex flex-column">
                            <label for="user-pass" class="label">Senha:</label>
                            <input type="password" name="user_password" class="input w-100 mt-2" id="user-pass">
                        </div>
                        <div class="col-lg-6 col-12 ps-lg-2 mt-lg-0 mt-3 d-flex flex-column">
                            <label for="user-confirm-pass" class="label">Confirme a senha:</label>
                            <input type="password" name="user_confirm_password" class="input w-100 mt-2" id="user-confirm-pass">
                        </div>
                    </div>
                    <?php if (!empty($my_user) && $my_user->ic_admin == 1) { ?>
                        <div class="d-flex flex-wrap align-items-center col-12 mt-3 form-switch">
                            <input class="form-check-input" type="checkbox" name="user_admin" role="switch" id="user-admin">
                            <label class="ms-3 mt-2" for="user-admin">O usuário é um administrador?</label>
                        </div>
                    <?php } ?>
                    <div class="my-5 d-flex justify-content-end">
                        <button type="button" class="btn col-md-auto col-12" id="next-step">Próxima etapa</button>
                    </div>
                </div>
                <div class="user-address px-5" style="display: none;">
                    <div class="address-content mt-5">
                        <button class="col-12 button-collapse" type="button" data-bs-toggle="collapse" data-bs-target="#endereco1" aria-expanded="true" aria-controls="endereco1">
                            Endereco N°1
                        </button>
                        <div class="collapse show content-collapse" id="endereco1">
                            <div class="d-flex flex-wrap align-items-center justify-content-between col-12">
                                <div class="col-lg-6 col-12 pe-lg-2 d-flex flex-column">
                                    <label for="cep" class="label">CEP:</label>
                                    <input type="text" name="user_cep[]" class="input w-100 mt-2" id="cep">
                                </div>
                                <div class="col-lg-6 col-12 ps-lg-2 mt-lg-0 mt-3 d-flex flex-column">
                                    <label for="state" class="label">Estado:</label>
                                    <select name="user_state[]" class="input w-100 mt-2" id="state">
                                        <option selected disabled>Selecione um estado...</option>
                                        <?php foreach($states as $state) { ?>
                                            <option value="<?= $state->sg_estado; ?>">
                                                <?= $state->nm_estado; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
    
                            <div class="d-flex flex-wrap align-items-center justify-content-between col-12 mt-3">
                                <div class="col-lg-6 col-12 pe-lg-2 d-flex flex-column">
                                    <label for="city" class="label">Cidade:</label>
                                    <input type="text" name="user_city[]" class="input w-100 mt-2" id="city">
                                </div>
                                <div class="col-lg-6 col-12 ps-lg-2 mt-lg-0 mt-3 d-flex flex-column">
                                    <label for="district" class="label">Bairro:</label>
                                    <input type="text" name="user_district[]" class="input w-100 mt-2" id="district">
                                </div>
                            </div>
    
                            <div class="d-flex flex-wrap align-items-center justify-content-between col-12 mt-3">
                                <div class="col-lg-6 col-12 pe-lg-2 d-flex flex-column">
                                    <label for="street" class="label">Rua:</label>
                                    <input type="text" name="user_street[]" class="input w-100 mt-2" id="street">
                                </div>
                                <div class="col-lg-6 col-12 ps-lg-2 mt-lg-0 mt-3 d-flex flex-column">
                                    <label for="street_id" class="label">N° da Residência:</label>
                                    <input type="text" name="user_street_id[]" class="input w-100 mt-2" id="street_id">
                                </div>
                            </div>
    
                            <div class="d-flex flex-column flex-wrap col-12 mt-3">
                                <label for="complement" class="label">Complemento:</label>
                                <textarea name="user_complement[]" class="input w-100" id="complement" style="resize: none;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="button" class="btn col-md-auto col-12" id="add-address">Adicionar Novo Endereço</button>
                    </div>

                    <div class="my-5 d-flex flex-wrap justify-content-between">
                        <button type="button" class="btn col-md-auto col-12" id="previous-step">Voltar</button>
                        <button type="submit" class="btn col-md-auto col-12 mt-3 mt-lg-0" id="submit-user">Cadastrar Usuário</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script src="<?= base_url('assets/js/views/user.js'); ?>" defer></script>