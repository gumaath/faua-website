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
    <link href="./src/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./src/styles/style.css">
</head>

<body>
    <div id="navbar-superior" style="padding-bottom: 0">
        <div id="nav-intermediaria">
            <!-- <div id="logo-h1"><img src="./assets/logo.png" alt="FAUA"></div> -->
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                <a href="#">
                    <div class="logo-h1">
                        <div class="carousel-item active">
                            <img src="./src/assets/logo.png" class="d-block" style="width: 200px; height: 150px; object-fit: none;" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="./src/assets/logo_full_white.png" class="d-block" style="width: 150px" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </a>
                </div>

            <div class="col">
                <p id="nav-paragraph">Sua ong/instituto gostaria de aparecer aqui?</p>
                <button class="d-flex justify-content-center" id="button-form" style="margin:auto; margin-right: 0"><a href="./src/views/register_institute.php">Enviar formulário</a></button>
            </div>
        </div>
    </div>
    <div id="main-content">
        <p>DENTRO DO NEGOCIO</p>
    </div>

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
    use App\Auth;
    if (Auth::verificaSessionLogin() == false) {
        header('Location:/index.php');
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="./src/scripts/script.js"></script>
    <script src="./src/scripts/jquery.mask.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script>
        // Máscara para CPF, Telefone e RG.
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

        // Chamada para as Cidades de acordo com o Estado

        $(document).ready(function() {
            $.getJSON('./src/scripts/estados_cidades.json', function(data) {
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

        // Validação do campo de "Escolha seu estado" para o CSS ficar bonito.

        function cssEstado() {
            if (($('#estados.form-select').val().length) == 0) {
                $('#estados.form-select').attr('style', 'color: #C4C4C4 !important');
            } else {
                $('#estados.form-select').attr('style', 'color: #5e5e5e !important');
            }
        };
        $('#estados.form-select').focusin(function() {
            $('#estados.form-select').attr('style', 'color: #5e5e5e !important');
        });
        $('#estados.form-select').focusout(function() {
            if (($('#estados.form-select').val().length) == 0) {
                $('#estados.form-select').attr('style', 'color: #C4C4C4 !important');
            }
        });
    </script>
</body>

</html>