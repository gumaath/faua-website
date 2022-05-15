<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAUA - Você mudando o mundo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="./css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
    <div id="navbar-superior">
        <p id="nav-paragraph">Sua ong/instituto gostaria de aparecer aqui?</p>
        <div id="nav-intermediaria">
            <div id="logo-h1"><img src="./assets/logo.png" alt="FAUA"></div>
            <button id="button-form"><a href="./views/register_institute.php">Enviar formulário</a></button>
        </div>
    </div>
    <div id="main-content">
        <div id="slogan-main-content">
            <p>Surgimos como uma solução para quem quer ajudar alguma causa porém não sabe onde procurar.</p>
            <p>⠀</p>
            <p>Aqui na <span id="faua-text">FAUA</span>, você tem tudo o que precisa para <span id="underline-text">mudar o mundo!</span> :)</p>
        </div>
        <div class="line">⠀</div>
        <div id="button-subscribe-main">
            <button data-bs-toggle="modal" data-bs-target="#FormModal">Crie seu cadastro agora!</button>
        </div>
        <div class="line">⠀</div>
        <div id="log-in-buttons">
            <div id="button-login-vol">
                <button>Acessar como voluntário/a</button>
            </div>
            <div id="button-login-inst">
                <button>Acessar como organização/administrador</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="FormModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cadastrar-se</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="FormVolunteer" method="post" novalidate>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="formNomeVolunteer" name="formNomeVolunteer" placeholder="Nome">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="formSobrenomeVolunteer" name="formSobrenomeVolunteer" placeholder="Sobrenome">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="formCPFVolunteer" name="formCPFVolunteer" placeholder="CPF">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="formRGVolunteer" name="formRGVolunteer" placeholder="RG">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="formTelVolunteer" name="formTelVolunteer" placeholder="Telefone">
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <select class="form-select" aria-label="Estado Form" name="estado-voluntario" id="estados">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-select" aria-label="Cidade" name="cidade-voluntario" id="cidades">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="container g-0">
                                    <div class="row">
                                        <div class="col">
                                            Tipo Sanguineo
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-auto">
                                            <select class="form-select" aria-label="Letra sangue" name="letra-sangue">
                                                <option selected value="A">A</option>
                                                <option value="O">O</option>
                                                <option value="B">B</option>
                                                <option value="AB">AB</option>
                                            </select>
                                        </div>
                                        <div class="col-auto" style="padding: 0;">
                                            <select class="form-select" aria-label="Tipo Sangue" name="tipo-sangue">
                                                <option selected value="-">Negativo</option>
                                                <option value="+">Positivo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col" style="padding-left: 0">
                                <div class="container g-0">
                                    <div class="col-sm">
                                        Data de Nascimento
                                    </div>
                                    <div class="col-sm">
                                        <input id="startDate" class="form-control" type="date" name="BirthDateVolunteer" max="<?= date("Y-m-d") ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-sm-11" style="border-bottom: 1px solid #C4C4C4">
                                <label for="staticEmail" class="col-form-label">Você já doou sangue?</label>
                            </div>
                            <div class="col-auto">
                                <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="doador_sangue">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-sm-11" style="border-bottom: 1px solid #C4C4C4">
                                <label for="staticEmail" class="col-form-label">Você tem experiência em cuidar de idosos?</label>
                            </div>
                            <div class="col-auto">
                                <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="exp_idosos">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-sm-11" style="border-bottom: 1px solid #C4C4C4">
                                <label for="staticEmail" class="col-form-label">Você tem experiência em cuidar de crianças?</label>
                            </div>
                            <div class="col-auto">
                                <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="exp_criancas">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-sm-11" style="border-bottom: 1px solid #C4C4C4">
                                <label for="staticEmail" class="col-form-label">Você tem experiência em cuidar de animais?</label>
                            </div>
                            <div class="col-auto">
                                <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="exp_animais">
                            </div>
                        </div>
                </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" id="botao" name="botao" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    </div>
    <?php
include("connect.php");
if ($_REQUEST) {
    try {
        if(!isset($_POST['exp_idosos'])) {
            $_POST['exp_idosos'] = "0"; 
        }
        if(!isset($_POST['exp_criancas'])) {
            $_POST['exp_criancas'] = "0"; 
        }
        if(!isset($_POST['exp_animais'])) {
            $_POST['exp_animais'] = "0"; 
        }
        if(!isset($_POST['doador_sangue'])) {
            $_POST['doador_sangue'] = "0"; 
        }
        $stmt = $con->prepare("INSERT INTO pessoa(nome, email) VALUES('{$_POST['formNomeVolunteer']}', '{$_POST['formSobrenomeVolunteer']}')");
        $stmt->execute();
        echo <<<SCRIPT
        <script>window.location.replace('./views/success-volunteer-submit.php')</script>
SCRIPT;         
    } catch (Exception $e) {
        throw new Exception($e);
    }
}
?>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="./scripts/script.js"></script>
    <script src="./scripts/jquery.mask.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#formCPFVolunteer').mask('000.000.000-00', {
                reverse: true
            });
            $('#formRGVolunteer').mask('00.000.000.000-0', {
                reverse: true
            });
            $('#formTelVolunteer').mask('(00) 00000-0000', {
                reverse: false
            });
        });
        $(document).ready(function() {
            $.getJSON('./scripts/estados_cidades.json', function(data) {
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
</body>

</html>