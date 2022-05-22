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
    <div id="main-content">
        <div class="container w-25" style="background-color: rgba(255,255,255,0.3); border-radius: 10px;">
                <img src="../assets/logo_full_white.png" alt="" width="200">
                <h3 class="title">Bem-vindo!</h3>
                <h5 class="title">Faça login da sua conta:</h5>
                <form id="loginForm" method="post">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="loginEmail" placeholder="E-mail" name="RSSfirstName">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="loginPassword" placeholder="Senha" name="RSSfirstEmail">
                    </div>
                    <div style="background: none;">
                    <input type="submit" id="instituteSubmit" value="" style="background-image: url(/src/assets/right-arrow.svg); border: solid 0px; width:26px; background-color:rgba(255,255,255,0.0)" />
                    </div>
                </form>
        </div>
    </div>

    <?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

    use App\Auth;
    use App\Funcoes;

    if ($_REQUEST) {
        try {
            $login = $_POST['RSSfirstEmail'];
            $nome = $_POST['RSSfirstName'];
            $auth = Auth::verificaLogin($_POST['RSSfirstEmail'], $_POST['RSSfirstName']);
            if ($auth)
                $session = Auth::createSession($_POST['RSSfirstEmail']);
            if ($auth && $session) {
                setcookie('login', $login, 0, '/');
                header("Location:../../indexVolunteer.php");
            } else {
                Funcoes::errorTela("/src/views");
            }
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>