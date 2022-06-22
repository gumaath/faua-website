<?php
namespace App;

include $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Funcoes;
use App\FormInstitute;

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'trocarStatus':
            Funcoes::ativaDesativaInstituicao($_POST['institute'], $_POST['value']);
            break;
        case 'atualizarInstituicao':
            FormInstitute::atualizarFormInstitute($_POST);
            break;
        case 'adicionarInstituicao':
            FormInstitute::adicionarFormInstitute($_POST);
            break;
        case 'removerInstituicao':
            Funcoes::removerInstituicao($_POST['institute']);
            break;
    }

}
?>