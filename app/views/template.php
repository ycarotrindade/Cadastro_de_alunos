<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <link rel="stylesheet" href="<?=BASE_PATH?>/app/assets/css/global.css">
</head>
<body>
    <?php if(!empty($_SESSION['user'])):?>
    <ul class="nav">
        <li><a href="/cadastro/funcionarios/">Cadastro</a></li>
        <li><a href="/lista/funcionarios/">Funcionarios</a></li>
        <li><a href="/lista/alunos">Alunos</a></li>
    </ul>
    <?php endif?>
    <div class="content">
        <?php echo $this->load();?>
    </div>
    <script src="<?=BASE_PATH?>/app/assets/scripts/global.js"></script>
</body>
</html>