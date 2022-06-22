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

  jQuery.validator.addMethod("exactlength", function(value, element, param) {
    return this.optional(element) || (value.length == param || value.length == 18);
   });
    
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

    function validarFormInstituicao(idInstitute) {
        if ($('#FormInstituteEdit_'+idInstitute).validate ({
            focusInvalid: true,
            errorClass: "is-invalid",
            errorElement:'div',
            rules: {
                formNomeInstituter: {
                    required: true,
                    minlength: 5
                },
                formRespInstitute: {
                    required: true,
                    minlength: 5
                },
                formCNPJCPFInstituter: {
                    required: true,
                    minlength: 14,
                    exactlength: 14
                },
                formEndInstitute: {
                    required: true,
                    minlength: 20
                },
                formEndInstitute: {
                    required: true,
                    minlength: 20
                },
                formEstadoInstitute: {
                    required: true
                },
                dataInatInstituicao: {
                    required: true
                },
                topicoss: {
                    required: true
                },
            },
            messages: {
                formNomeInstitute: {
                    required: "Por favor, insira o nome da instituição!",
                    minlength: "O nome da instituição tem que ser maior!"
                },
                formRespInstitute: {
                    required: "Por favor, insira o nome do responsável!",
                    minlength: "Seu nome tem que ser maior!"
                },
                formCNPJCPFInstituter: {
                    required: "Por favor, insira o CPF ou CNPJ!",
                    minlength: "O CPF/CNPJ está incompleto!",
                    exactlength: "O CPF/CNPJ é inválido!",
                    number: "Coloque apenas números!"
                },
                formEndInstitute: {
                    required: "Por favor, insira o endereço da instituição!",
                    minlength: "O endereço tem que ser maior!"
                },
                formEstadoInstitute: {
                    required: "Por favor, insira o estado!",
                },
                dataInatInstituicao: {
                    required: "Por favor, insira uma data!",
                    min:"Insira uma data a partir de hoje!"
                },
                topicoss: {
                    required: "Selecione pelo menos um tópico!",
                },
            },
        })) {
            $('#botaoInstituicao_'+idInstitute).click(function() {
                if( $('#FormInstituteEdit_'+idInstitute).valid()) {
                    var clickBtnValue = 'atualizarInstituicao';
                    var ajaxurl = '../src/php/Ajax.php';
                    if($('#FormInstituteEdit_'+idInstitute + '  #ativo_ate_'+idInstitute +':checked').val() == undefined) {
                        valor = "0";
                    } else {
                        valor = $('#FormInstituteEdit_'+idInstitute + ' #ativo_ate_'+idInstitute +':checked').val()
                    }
                    defineOrdemTopicos(idInstitute);
                    var data = {
                    'action': clickBtnValue,
                    'idInstituicao': idInstitute,
                    'formNomeInstitute': $('#FormInstituteEdit_'+idInstitute + ' #formNomeInstitute').val(),
                    'formRespInstitute': $('#FormInstituteEdit_'+idInstitute + ' #formRespInstitute').val(),
                    'formCNPJCPFInstituter': $('#FormInstituteEdit_'+idInstitute + ' #formCNPJCPFInstitute').val(),
                    'formEndInstitute': $('#FormInstituteEdit_'+idInstitute + ' #formEndInstitute').val(),
                    'tipoinstituicao': $('#FormInstituteEdit_'+idInstitute + ' .type-item-box:selected').val(),
                    'cidadeInstitute': $('#FormInstituteEdit_'+idInstitute + ' .cidades_'+idInstitute).val(),
                    'estadoInstitute': $('#FormInstituteEdit_'+idInstitute + ' .estados_'+idInstitute).val(),
                    'ativo_ate': valor,
                    'dataInatInstituicao': $('#FormInstituteEdit_'+idInstitute + ' #date_'+idInstitute).val(),
                    'topicos': $('#FormInstituteEdit_'+idInstitute + ' #topicos_'+idInstitute).val()
                    }
            
                    $.post(ajaxurl, data, function(response) {
                        location.reload();
                    });
                }
            });
        };
    };

    function validarFormInstituicaoNovo() {
        if ($('#FormInstitute').validate ({
            focusInvalid: true,
            errorClass: "is-invalid",
            errorElement:'div',
            rules: {
                formNomeInstituter: {
                    required: true,
                    minlength: 5
                },
                formRespInstitute: {
                    required: true,
                    minlength: 5
                },
                formCNPJCPFInstituter: {
                    required: true,
                    minlength: 14
                },
                formEndInstitute: {
                    required: true,
                    minlength: 20
                },
                formEndInstitute: {
                    required: true,
                    minlength: 20
                },
                formEstadoInstitute: {
                    required: true
                },
                dataInatInstituicao: {
                    required: true
                },
                topicoss: {
                    required: true
                },
            },
            messages: {
                formNomeInstitute: {
                    required: "Por favor, insira o nome da instituição!",
                    minlength: "O nome da instituição tem que ser maior!"
                },
                formRespInstitute: {
                    required: "Por favor, insira o nome do responsável!",
                    minlength: "Seu nome tem que ser maior!"
                },
                formCNPJCPFInstituter: {
                    required: "Por favor, insira o CPF ou CNPJ!",
                    minlength: "o CPF/CNPJ está incompleto!",
                    number: "Coloque apenas números!"
                },
                formEndInstitute: {
                    required: "Por favor, insira o endereço da instituição!",
                    minlength: "O endereço tem que ser maior!"
                },
                formEstadoInstitute: {
                    required: "Por favor, insira o estado!",
                },
                dataInatInstituicao: {
                    required: "Por favor, insira uma data!",
                    min:"Insira uma data a partir de hoje!"
                },
                topicoss: {
                    required: "Selecione pelo menos um tópico!",
                },
            },
        })) {
            $('#botaoInstituicao').click(function() {
                if( $('#FormInstitute').valid()) {
                    var clickBtnValue = 'adicionarInstituicao';
                    var ajaxurl = '../src/php/Ajax.php';
                    if($('#FormInstitute #ativo_ate:checked').val() == undefined) {
                        valor = "0";
                    } else {
                        valor = $('#FormInstitute #ativo_ate:checked').val()
                    }
                    var data = {
                    'action': clickBtnValue,
                    'formNomeInstitute': $('#FormInstitute #formNomeInstitute').val(),
                    'formRespInstitute': $('#FormInstitute #formRespInstitute').val(),
                    'formCNPJCPFInstituter': $('#FormInstitute #formCNPJCPFInstitute').val(),
                    'formEndInstitute': $('#FormInstitute #formEndInstitute').val(),
                    'tipoinstituicao': $('#FormInstitute .type-item-box:selected').val(),
                    'cidadeInstitute': $('#FormInstitute .cidades').val(),
                    'estadoInstitute': $('#FormInstitute .estados').val(),
                    'ativo_ate': valor,
                    'dataInatInstituicao': $('#FormInstitute #date').val(),
                    'topicos': $('#FormInstitute #topicos').val(),
                    }
            
                    $.post(ajaxurl, data, function(response) {
                        location.reload();
                    });
                }
            });
        };
    };