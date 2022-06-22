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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>

<body>
    <div id="navbar-superior" style="padding-bottom: 0">
        <div id="nav-intermediaria">
            <!-- <div id="logo-h1"><img src="./assets/logo.png" alt="FAUA"></div> -->
            <a href="#" class="nav_link" style="display: flex; align-items: center; margin-right: 5px;" onclick="logoutUser()"> <i class='bx bx-menu nav_icon'></i></a>
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                <div class="logo-h1">
                    <div class="carousel-item active">
                        <img src="./src/assets/logo.png" class="d-block" style="width: 150px; height: 150px; object-fit: contain; margin-left: 20%;" alt="...">
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
            </div>
            <div class="col">
                <p id="nav-paragraph">Sua ong/instituto gostaria de aparecer aqui?</p>
                <button class="d-flex justify-content-center" id="button-form" style="margin:auto; margin-right: 0"><a href="./src/views/register_institute.php">Enviar formulário</a></button>
            </div>
        </div>
    </div>
    <div id="main-content" style="color: black;">
        <div class="container-index">
            <div class="d-flex justify-content-between header-index">
                <?php
                require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

                use App\Connect;
                use App\Funcoes;

                $db = new Connect();
                $dbcon = $db->ConnectDB();
                $sth = $dbcon->prepare("SELECT * FROM pessoa where email = '{$_COOKIE['login']}'");
                $sth->execute();
                $usuario = $sth->fetch();
                $sth = $dbcon->prepare("SELECT * FROM tb_instituicoes where ativo_instituicao = '1'");
                $sth->execute();
                $result = $sth->fetchAll(); ?>
                <h3 class="title" style="color: #505050; font-weight: 600;">Qual boa ação vai fazer hoje, <?php echo $usuario['nome'] ?>?</h3>
                <a href="#" class="nav_link" style="font-size: 2rem; color:black;"> <i class='bx bx-filter'></i></a>
            </div>
            <div style="border: 1px solid rgba(0, 0, 0, 0.3); width: 50%; margin-left: 20px;"></div>
            <div class="content-index">
                <?php foreach ($result as $dado) { ?>
                    <a href="./src/views/InstituteInfo.php?id_instituicao=<?= $dado['id_instituicao']; ?>" style="color: black;">
                        <div class="d-flex justify-content-between item-content-index">
                            <img class="item-content-image" style="width: 225px;" src=<?php echo "./src/assets/img/instituicao_{$dado['id_instituicao']}/logo_instituicao_{$dado['id_instituicao']}.png" ?> alt="">
                            <div class="d-box item-box-index p-2" style="width: 900px; text-align:left;">
                                <p class="type-item-box"><?= Funcoes::retornaTipoInstituicao($dado['tipo_instituicao']) ?></p>
                                <div class="d-flex">
                                    <h3 class="item-box-title" style="margin-right: 10px;"><?= $dado['nome_instituicao']; ?></h3>
                                    <img src="./src/assets/location.svg" style="height: 24px;" alt="">
                                    <?php
                                    // $destino = str_replace(" ","",$dado['endereco_instituicao']);
                                    // $origem = str_replace(" ","",$usuario['endereco']);
                                    // $url_loc = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$origem."&destinations=".$destino."&language=pt-br&key=AIzaSyB09nLPB6Bd8nCeOFcCdpXuzQp4hWplOTk";
                                    // $loc = json_decode(file_get_contents($url_loc), true); 
                                    ?>
                                    <span class="item-box-title"><?php echo $loc['rows']['0']['elements']['0']['distance']['text'] ?></span>
                                </div>
                                <p>Você pode ajudar com:</p>
                                <div class="item-box-choices-volunteer">
                                    <div class="item-box-choice-unique">
                                        <?php
                                        $itens = json_decode($dado['topicos_instituicao']);
                                        foreach (array_slice($itens, 0, 3) as $item) { ?>
                                            <img src="./src/assets/check-item.svg" style="height: 32px;" alt="">
                                            <span><?= Funcoes::retornaTopicoInstituicao($item) ?></span>
                                        <?php } ?>
                                        <?php if (count($itens) > 3) { ?>
                                            <span><i>e mais...</i></span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div style="display:flex; align-items: center;">
                                <i style="font-size: 3rem;" class='bx bx-chevron-right'></i>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

    use App\Auth;

    if (Auth::verificaSessionLogin() == false) {
        Funcoes::retornaTela('.');
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
        function logoutUser() {
            document.cookie = 'PHPSESSID' + '="";-1; path=/';
            document.cookie = 'login' + '="";-1; path=/';
            window.location.replace('./index.php')
        }
    </script>
</body>

</html>