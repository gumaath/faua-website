<?php $usuario = unserialize($params['dadosVolunteer']);?>
<?php $instituicao = unserialize($params['dadosInstitute']);?>
<span style="opacity: 0"> <?=$randomness?> </span>
<h2>Olá, <?= $instituicao['resp_instituicao']?>!</h2>
<br>
<h3>Tem um voluntário querendo ajudar!</h3>
<h4>Segue abaixo os dados dele(a) para você entrar em contato!</h4>
<hr>
<div><span><b>Nome</b>: <?= $usuario['nome_voluntario']?></span></div>
<div><span><b>Data de Nascimento:</b> <?= $usuario['nasc_voluntario']?></span></div>
<div><span><b>Endereço:</b> <?= $usuario['endereco_voluntario']?></span></div>
<div><span><b>Cidade:</b> <?= $usuario['cidade_voluntario']?></span></div>
<div><span><b>Estado:</b> <?= $usuario['estado_voluntario']?></span></div>
<div><span><b>Tipo Sanguíneo:</b> <?= $usuario['tipo_sanguineo']?><?= $usuario['neg_pos']=="NEGATIVO"?'-':'+'?></span></div>
<div><span><b>Telefone:</b> <?= $usuario['tel_voluntario']?></span></div>
<div><span><b>CPF:</b> <?= $usuario['cpf_voluntario']?></span></div>

<p>Juntos, esperamos que façam do mundo, um lugar melhor! :)</p>
<br>
<div>
<i>Com carinho,</i>
<i>- Equipe do FAUA.</i>
</div>
<br>
<img src='cid:logo_ref' alt="" style="width: 100px;">
<span style="opacity: 0"> <?=$randomness?> </span>
<style>
    * {
        margin: 0;
        padding: 0;
    }
</style>