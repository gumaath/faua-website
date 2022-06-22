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
                <p id="nav-paragraph">⠀</p>
                <button class="d-flex justify-content-center" id="button-form" style="margin:auto; margin-right: 0; width: 170px;"><a href="./src/views/register_institute.php">Acessar Log</a></button>
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
                use App\Credentials;

                $googleKey = Credentials::googleKey;

                $db = new Connect();
                $dbcon = $db->ConnectDB();
                $sth = $dbcon->prepare("SELECT * FROM pessoa where email = '{$_COOKIE['login']}'");
                $sth->execute();
                $usuario = $sth->fetch();
                $sth = $dbcon->prepare("SELECT * FROM tb_instituicoes");
                $sth->execute();
                $result = $sth->fetchAll();
                $sth = $dbcon->prepare("SELECT * FROM tb_tipoinstituicao");
                $sth->execute();
                $tipos = $sth->fetchAll();
                $sth = $dbcon->prepare("SELECT * FROM tb_topicosinstituicao ORDER BY nome_topico");
                $sth->execute();
                $topicos = $sth->fetchAll();

                ?>
                <h3 class="title" style="color: #505050; font-weight: 600;">PAINEL ADMINISTRADOR - ID ADMIN: <?php echo $usuario['idpessoa'] . ' - ' . $usuario['nome'] ?></h3>
                <a href="#" class="nav_link" style="font-size: 2rem; color:black;"><button class="d-flex justify-content-center" id="button-form" style="margin:auto; margin-right: 0" button data-bs-toggle="modal" data-bs-target="#FormModalInstitute" onclick="verificaInformacoesNovo(); validarFormInstituicaoNovo();">Adicionar nova instituição</button></a>
            </div>
            <div style="border: 1px solid rgba(0, 0, 0, 0.3); width: 50%; margin-left: 20px;"></div>
            <div class="content-index">
                <?php foreach ($result as $dado) { ?>
                    <div class="d-flex justify-content-between item-content-index" style="max-height: 250px;">
                        <button data-bs-toggle="modal" data-bs-target="#FormModalPhoto_<?= $dado['id_instituicao'] ?>" style="background: none; border: none; margin: 0; padding:0; font-weight: 600"><img class="item-content-image" style="width: 225px;" src=<?= (file_exists("./src/assets/img/instituicao_{$dado['id_instituicao']}/logo_instituicao_{$dado['id_instituicao']}.png") ? "./src/assets/img/instituicao_{$dado['id_instituicao']}/logo_instituicao_{$dado['id_instituicao']}.png" : "./src/assets/img/sem-foto.png") ?> alt=""></button>
                        <div class="d-box item-box-index p-2" style="width: 900px; text-align:left;">
                            <p class="type-item-box"><?= Funcoes::retornaTipoInstituicao($dado['tipo_instituicao']) ?> </p>
                            <div class="d-flex">
                                <h3 class="item-box-title" style="margin-right: 10px;"><?= $dado['nome_instituicao']; ?></h3>
                                <img src="./src/assets/location.svg" style="height: 24px;" alt="">
                                <?php
                                $destino = str_replace(" ","",$dado['endereco_instituicao']);
                                $destino .= str_replace(" ","",$dado['cidade_instituicao']);
                                $destino .= str_replace(" ","",$dado['estado_instituicao']);
                                $origem = str_replace(" ","",$usuario['endereco_usuario']);
                                $origem .= str_replace(" ","",$usuario['cidade_usuario']);
                                $origem .= str_replace(" ","",$usuario['estado_usuario']);
                                $url_loc = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$origem."&destinations=".$destino."&language=pt-br&key=$googleKey";
                                $loc = json_decode(file_get_contents($url_loc), true); 
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
                            <div class="item-contant-status" style="margin-top: 10px">
                                <?php if ($dado['ativo_instituicao']) { ?>
                                    <button type="submit" class="statusInstit" data-institute="<?= $dado['id_instituicao'] ?>" name="botao_<?= $dado['id_instituicao'] ?>" data-value="1" value="trocarStatus" class="button" style="background: none; border: none; margin: 0; padding:0; font-weight: 600">
                                        <img src="./src/assets/check-item.svg" style="height: 32px;" alt="">
                                        <span>Ativo</span>
                                    </button>
                                <?php } else { ?>
                                    <button type="submit" class="statusInstit" data-institute="<?= $dado['id_instituicao'] ?>" name="botao_<?= $dado['id_instituicao'] ?>" data-value="0" value="trocarStatus" class="button" style="background: none; border: none; margin: 0; padding:0; font-weight: 600">
                                        <img src="./src/assets/inactive-item.svg" style="height: 32px;" alt="">
                                        <span>Desativado</span>
                                    </button>
                                <?php } ?>
                            </div>
                        </div>

                        <div style="display:grid; align-items: center;" class="grid-content">
                            <button style="grid-area: excluir; background: none; border: none; margin: 0; padding:0; font-weight: 600" class="excluir" data-institute="<?= $dado['id_instituicao'] ?>">EXCLUIR</button>
                            <button style="margin-bottom: 60px; grid-area: editar; border: none; background: none; font-weight: 600" onclick="defineOrdemTopicos(<?= $dado['id_instituicao'] ?>); cidadesEstados(<?= $dado['id_instituicao'] ?>); verificaInformacoes(<?= $dado['id_instituicao'] ?>); validarFormInstituicao(<?= $dado['id_instituicao'] ?>);" class="editar" data-institute="<?= $dado['id_instituicao'] ?>" data-bs-toggle="modal" data-bs-target="#FormModalEdit_<?= $dado['id_instituicao'] ?>">EDITAR</button>
                            <i style="font-size: 3rem; grid-area: flecha; margin-bottom: 60px" class='bx bx-chevron-right'></i>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Modal Adicionar Nova Instituição -->
    <div class="modal fade FormModal" id="FormModalInstitute" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar Nova Instituição</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="FormInstitute" method="post" novalidate>
                        <input type="hidden" name="topicos" id="topicos" value="">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="formNomeInstitute" name="formNomeInstitute" placeholder="Nome da Instituição/Causa">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="formRespInstitute" name="formRespInstitute" placeholder="Responsável">
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
                                    <select class="form-select estados" aria-label="Estado Form" name="formEstadoInstitute" id="estados" onchange="cssEstado(<?= $dado['id_instituicao'] ?>);">
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
                </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="$('#FormModalInstitute')[0].reset();">Fechar</button>
                    <button type="submit" class="btn btn-primary botaoInstituicao" id="botaoInstituicao" onclick="defineOrdemTopicosNovo()" name="botao" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    </div>

    <!-------------------------------------------------------->

    <!-- Modal Edit -->
    <?php foreach ($result as $dado) { ?>
        <div class="modal fade FormModal" id="FormModalEdit_<?= $dado['id_instituicao'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="FormInstituteEdit_<?= $dado['id_instituicao'] ?>" onsubmit="defineOrdemTopicos(<?= $dado['id_instituicao'] ?>)" method="post" novalidate>
                            <input type="hidden" name="idInstituicao" value="<?= $dado['id_instituicao'] ?>">
                            <input type="hidden" name="topicos" id="topicos_<?= $dado['id_instituicao'] ?>" value="">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="formNomeInstitute" name="formNomeInstitute" placeholder="Nome da Instituição/Causa" value="<?= $dado['nome_instituicao'] ?>">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="formRespInstitute" name="formRespInstitute" placeholder="Responsável" value="<?= $dado['resp_instituicao'] ?>">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control cpfOuCnpj" id="formCNPJCPFInstitute" name="formCNPJCPFInstituter" placeholder="CNPJ/CPF" value="<?= $dado['cpf_cnpj_instituicao'] ?>">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="formEndInstitute" name="formEndInstitute" placeholder="Endereço da Instituição" value="<?= $dado['endereco_instituicao'] ?>">
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <input type="hidden" id="estadoatual_<?= $dado['id_instituicao'] ?>" name="estado_atual" value="<?= $dado['estado_instituicao'] ?>">
                                        <input type="hidden" id="cidadeatual_<?= $dado['id_instituicao'] ?>" name="cidade_atual" value="<?= $dado['cidade_instituicao'] ?>">
                                        <select class="form-select estados_<?= $dado['id_instituicao'] ?>" aria-label="Estado Form" name="formEstadoInstitute" id="estados" onchange="cssEstado(<?= $dado['id_instituicao'] ?>);">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select class="form-select cidades_<?= $dado['id_instituicao'] ?>" aria-label="Cidade" name="formCidadeInstitute" id="cidades">
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
                                                        <option class="type-item-box" <?= ($dado['tipo_instituicao'] == $tipo[0] ? "selected" : "") ?> value="<?= $tipo[0] ?>"><?= Funcoes::retornaTipoInstituicao($tipo[0]) ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col" style="padding-left: 0">
                                    <div class="container g-0">
                                        <div class="col-sm">
                                            Ativo até <span><input class="form-check-input" type="checkbox" value="1" id="ativo_ate_<?= $dado['id_instituicao'] ?>" name="ativo_ate" onchange="verificaInformacoes(<?= $dado['id_instituicao'] ?>);" <?= ((int)$dado['ativo'] ? 'checked' : '') ?>></span>
                                        </div>
                                        <div class="col-sm">
                                            <input id="date_<?= $dado['id_instituicao'] ?>" class="form-control" type="text" min="<?= date("Y-m-d") ?>" name="dataInatInstituicao" onfocus="(this.type='date')" placeholder="__/__/____" value="<?= $dado['ativo_ate'] ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label class="col-form-label">Tópicos da instituição <i style="opacity: 0.5">(Arraste para ordenar)</i></label>
                            <div class="sortable">
                                <?php

                                $itens = json_decode($dado['topicos_instituicao']);
                                $lista = [];
                                foreach ($itens as $item) {
                                    $lista[$item] = $item;
                                }
                                foreach ($topicos as $topico) {
                                    $todos[$topico[0]] = $topico[0];
                                }
                                $outrositens = array_diff($todos, $lista);
                                $ordem = array_merge($lista, $outrositens);
                                $ordem = array_map('strval', $ordem);

                                foreach ($ordem as $i) { ?>
                                    <div class="d-flex justify-content-between topicsList">
                                        <div><?= Funcoes::retornaTopicoInstituicao($i) ?></div>
                                        <div>
                                            <div style="display: inline-block;">
                                                <input class="form-check-input" type="checkbox" value="<?= $i ?>" data-value="<?= $i ?>" id="flexCheckDefault" name="topicoss" <?= $lista[$i] ? "checked" : "" ?>>
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
                    </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="$('#FormInstituteEdit_<?= $dado['id_instituicao'] ?>')[0].reset();">Fechar</button>
                        <button type="submit" class="btn btn-primary botaoInstituicao" id="botaoInstituicao_<?= $dado['id_instituicao'] ?>" name="botao" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Modal Foto -->
    <?php foreach ($result as $dado) { ?>
        <div class="modal fade FormModal" id="FormModalPhoto_<?= $dado['id_instituicao'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Selecionar imagem</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="FormInstitutePhoto_<?= $dado['id_instituicao'] ?>" method="post" novalidate>
                            <input type="file" name="file" id="file" accept="image/*">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="$('#FormInstituteEdit_<?= $dado['id_instituicao'] ?>')[0].reset();">Fechar</button>
                        <button type="submit" onclick="mudarFoto(<?= $dado['id_instituicao'] ?>);" class="btn btn-primary botaoInstituicao" id="botaoInstituicao_<?= $dado['id_instituicao'] ?>" name="botao" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

    use App\Auth;

    if (Auth::verificaSessionLogin() == false) {
        Funcoes::retornaTela('.');
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="./src/scripts/script.js"></script>
    <script src="./src/scripts/jquery.wiggle.min.js"></script>
    <script src="./src/scripts/jquery.mask.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script>
        function logoutUser() {
            document.cookie = 'PHPSESSID' + '="";-1; path=/';
            document.cookie = 'login' + '="";-1; path=/';
            window.location.replace('./index.php')
        }
        // Máscara para CPF, Telefone e RG.
        var options = {
            onKeyPress: function(cpf, ev, el, op) {
                var masks = ['000.000.000-000', '00.000.000/0000-00'];
                $('.form-control.cpfOuCnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
            }
        }
        $('.form-control.cpfOuCnpj').length > 11 ? $('.form-control.cpfOuCnpj').mask('00.000.000/0000-00', options) : $('.form-control.cpfOuCnpj').mask('000.000.000-00#', options);

        function cidadesEstados($idInstitute) {
            $.getJSON('./src/scripts/estados_cidades.json', function(data) {
                var options = '<option value="">Escolha um Estado</option>';
                $.each(data, function(key, val) {
                    if ($('#estadoatual_' + $idInstitute).val() == val.nome) {
                        options += '<option value="' + val.nome + '" selected>' + val.nome + '</option>';
                    } else {
                        options += '<option value="' + val.nome + '">' + val.nome + '</option>';
                    }
                });
                $(".form-select.estados_" + $idInstitute).html(options);

                $(".form-select.estados_" + $idInstitute).change(function() {
                    var options_cidades = '';
                    var str = "";
                    $(".form-select.estados_" + $idInstitute + " option:selected").each(function() {
                        str += $(this).text();
                    });
                    $.each(data, function(key, val) {
                        if (val.nome == str) {
                            $.each(val.cidades, function(key_city, val_city) {
                                if ($('#cidadeatual_' + $idInstitute).val() == val_city) {
                                    options_cidades += '<option value="' + val_city + '" selected>' + val_city + '</option>';
                                } else {
                                    options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
                                }
                            });
                        }
                    });
                    $(".form-select.cidades_" + $idInstitute).html(options_cidades);
                }).change();
            });
        };

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

        function cssEstado(idInstitute) {
            if (($(".form-select.estados_" + idInstitute).val().length) == 0) {
                $(".form-select.estados_" + idInstitute).attr('style', 'color: #C4C4C4 !important');
            } else {
                $(".form-select.estados_" + idInstitute).attr('style', 'color: #5e5e5e !important');
            }
        };
        $(".form-select.estados_" + idInstitute).focusin(function() {
            $(".form-select.estados_" + idInstitute).attr('style', 'color: #5e5e5e !important');
        });
        $(".form-select.estados_" + idInstitute).focusout(function() {
            if (($(".form-select.estados_" + idInstitute).val().length) == 0) {
                $(".form-select.estados_" + idInstitute).attr('style', 'color: #C4C4C4 !important');
            }
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

        function defineOrdemTopicos(idInstituicao) {
            $('.editar').off("click");
            var arr = [];
            $('#FormInstituteEdit_' + idInstituicao + ' input:checked').map(function(index) {
                arr[index] = this.getAttribute('data-value');
            }).get();
            const results = [];
            arr.forEach(element => {
                if (element !== null) {
                    results.push(element);
                }
            });
            $('#topicos_' + idInstituicao).val(results);
            return results;
        };

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

        function verificaInformacoes(idInstituicao, $data) {
            if ($('#ativo_ate_' + idInstituicao).prop("checked")) {
                $('#date_' + idInstituicao).prop('type', "date")
                $('#date_' + idInstituicao).prop('disabled', false);
            } else {
                $('#date_' + idInstituicao).prop('disabled', true);
                $('#date_' + idInstituicao).prop('type', "text")
                $('#date_' + idInstituicao).val('');
                $('#date_' + idInstituicao).prop('placeholder', "__/__/____")
            }
        }

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

        $(document).ready(function() {
            $('.statusInstit').click(function() {
                var clickBtnValue = $(this).val();
                var ajaxurl = './src/php/Ajax.php',
                    data = {
                        'action': 'trocarStatus',
                        'id_instituicao': clickBtnValue,
                        'institute': this.getAttribute('data-institute'),
                        'value': this.getAttribute('data-value')
                    };

                $.post(ajaxurl, data, function(response) {
                    location.reload();
                });
            });
            $('.excluir').click(function() {
                if (confirm("Deseja excluir a instituição?") == true) {
                    var ajaxurl = './src/php/Ajax.php',
                        data = {
                            'action': 'removerInstituicao',
                            'institute': this.getAttribute('data-institute'),
                        };
                    $.post(ajaxurl, data, function(response) {
                        location.reload();
                    });
                };
            });
        });

        function mudarFoto($idInstitute) {
            $('#FormInstitutePhoto_' + $idInstitute).submit();
        }
    </script>
</body>

</html>