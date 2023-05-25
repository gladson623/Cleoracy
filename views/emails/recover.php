<div>
    <h4>Olá, <?= $user->First_Name; ?></h4>
    <p>Uma recuperação de senha foi solicitado para este email, caso não for você favor ignorar essa mensagem.</p>
    <p><a href="<?= $link; ?>" title="Recuperar senha">CLIQUE AQUI PARA RECUPERAR SUA SENHA</a></p>
    <p>Atenciosamente <?= site("name"); ?></p>
</div>