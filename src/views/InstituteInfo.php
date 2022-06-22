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
    <link href="../css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>

<body>
    <div id="navbar-superior" style="padding-bottom: 0">
        <div id="nav-intermediaria">
            <a href="#" class="nav_link" style="display: flex; align-items: center; margin-right: 5px;" onclick="logoutUser()"> <i class='bx bx-menu nav_icon'></i></a>
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                <div class="logo-h1">
                    <div class="carousel-item active">
                        <img src="../assets/logo.png" class="d-block" style="width: 150px; height: 150px; object-fit: contain; margin-left: 20%;" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="../assets/logo_full_white.png" class="d-block" style="width: 150px" alt="...">
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
            </div>
            <div class="col">
                <p id="nav-paragraph">Sua ong/instituto gostaria de aparecer aqui?</p>
                <button class="d-flex justify-content-center" id="button-form" style="margin:auto; margin-right: 0"><a href="./src/views/register_institute.php">Enviar formulário</a></button>
            </div>
        </div>
    </div>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

    use App\Auth;
    use App\Funcoes;
    use App\Connect;

    if (Auth::verificaSessionLogin() == false) {
        Funcoes::retornaTela('.');
    }

    $db = new Connect();
    $dbcon = $db->ConnectDB();
    $sth = $dbcon->prepare("SELECT * FROM tb_instituicoes where id_instituicao = '{$_GET['id_instituicao']}'");
    $sth->execute();
    $dadosInstituicao = $sth->fetch();
    $sth = $dbcon->prepare("SELECT * FROM tb_voluntarios where email_voluntario = '{$_COOKIE['login']}'");
    $sth->execute();
    $usuario = $sth->fetch();

    $destino = str_replace(" ", "", $dadosInstituicao['endereco_instituicao']);
    $destino .= str_replace(" ", "", $dadosInstituicao['cidade_instituicao']);
    $destino .= str_replace(" ", "", $dadosInstituicao['estado_instituicao']);
    $origem = str_replace(" ", "", $usuario['endereco_voluntario']);
    $origem .= str_replace(" ", "", $usuario['cidade_voluntario']);
    $origem .= str_replace(" ", "", $usuario['estado_voluntario']);
    $url_loc = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $origem . "&destinations=" . $destino . "&language=pt-br&key=AIzaSyB09nLPB6Bd8nCeOFcCdpXuzQp4hWplOTk";
    $loc = json_decode(file_get_contents($url_loc), true);

    ?>
    <div id="main-content" style="color: black;">
        <div class="container-index">
            <a class="navbar-brand d-flex" href="../../indexVolunteer.php">
                <img src="../assets/back-arrow-black.svg" width="30" height="30" class="d-inline-block align-top" style="margin-right: 5px;" alt="">
                <span style="color: black;">Voltar</span>
            </a>
            <div class="institute-info">
                <p>Você está se candidatando para a instituição:</p>
                <input type="hidden" id="dadosUsuario" name="dadosUsuario" value='<?=serialize($usuario)?>'>
                <input type="hidden" id="dadosInstituicao" name="dadosInstituicao" value='<?=serialize($dadosInstituicao)?>'>
                <h7 class="title"><?= Funcoes::retornaTipoInstituicao($dadosInstituicao['tipo_instituicao']) ?></h7>
                <h1 class="title"><?= $dadosInstituicao['nome_instituicao'] ?></h1>
                <img class="item-content-image-info" style="width: 225px; margin-bottom: 10px;" src=<?= (file_exists("../assets/img/instituicao_{$dadosInstituicao['id_instituicao']}/logo_instituicao_{$dadosInstituicao['id_instituicao']}.png") ? "../assets/img/instituicao_{$dadosInstituicao['id_instituicao']}/logo_instituicao_{$dadosInstituicao['id_instituicao']}.png" : "../assets/img/sem-foto.png") ?> alt="">
                <p>Você pode ajudar com:</p>
                <?php $itens = json_decode($dadosInstituicao['topicos_instituicao']);
                switch (count($itens)) {
                    case 1:
                        $tamanho = '1fr;';
                        $estilo = '';
                        break;
                    case 2:
                        $tamanho = '1fr 1fr;';
                        $estilo = '';
                        break;
                    default:
                        $tamanho = '1fr 1fr 1fr;';
                        $estilo = 'd-flex align-left';
                        break;
                }
                ?>
                <div class="item-box-choices-volunteer" style="display: grid; grid-template-columns: <?= $tamanho ?>; margin: auto;">
                    <?php
                    foreach ($itens as $item) { ?>
                        <?php $count++; ?>
                        <span class="item-box-choice-unique <?= $estilo ?>" style="margin: 0 20px 5px 20px;">
                            <img src="../assets/check-item.svg" style="height: 32px; margin-right: 10px;" alt="">
                            <span style="font-weight: 600;"><?= Funcoes::retornaTopicoInstituicao($item) ?></span>
                        </span>
                    <?php } ?>
                </div>
                <hr>
                <h6 class="title">Informações sobre a instituição <?= $dadosInstituicao['nome_instituicao'] ?>:</h6>
                <div class="institute-about" style="margin: 0 20%;">
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div><i class='bx bxs-right-arrow'></i><span class="title-about"> Endereço da instituição: </span></div>
                        <span> <?= $dadosInstituicao['endereco_instituicao'] ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div><i class='bx bxs-right-arrow'></i><span class="title-about"> Cidade da instituição: </span></div>
                        <span> <?= $dadosInstituicao['cidade_instituicao'] ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div><i class='bx bxs-right-arrow'></i><span class="title-about"> Estado da instituição: </span></div>
                        <span> <?= $dadosInstituicao['estado_instituicao'] ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div><i class='bx bxs-right-arrow'></i><span class="title-about"> Distância da instituição de seu endereço: </span></div>
                        <span> <?php echo $loc['rows']['0']['elements']['0']['distance']['text'] ?></span>
                    </div>
                    <?php if (strlen($dadosInstituicao['cpf_cnpj_instituicao'] > 14)) { ?>
                        <div class="d-flex justify-content-between">
                            <div><i class='bx bxs-right-arrow'></i><span class="title-about"> CNPJ da instituição: </span></div>
                            <span> <?= $dadosInstituicao['cpf_cnpj_instituicao'] ?></span>
                        </div>
                    <?php } else { ?>
                        <div class="d-flex justify-content-between">
                            <div><i class='bx bxs-right-arrow'></i><span class="title-about"> CPF do responsável pela instituição: </span></div>
                            <span> <?= $dadosInstituicao['cpf_cnpj_instituicao'] ?></span>
                        </div>
                    <?php } ?>
                    <hr>
                    <div style="margin-bottom: 5px;"><span class="title-about"> Descrição sobre a instituição: </span></div>
                    <div style="border: 1px solid rgba(0,0,0,0.20); border-radius: 5px; max-width: 500px;">
                        <p style="padding: 5px; margin: 0; text-align: left;"> <?= $dadosInstituicao['descricao_instituicao'] ?></p>
                    </div>
                </div>
                <hr>
                <h4 class="title">Gostou da instituição e gostaria de apoia-lá?</h4>
                <button class="candidate-button" id="candidate-button">Candidatar-se</button>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="../scripts/script.js"></script>
    <script src="../scripts/jquery.mask.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script>
        function logoutUser() {
            document.cookie = 'PHPSESSID' + '="";-1; path=/';
            document.cookie = 'login' + '="";-1; path=/';
            window.location.replace('./index.php')
        }
        $(document).ready(function() {
            $('#candidate-button').click(function() {
            $("#candidate-button").prop("disabled", true);
            $("#candidate-button").text("Enviando...");
            var clickBtnValue = 'enviarCandidatoInstituicao';
            var ajaxurl = '../php/Ajax.php';
            var data = {
                'action': clickBtnValue,
                'dadosVolunteer': $('#dadosUsuario').val(),
                'dadosInstitute': $('#dadosInstituicao').val()
                    };

                $.post(ajaxurl, data, function(response) {
                    window.location.replace('./success-volunteer-candidate.php');
                    $("#candidate-button").prop("disabled", false);
                });
            });
        });
    </script>
</body>

</html>