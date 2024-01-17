<?php $this->extends('template',['title'=>$title]);?>
<div class="box">
    <form action="/cadastro/funcionarios/salvar" method="POST">
        <h1><?php echo "Cadastro de $tipo"?></h1>
        <?php if($tipo=='funcionarios'):?>
            <div class="input_widget">
            <label for="user" class="label_text">Usuário</label>
            <input type="text" id="user" class="input_text" name="user" oninput="adjust('user')" required>
            </div>
            <div class="input_widget">
            <label for="password" class="label_text">Senha</label>
            <input type="password" class="input_text" name="password" id="password" required>
            </div>
            <div class="tiny_box">
                <input type="submit" value="Enviar" class="submit">
                <input type="button" value="Usuários" class="submit" onclick="window.location.href='/cadastro/alunos'">
            </div>
        <?php else:?>
            
        <?php endif?>
    </form>
</div>