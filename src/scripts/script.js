$.validator.addMethod("minAge", function(value, element, min) {
    var today = new Date();
    var birthDate = new Date(value);
    var age = today.getFullYear() - birthDate.getFullYear();

    if (age > min + 1) {
      return true;
    }

    var m = today.getMonth() - birthDate.getMonth();

    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
      age--;
    }

    return age >= min;
  }, "Você não tem idade!");
    
    $('#botao').click(function() {
        if ($('#FormVolunteer').validate ({
            focusInvalid: true,
            errorClass: "is-invalid",
            errorElement:'div',
            rules: {
                formNomeVolunteer: {
                    required: true,
                    minlength: 5
                },
                formSobrenomeVolunteer: {
                    required: true,
                    minlength: 5
                },
                formEmailVolunteer: {
                    required: true,
                    minlength: 10
                },
                formCPFVolunteer: {
                    required: true,

                    minlength: 11
                },
                formRGVolunteer: {
                    required: true,
                    minlength: 10
                },
                formTelVolunteer: {
                    required: true,
                    minlength: 11
                },
                BirthDateVolunteer: {
                    required: true,
                    minAge: 14
                },
                formEstadoVolunteer: {
                    required: true
                },
            },
            messages: {
                formNomeVolunteer: {
                    required: "Por favor, insira seu nome!",
                    minlength: "Seu nome tem que ser maior!"
                },
                formSobrenomeVolunteer: {
                    required: "Por favor, insira seu sobrenome!",
                    minlength: "Seu nome tem que ser maior!"
                },
                formEmailVolunteer: {
                    required: "Por favor, insira seu email!",
                    minlength: "Seu email está incompleto!",
                    email: "Este não é um endereço de email válido!"
                },
                formCPFVolunteer: {
                    required: "Por favor, insira seu CPF!",
                    minlength: "Seu CPF está incompleto!",
                    number: "Coloque apenas números!"
                },
                formRGVolunteer: {
                    required: "Por favor, insira seu RG!",
                    minlength: "Seu RG está incompleto!",
                    number: "Coloque apenas números!"
                },
                formTelVolunteer: {
                    required: "Por favor, insira seu número de celular!",
                    minlength: "Seu celular está incompleto!",
                    number: "Coloque apenas números!"
                },
                BirthDateVolunteer: {
                    required: "Por favor, insira sua data de nascimento!",
                    max: "Por favor, coloque uma data de nascimento menor que a data de hoje!",
                    minAge: "Por favor, você tem que ter pelo menos 14 anos"
                },
                formEstadoVolunteer: {
                    required: "Por favor, insira seu estado!",
                },
            },
        })); {
            $('#FormVolunteer').submit();
        };
    });

    // submit instituicao

    