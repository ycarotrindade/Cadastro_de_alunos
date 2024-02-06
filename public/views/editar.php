<?php $this->extends('template',['title'=>$title]);?>
<div class="box">
    <form action="/editar/<?=$tipo?>/<?=$id?>/salvar"  id='form_edit' method="POST">
        <input type="text" name="method"  value="PUT" style="display: none;">
        <h1><?php echo "Edição de $tipo"?></h1>
        <?php if($tipo=='funcionarios'):?>
            <div class="input_widget">
            <label for="user" class="label_text">Usuário</label>
            <input type="text" id="user" class="input_text" name="user" value="<?=$values->user?>" oninput="adjust('user')" required>
            </div>
            <div class="input_widget">
            <label for="password" class="label_text">Senha</label>
            <input type="password" class="input_text" name="password" id="password" required>
            </div>
            <div class="input_widget">
            <label for="access" class="label_text">Tipo de Acesso</label>
            <select name="access" id="access" class="select_widget" required>
                <?php foreach ($setValues as $op):?>
                    <option value="<?=$op?>" <?php if ($op==$values->access):?> selected <?php endif?>><?=$op?></option>
                <?php endforeach?>
            </select>
            </div>
            <div class="tiny_box">
                <input type="submit" value="Enviar" class="submit">
            </div>
        <?php else:?>
            <div class="input_widget">
                <label for="user" class="label_text">Nome Completo</label>
                <input type="text" id="user" class="input_text" name="user" value="<?=$values->name?>"oninput="adjust('user')" required>
            </div>
            <div class="tiny_box">
            <div class="input_widget">
                <label for="grade1" class="label_text">Nota 1</label>
                <input type="number" class="input_number" id="grade1" name="grade1" min=-1 max=10 value="<?=$values->grade1?>" required>
            </div>
            <div class="input_widget">
                <label for="grade2" class="label_text">Nota 2</label>
                <input type="number" class="input_number" id="grade2" name="grade2" min=-1 max=10 value="<?=$values->grade2?>" required>
            </div>
            <div class="input_widget">
                <label for="grade3" class="label_text">Nota 3</label>
                <input type="number" class="input_number" id="grade3" name="grade3" min=-1 max=10 value="<?=$values->grade3?>" required>
            </div>
            </div>
            <div class="tiny_box">
                <input type="submit" value="Enviar" class="submit">
            </div>
        <?php endif?>
    </form>
</div>