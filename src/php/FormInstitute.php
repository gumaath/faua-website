<?php
namespace App;
include ($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

use App\Connect;

class FormInstitute {

    public function __construct()
    {
    }

    static public function atualizarFormInstitute($params)
    {
        $db = new Connect();
        $dbcon = $db->ConnectDB();
    
        $params['ativo_ate'] = (int)$params['ativo_ate'];

        $topicos = explode(',',$params['topicos']);
        $topicos = json_encode($topicos);

        $sql = "UPDATE tb_instituicoes SET 
        nome_instituicao = '{$params['formNomeInstitute']}', 
        resp_instituicao = '{$params['formRespInstitute']}',
        cpf_cnpj_instituicao = '{$params['formCNPJCPFInstituter']}',
        endereco_instituicao = '{$params['formEndInstitute']}',
        tipo_instituicao = {$params['tipoinstituicao']},
        cidade_instituicao = '{$params['cidadeInstitute']}',
        estado_instituicao = '{$params['estadoInstitute']}',
        ativo = {$params['ativo_ate']},";

        if (isset($params['dataInatInstituicao']) && $params['dataInatInstituicao'] <> "") 
            $sql .= "ativo_ate = '{$params['dataInatInstituicao']}',";
        
        $sql .= "topicos_instituicao = '{$topicos}'";
        $sql .= "WHERE id_instituicao = {$params['idInstituicao']}";

        $stmt = $dbcon->prepare($sql);
        $func = $stmt->execute();
        if ($func === true)
            return true;
        else
            return false;
    }

    static public function adicionarFormInstitute($params)
    {
        $db = new Connect();
        $dbcon = $db->ConnectDB();
    
        $params['ativo_ate'] = (int)$params['ativo_ate'];

        if (!isset($params['dataInatInstituicao']) || $params['dataInatInstituicao'] == "") 
            $params['dataInatInstituicao'] = '1987-01-01';

        $topicos = explode(',',$params['topicos']);
        $topicos = json_encode($topicos);

        $sql = "INSERT INTO tb_instituicoes (nome_instituicao, resp_instituicao, cpf_cnpj_instituicao, endereco_instituicao, tipo_instituicao, ativo, ativo_ate, topicos_instituicao, ativo_instituicao, cidade_instituicao, estado_instituicao)
        VALUES ('{$params['formNomeInstitute']}', 
        '{$params['formRespInstitute']}',
        '{$params['formCNPJCPFInstituter']}',
        '{$params['formEndInstitute']}',
         {$params['tipoinstituicao']},
         {$params['ativo_ate']},
         '{$params['dataInatInstituicao']}',
        '{$topicos}',
        1,
        '{$params['cidadeInstitute']}',
        '{$params['estadoInstitute']}')";

        $stmt = $dbcon->prepare($sql);
        $stmt->execute();

    }
}

?>