<!--- Esse não utiliza o template por se diferenciar dos demais-->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <link rel="stylesheet" href="<?=BASE_PATH?>/app/assets/css/global.css">
</head>
<body>
    <div class="box">
        <h1 id='titulo'>Login</h1>
        <form action="/Login" method="POST">
            <div class="input_widget">
            <label for="user" class="label_text">Usuário</label>
            <input type="text" id="user" class="input_text" name="user" oninput="adjust('user')" required>
            </div>
            <div class="input_widget">
            <label for="password" class="label_text">Senha</label>
            <input type="password" class="input_text" name="password" id="password" required>
            </div>
            <input type="submit" value="Enviar" class="submit">
        </form>
    </div>
    <script src="app/assets/scripts/global.js"></script>
</body>
</html>