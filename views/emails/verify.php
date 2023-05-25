<div>
    <h4>Olá, <?= $user->First_Name; ?></h4>
    <p>Uma conta foi criada usando este email, caso não for você favor ignorar essa mensagem.</p>
    <p><a href="<?= $link; ?>" title="Verificar conta">CLIQUE AQUI PARA VERIFICAR SUA CONTA</a></p>
    <p>Use o código: <?= $user->verify_code; ?></p>
    <p>Atenciosamente <?= site("name"); ?></p>
</div>