<?php $this->extends('template',['title'=>$title]);?>
<div class="box">
    <form action="/editar/<?=$tipo?>/salvar" method="POST">
        <h1><?php echo "Edição de $tipo"?></h1>
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
                <input type="button" value="Alunos" class="submit" onclick="window.location.href='/cadastro/alunos'">
            </div>
        <?php else:?>
            <div class="input_widget">
                <label for="user" class="label_text">Nome Completo</label>
                <input type="text" id="user" class="input_text" name="user" oninput="adjust('user')" required>
            </div>
            <div class="tiny_box">
            <div class="input_widget">
                <label for="grade1" class="label_text">Nota 1</label>
                <input type="number" class="input_number" id="grade1" name="grade1" min=-1 max=10 value="0" required>
            </div>
            <div class="input_widget">
                <label for="grade2" class="label_text">Nota 2</label>
                <input type="number" class="input_number" id="grade2" name="grade2" min=-1 max=10 value="0" required>
            </div>
            <div class="input_widget">
                <label for="grade3" class="label_text">Nota 3</label>
                <input type="number" class="input_number" id="grade3" name="grade3" min=-1 max=10 value="0" required>
            </div>
            </div>
            <div class="tiny_box">
                <input type="submit" value="Enviar" class="submit">
                <input type="button" value="Funcionários" id="func_button" class="submit" onclick="window.location.href='/cadastro/funcionarios'">
            </div>
        <?php endif?>
    </form>
</div>