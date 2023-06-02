$(function() {
    $('.login-form').validate({
        rules: {
            email: {
                required: true,
                minlength: 3
            },
            password: {
                required: true,
                minlength: 8
            }
        },
        messages: {
           email: {
                required: 'Informe seu email',
                email: 'Informe um email válido'
            },
            password: {
                required: 'Informe uma senha',
                minlength: 'A sua senha deve conter no mínimo 8 caracteres'
            }
        },
        submitHandler: function(form) {
            let data = $(form).serialize();
            $.ajax({
                type: 'POST',
                url: base_url + 'login/auth',
                data: data,
                beforeSend: function()
                {
                    $('.enviar-form').text("Enviando...");
                    $('.enviar-form').prop('disabled', true);
                    $("input").prop('disabled', true);
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
                        window.location.replace('/dashboard')
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Não foi possível realizar o login.',
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
                    $('.enviar-form').text("Entrar");
                    $('.enviar-form').prop('disabled', false);
                    $("input").val("");
                    $("input").prop('disabled', false);
                }
            });
        }
    });
});