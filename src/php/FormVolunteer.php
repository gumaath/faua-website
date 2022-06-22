<?php
namespace App;
include ($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

use App\Connect;

class FormVolunteer {

    public function __construct()
    {
        
    }

    public static function cadastrarVoluntario($params) {
        $db = new Connect();
        $dbcon = $db->ConnectDB();

        $sql = "INSERT INTO tb_voluntarios (nome_voluntario, email_voluntario, endereco_voluntario ,senha_acesso, cpf_voluntario, rg_voluntario, tel_voluntario, estado_voluntario, cidade_voluntario, tipo_sanguineo, neg_pos, nasc_voluntario, ativo_voluntario)
        VALUES ('{$params['nomeVolunteer']}', 
        '{$params['emailVolunteer']}',
        '{$params['endVolunteer']}',
        '{$params['passVolunteer']}',
        '{$params['cpfVolunteer']}',
        '{$params['rgVolunteer']}',
        '{$params['telVolunteer']}',
        '{$params['estadoVolunteer']}',
        '{$params['cidadeVolunteer']}',
        '{$params['sangueVolunteer']}',
        '{$params['tipoVolunteer']}',
        '{$params['nascVolunteer']}',
        0)";

        $stmt = $dbcon->prepare($sql);
        $stmt->execute();
    }
}
