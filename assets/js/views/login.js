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
                url: $url + 'login/authenticator',
                data: data,
                beforeSend: function()
                {
                    $('.enviar-form').text("Enviando...");
                    $('.enviar-form').prop('disabled', true);
                    $("input").prop('disabled', true);
                },
                success: function() {
                    window.location.replace('/');
                },
                error: function(xhr) {
                    
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