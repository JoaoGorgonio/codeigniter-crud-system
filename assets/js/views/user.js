$(function() {
    $('#search-form').on('submit', function(e) {
        const searchValue = $('input[name="search"]').val();
        $.ajax({
            type: 'POST',
            url: base_url + 'user/show',
            data: { 
                search: searchValue 
            },
            success: function(response) {
                if (!$(response).find('.user-table').children().length > 0) 
                {
                    $('.user-table').html('<p class="mt-5">Não existem usuários cadastrados no momento.</p>')
                }
                else
                {
                    $('.user-table').html($(response).find('.user-table').children());
                }
            }
        });
        e.preventDefault();
    });

    $('#next-step').on('click', function() {
        $('.user-information').fadeOut(500, function() {
            $('.user-address').fadeIn();
            $('.steps').removeClass('active-step');
            $('.last-step').addClass('active-step');
        });
    });

    $('#previous-step').on('click', function() {
        $('.user-address').fadeOut(500, function() {
            $('.user-information').fadeIn();
            $('.steps').removeClass('active-step');
            $('.first-step').addClass('active-step');
        });
    });

    function definirMascaras() 
    {
        $('input[name="user_cep[]"]').mask('00000-000');
    }
    definirMascaras();

    $('#add-address').on('click', function() {
        const lastAddress = $('.address-content:last');
        const current = lastAddress.find('.content-collapse').attr('id');
        const number = parseInt(current.match(/\d+/)[0]) + 1;
        const id = 'endereco' + number;
    
        lastAddress.clone().insertAfter(lastAddress);
    
        const newAddress = $('.address-content').last();
        newAddress.find('.content-collapse').attr('id', id);
        newAddress.find('.button-collapse').attr('aria-controls', id);
        newAddress.find('.button-collapse').text('Endereço N°' + number);
        newAddress.find('.button-collapse').attr('data-bs-target', '#' + id);
        newAddress.find('input[type="text"], textarea').val('');
        newAddress.find('select[name="user_state[]"]').val('').find('option:first').prop({
            selected: true,
            disabled: true
        });
        if (!newAddress.find('.excluir-endereco').length) {
            newAddress.find('.content-collapse').append('<p class="my-3 excluir-endereco" style="cursor: pointer;">Excluir endereço</p>');
        }
        definirMascaras();
    });

    $(document).on('click', '.excluir-endereco', function() {
        $(this).closest('.address-content').fadeOut(500, function() {
            $(this).closest('.address-content').remove();
        });
    });
    
    $(document).on('blur', 'input[name="user_cep[]"]', function() {
        const cep = $(this).val().replace(/\D/g, '');
        const street = $(this).closest('.address-content').find('input[name="user_street[]"]');
        const district = $(this).closest('.address-content').find('input[name="user_district[]"]');
        const city = $(this).closest('.address-content').find('input[name="user_city[]"]');
        const state = $(this).closest('.address-content').find('select[name="user_state[]"]');
    
        if (cep.length === 8) {
            $.ajax({
                url: 'https://viacep.com.br/ws/' + cep + '/json/',
                dataType: 'jsonp',
                crossDomain: true,
                contentType: 'application/json',
                success: function(data) {
                    if (!data.erro) {
                        street.val(data.logradouro);
                        district.val(data.bairro);
                        city.val(data.localidade);
                        state.val(data.uf);
                    } else {
                        console.log('CEP não encontrado.');
                    }
                },
                error: function() {
                    console.log('Ocorreu um erro na requisição.');
                }
            });
        }
    });

    $.validator.addMethod("notEmptyArray", function(value, element) {
        let allFilled = true;
        const fieldName = $(element).attr('name');
        const field = $('input[name="' + fieldName + '"]');
        field.each(function() {
            if ($(this).val() === '') {
                allFilled = false;
                return false; // Encerra o loop each() se um campo estiver vazio
            }
        });
        return allFilled;
    }, "Todos os campos de endereço devem ser preenchidos.");

    $.validator.addMethod("notEmptyArraySelect", function(value, element) {
        let allFilledSel = true;
        const selectName = $(element).attr('name');
        const select = $('select[name="' + selectName + '"]');
        select.each(function() {
            if ($(this).val() === '' || $(this).val() === null || $(this).val() === undefined) {
                allFilledSel = false;
                return false; // Encerra o loop each() se um campo estiver vazio
            }
        });
        return allFilledSel;
    }, "Todos os campos de endereço devem ser preenchidos.");

    $('#submit-user').on('click', function() {
        $('#register-form').validate({
            ignore: [],
            rules: {
                user_name: {
                    required: true,
                    minlength: 3
                },
                user_email: {
                    required: true,
                    email: true
                },
                user_password: {
                    required: true,
                    minlength: 8
                },
                user_confirm_password: {
                    equalTo: '#user-pass',
                    required: true
                },
                "user_cep[]": {
                    notEmptyArray: true
                },
                "user_state[]": {
                    notEmptyArraySelect: true
                },
                "user_city[]": {
                    notEmptyArray: true
                },
                "user_district[]": {
                    notEmptyArray: true
                },
                "user_street[]": {
                    notEmptyArray: true
                },
                "user_street_id[]": {
                    notEmptyArray: true
                }
            },
            messages: {
                user_name: {
                    required: 'Informe o nome do usuário.',
                    minlength: 'Digite um nome com 3 ou mais letras.'
                },
                user_email: {
                    required: 'Informe um e-mail para o usuário.',
                    email: 'Informe um email válido.'
                },
                user_password: {
                    required: 'Informe uma senha para o usuário.',
                    minlength: 'Digite um nome com 8 ou mais letras.'
                },
                user_confirm_password: {
                    equalTo: 'As senhas não coincidem.',
                    required: 'Informe a senha de confirmação.'
                },
                "user_cep[]": {
                    notEmptyArray: 'Todos os campos de CEP devem ser preenchidos.'
                },
                "user_state[]": {
                    notEmptyArraySelect: 'Todos os campos de estado devem ser preenchidos.'
                },
                "user_city[]": {
                    notEmptyArray: 'Todos os campos de cidade devem ser preenchidos.'
                },
                "user_district[]": {
                    notEmptyArray: 'Todos os campos de bairro devem estar selecionados.'
                },
                "user_street[]": {
                    notEmptyArray: 'Todos os campos de rua devem ser preenchidos.'
                },
                "user_street_id[]": {
                    notEmptyArray: 'Todos os número da residência devem ser preenchidos.'
                }
            },
            submitHandler: function(form) {
                let data = $(form).serialize();
                $.ajax({
                    type: 'POST',
                    url: base_url + 'user/registering',
                    data: data,
                    beforeSend: function() {
                        $('#submit-user').text("Cadastrando...");
                        $('#submit-user').prop('disabled', true);
                        $("input, textarea, select").prop('disabled', true);
                    },
                    success: function(response) {
                        const res = JSON.parse(response);
                        if (!res.success) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Tente novamente',
                                text: res.message,
                                confirmButtonText: 'Confirmar'
                            }).then((result) => {
                                if (result.isConfirmed)
                                {
                                    window.location.reload();
                                }
                            });
                        }
                        else 
                        {
                            Swal.fire({
                                icon: 'success',
                                title: 'Usuário cadastrado',
                                text: res.message,
                                confirmButtonText: 'Confirmar'
                            }).then((result) => {
                                if (result.isConfirmed)
                                {
                                    window.location.replace('/dashboard/user');
                                }
                            });
                            
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Não foi possível cadastrar o usuário.',
                            text: 'Ocorreu algum erro no servidor. Aguarde e tente novamente.',
                            confirmButtonText: 'Confirmar'
                        }).then((result) => {
                            if (result.isConfirmed)
                            {
                                window.location.reload();
                            }
                        });
                    },
                    complete: function() {
                        $('#submit-user').text("Cadastrar Usuário");
                        $('#submit-user').prop('disabled', false);
                        $("input, textarea").val("");
                        $("input, textarea, select").prop('disabled', false);
                    }
                });
            }
        });

        if (!$('#register-form').valid()) {
            Swal.fire({
                title: 'Tente novamente',
                icon: 'warning',
                text: 'Verifique se todos os campos estão preenchidos corretamente.'
            })
        }
    });

    $('#submit-user-edit').on('click', function() {
        $('#edit-form').validate({
            ignore: [],
            rules: {
                user_name: {
                    required: true,
                    minlength: 3
                },
                user_email: {
                    required: true,
                    email: true
                },
                user_password: {
                    required: true,
                    minlength: 8
                },
                "user_cep[]": {
                    notEmptyArray: true
                },
                "user_state[]": {
                    notEmptyArraySelect: true
                },
                "user_city[]": {
                    notEmptyArray: true
                },
                "user_district[]": {
                    notEmptyArray: true
                },
                "user_street[]": {
                    notEmptyArray: true
                },
                "user_street_id[]": {
                    notEmptyArray: true
                }
            },
            messages: {
                user_name: {
                    required: 'Informe o nome do usuário.',
                    minlength: 'Digite um nome com 3 ou mais letras.'
                },
                user_email: {
                    required: 'Informe um e-mail para o usuário.',
                    email: 'Informe um email válido.'
                },
                user_password: {
                    required: 'Informe uma senha para o usuário.',
                    minlength: 'Digite um nome com 8 ou mais letras.'
                },
                "user_cep[]": {
                    notEmptyArray: 'Todos os campos de CEP devem ser preenchidos.'
                },
                "user_state[]": {
                    notEmptyArraySelect: 'Todos os campos de estado devem ser preenchidos.'
                },
                "user_city[]": {
                    notEmptyArray: 'Todos os campos de cidade devem ser preenchidos.'
                },
                "user_district[]": {
                    notEmptyArray: 'Todos os campos de bairro devem estar selecionados.'
                },
                "user_street[]": {
                    notEmptyArray: 'Todos os campos de rua devem ser preenchidos.'
                },
                "user_street_id[]": {
                    notEmptyArray: 'Todos os número da residência devem ser preenchidos.'
                }
            },
            submitHandler: function(form) {
                let data = $(form).serialize();
                $.ajax({
                    type: 'POST',
                    url: base_url + 'user/editing',
                    data: data,
                    beforeSend: function() {
                        $('#submit-user-edit').text("Editando...");
                        $('#submit-user-edit').prop('disabled', true);
                        $("input, textarea, select").prop('disabled', true);
                    },
                    success: function(response) {
                        const res = JSON.parse(response);
                        if (!res.success) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Tente novamente',
                                text: res.message,
                                confirmButtonText: 'Confirmar'
                            }).then((result) => {
                                if (result.isConfirmed)
                                {
                                    window.location.reload();
                                }
                            });
                        }
                        else 
                        {
                            Swal.fire({
                                icon: 'success',
                                title: 'Usuário atualizado.',
                                text: res.message,
                                confirmButtonText: 'Confirmar'
                            }).then((result) => {
                                if (result.isConfirmed)
                                {
                                    window.location.replace('/dashboard/user');
                                }
                            });
                            
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Não foi possível editar o usuário.',
                            text: 'Ocorreu algum erro no servidor. Aguarde e tente novamente.',
                            confirmButtonText: 'Confirmar'
                        }).then((result) => {
                            if (result.isConfirmed)
                            {
                                window.location.reload();
                            }
                        });
                    },
                    complete: function() {
                        $('#submit-user-edit').text("Editar Usuário");
                        $('#submit-user-edit').prop('disabled', false);
                        $("input, textarea, select").prop('disabled', false);
                    }
                });
            }
        });

        if (!$('#edit-form').valid()) {
            Swal.fire({
                title: 'Tente novamente',
                icon: 'warning',
                text: 'Verifique se todos os campos estão preenchidos corretamente.'
            })
        }
    });
});
