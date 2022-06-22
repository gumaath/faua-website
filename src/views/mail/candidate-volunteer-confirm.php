<?php $usuario = unserialize($params['dadosVolunteer']);?>
<?php $instituicao = unserialize($params['dadosInstitute']);?>
<span style="opacity: 0"> <?=$randomness?> </span>
<h2>Olá, <?= $usuario['nome_voluntario']?>!</h2>
<br>
<h4>Muito obrigado por se candidatar para instituição <?= $instituicao['nome_instituicao']?>.</h4>
<p>Seu formulário já foi enviado para eles e eles já te conhecem!.</p>
<p>Acreditamos que em breve eles entrarão em contato.</p>
<hr>
<p>Obrigado por querer fazer do mundo, um lugar melhor! :)</p>
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