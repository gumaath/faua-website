<?php
namespace App;

include $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use App\Connect;
use App\Mailer;

class Funcoes {
    public static function sucessoTela() {
        echo <<<SCRIPT
        <script>window.location.replace('./src/views/success-volunteer-submit.php')</script>
    SCRIPT; 
    }
    public static function errorTela($path = './src/views') {
        echo <<<SCRIPT
        <script>window.location.replace('$path/error.php')</script>
    SCRIPT; 
    }
    public static function retornaTela($path = './src/views') {
        echo <<<SCRIPT
        <script>window.location.replace('$path/index.php')</script>
    SCRIPT; 
    }
    public static function proximaTela($params, $path = './src/views') {
        echo <<<SCRIPT
        <script>window.location.replace('$path/register_institute_definitive.php?{$params}')</script>
    SCRIPT; 
    }

    public static function retornaTipoInstituicao($numeroTipo) {
        $db = new Connect();
        $dbcon = $db->ConnectDB();
        $sth = $dbcon->prepare("SELECT * FROM tb_tipoinstituicao where id_tipo = {$numeroTipo}");
        $sth->execute();
        $result = $sth->fetch();
        return $result['nome_tipo'];
    }
    
    public static function retornaTopicoInstituicao($jsonTopico) {
        $db = new Connect();
        $dbcon = $db->ConnectDB();
        $sth = $dbcon->prepare("SELECT * FROM tb_topicosinstituicao where id_topico = {$jsonTopico}");
        $sth->execute();
        $result = $sth->fetch();
        return $result['nome_topico'];
    }

    public static function ativaDesativaInstituicao($idInstituicao, $estado) {
        $db = new Connect();
        $dbcon = $db->ConnectDB();
        if ($estado == '1') 
            $sql = "UPDATE tb_instituicoes SET ativo_instituicao = '0' where id_instituicao = {$idInstituicao}";
        else 
            $sql = "UPDATE tb_instituicoes SET ativo_instituicao = '1' where id_instituicao = {$idInstituicao}";
        $stmt = $dbcon->prepare($sql);
        $func = $stmt->execute();
    }

    public static function removerInstituicao($idInstituicao) {
        $db = new Connect();
        $dbcon = $db->ConnectDB();
        $sql = "DELETE FROM tb_instituicoes where id_instituicao = {$idInstituicao}";
        $stmt = $dbcon->prepare($sql);
        $stmt->execute();
    }

    public static function enviarCandidatoInstituicao($params) {
        $usuario = unserialize($params['dadosVolunteer']);
        $instituicao = unserialize($params['dadosInstitute']);
        $mail = new Mailer();
        $mail->enviaEmail($params, $usuario['email_voluntario'], $usuario['nome_voluntario'], 'candidate-volunteer-confirm');
        $mail->enviaEmail($params, $instituicao['email_instituicao'], $instituicao['resp_instituicao'], 'candidate-volunteer-institute-notification');
    }
    
}
?>