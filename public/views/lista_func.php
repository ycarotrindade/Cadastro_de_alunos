<?php $this->extends('template',['title'=>$title]);?>
<div class="table_area">
    <table class="table_widget">
        <tr>
            <th></th>
            <th>Id</th>
            <th>Username</th>
        </tr>
        <?php foreach($table_values as $valor):?>
            <tr>
                <td><a href="/deletar/funcionarios/<?=$valor->id?>" class="delete">X</a></td>
                <td><?=$valor->id?></td>
                <td><a href="/editar/funcionarios/<?=$valor->id?>" class="edit"><?=$valor->user?></a></td>
            </tr>
        <?php endforeach?>
    </table>
</div>