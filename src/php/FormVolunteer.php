<?php
namespace App;
include ($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

use App\Connect;

class FormVolunteer {

    public function __construct()
    {
        
    }

    public function enviarFormVolunteer($nome, $sobrenome) {
        $db = new Connect();
        $dbcon = $db->ConnectDB();

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
    $stmt = $dbcon->prepare("INSERT INTO pessoa(nome, email) VALUES('{$nome}', '{$sobrenome}')");
    $func = $stmt->execute(); 
    if ($func === true)
        return true;
    else
        return false;
    }    
}
  
?>