<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAUA - Registro de Instituição</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/style.css">

</head>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Connect;
use App\Funcoes;

$db = new Connect();
$dbcon = $db->ConnectDB();
$sth = $dbcon->prepare("SELECT * FROM tb_tipoinstituicao");
$sth->execute();
$tipos = $sth->fetchAll();
$sth = $dbcon->prepare("SELECT * FROM tb_topicosinstituicao");
$sth->execute();
$topicos = $sth->fetchAll();

?>

<body>
    <div id="navbar-superior" style="padding: 0">
        <div id="nav-intermediaria">
            <nav class="navbar navbar-light">
                <a class="navbar-brand" href="../../index.php">
                    <img src="../assets/back-arrow-7316.svg" width="30" height="30" class="d-inline-block align-top" alt="">
                    <span style="color: #FFF">Voltar</span>
                </a>
            </nav>
        </div>
    </div>
    <div id="main-content" style="color: black; background: #eeeeee; width: 30%; margin: auto; padding: 10px; border-radius: 20px; -webkit-box-shadow: 4px 5px 5px -4px rgba(0,0,0,0.51); box-shadow: 4px 5px 5px -4px rgba(0,0,0,0.51);">
        <img src="../assets/logo.png" alt="" style="width: 150px; margin-bottom: 10px;">
        <h3 class="title">Preencha com os dados:</h3>
        <form action="" id="FormInstitute" method="post" novalidate>
            <input type="hidden" name=formRespInstitute" id="formRespInstitute" value="<?= $_GET['NameResp'] ?>">
            <input type="hidden" name=formEmailInstitute" id="formEmailInstitute" value="<?= $_GET['EmailResp'] ?>">
            <div class="mb-3">
                <input type="text" class="form-control" id="formNomeInstitute" name="formNomeInstitute" placeholder="Nome da Instituição/Causa">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" id="formRespInstituteDisabled" name="formRespInstituteDisabled" placeholder="Responsável" value="<?= $_GET['NameResp'] ?>" disabled>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" id="formEmailInstituteDisabled"" name=" formEmailInstituteDisabled" placeholder="Email do Responsável" value="<?= $_GET['EmailResp'] ?>" disabled>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control cpfOuCnpj" id="formCNPJCPFInstitute" name="formCNPJCPFInstituter" placeholder="CNPJ/CPF">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" id="formEndInstitute" name="formEndInstitute" placeholder="Endereço da Instituição">
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col">
                        <select class="form-select estados" aria-label="Estado Form" name="formEstadoInstitute" id="estados">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-select cidades" aria-label="Cidade" name="formCidadeInstitute" id="cidades">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="container g-0">
                        <div class="row">
                            <div class="col">
                                Tipo de Instituição
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <select class="form-select" aria-label="Tipo Instituicao" name="tipoinstituicao">
                                    <?php foreach ($tipos as $tipo) { ?>
                                        <option class="type-item-box" value="<?= $tipo[0] ?>"><?= Funcoes::retornaTipoInstituicao($tipo[0]) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col" style="padding-left: 0">
                    <div class="container g-0">
                        <div class="col-sm">
                            Ativo até <span><input class="form-check-input" type="checkbox" value="1" id="ativo_ate" name="ativo_ate" onchange="verificaInformacoesNovo()"></span>
                        </div>
                        <div class="col-sm">
                            <input id="date" class="form-control" type="text" min="<?= date("Y-m-d") ?>" name="dataInatInstituicao" onfocus="(this.type='date')" placeholder="__/__/____" />
                        </div>
                    </div>
                </div>
            </div>
            <label class="col-form-label">Tópicos da instituição <i style="opacity: 0.5">(Arraste para ordenar)</i></label>
            <div class="sortable">
                <?php
                foreach ($topicos as $topico) {
                    $todos[$topico[0]] = $topico[0];
                }
                foreach ($todos as $i) { ?>
                    <div class="d-flex justify-content-between topicsList">
                        <div><?= Funcoes::retornaTopicoInstituicao($i) ?></div>
                        <div>
                            <div style="display: inline-block;">
                                <input class="form-check-input" type="checkbox" value="<?= $i ?>" data-value="<?= $i ?>" id="flexCheckDefault" name="topicoss">
                            </div>
                            <div style="display: inline-block;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grip-vertical" viewBox="0 0 16 16">
                                    <path d="M7 2a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM7 5a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM7 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-3 3a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-3 3a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div>
                <button class="candidate-button" style="margin-top: 20px;" id="botaoInstituicao" onclick="defineOrdemTopicosNovo()">Enviar formulário</button>
            </div>
        </form>
    </div>

    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

    use App\Mailer;

    if ($_REQUEST) {
        try {
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="../scripts/script.js"></script>
    <script src="../scripts/jquery.wiggle.min.js"></script>
    <script src="../scripts/jquery.mask.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script>
        // Máscara para CPF, Telefone e RG.
        var options = {
            onKeyPress: function(cpf, ev, el, op) {
                var masks = ['000.000.000-000', '00.000.000/0000-00'];
                $('.form-control.cpfOuCnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
            }
        }
        $('.form-control.cpfOuCnpj').length > 11 ? $('.form-control.cpfOuCnpj').mask('00.000.000/0000-00', options) : $('.form-control.cpfOuCnpj').mask('000.000.000-00#', options);

        $(document).ready(function() {
            validarFormInstituicaoNovo();
            $.getJSON('../scripts/estados_cidades.json', function(data) {
                var items = [];
                var options = '<option value="">Escolha um Estado</option>';
                $.each(data, function(key, val) {
                    options += '<option value="' + val.nome + '">' + val.nome + '</option>';
                });
                $("#estados").html(options);

                $("#estados").change(function() {
                    var options_cidades = '';
                    var str = "";
                    $("#estados option:selected").each(function() {
                        str += $(this).text();
                    });
                    $.each(data, function(key, val) {
                        if (val.nome == str) {
                            $.each(val.cidades, function(key_city, val_city) {
                                options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
                            });
                        }
                    });
                    $("#cidades").html(options_cidades);
                }).change();
            });
        });
    </script>
    <script>
        $(".sortable").disableSelection();
        $(function() {
            $(".sortable").sortable({
                placeholder: "ui-state-highlight",
                opacity: 0.8,
                axis: 'y',
                helper: "clone",
                cursor: 'grabbing',
                forceHelperSize: true,
                tolerance: "pointer",
                start: function(event, ui) {
                    $(ui.item).addClass("highlight");
                },
                stop: function(event, ui) {
                    $(ui.item).removeClass("highlight");
                    $(ui.item).wiggle({
                        speed: 200,
                        wiggles: 1,
                        travel: 2
                    })
                }
            });
        });

        function defineOrdemTopicosNovo() {
            $('.editar').off("click");
            var arr = [];
            $('#FormInstitute input:checked').map(function(index) {
                arr[index] = this.getAttribute('data-value');
            }).get();
            const results = [];
            arr.forEach(element => {
                if (element !== null) {
                    results.push(element);
                }
            });
            $('#topicos').val(results);
            return results;
        };

        function verificaInformacoesNovo() {
            if ($('#ativo_ate').prop("checked")) {
                $('#date').prop('type', "date")
                $('#date').prop('disabled', false);
            } else {
                $('#date').prop('disabled', true);
                $('#date').prop('type', "text")
                $('#date').val('');
                $('#date').prop('placeholder', "__/__/____")
            }
        }
    </script>
</body>

</html>