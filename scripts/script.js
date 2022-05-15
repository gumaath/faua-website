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
                formCPFVolunteer: {
                    required: true,

                    minlength: 11
                },
                formRGVolunteer: {
                    required: true,
                    minlength: 5
                },
                BirthDateVolunteer: {
                    required: true,
                    minAge: 14
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
                BirthDateVolunteer: {
                    required: "Por favor, insira sua data de nascimento!",
                    max: "Por favor, coloque uma data de nascimento menor que a data de hoje!",
                    minAge: "Por favor, você tem que ter pelo menos 14 anos"
                },
            },
        })); {
            $('#FormVolunteer').submit();
        };
    });

    // submit instituicao

    