<?php $this->extends('template',[
    'title'=>$title
]);?>
<div class="table_area">
    <table class="table_widget">
    <tr>
        <th></th>
        <th>Id</th>
        <th>Nome</th>
        <th>Nota 1</th>
        <th>Nota 2</th>
        <th>Nota 3</th>
        <th>Situação</th>
    </tr>
    <?php foreach($table_values as $valor):?>
        <tr>
            <td><a href="/deletar/alunos/<?=$valor->id?>" class="delete">X</a></td>
            <td><?=$valor->id?></td>
            <td><a href="/editar/alunos/<?=$valor->id?>" class="edit"><?=$valor->name?></a></td>
            <td><?=$valor->grade1?></td>
            <td><?=$valor->grade2?></td>
            <td><?=$valor->grade3?></td>
            <td id="<?=strtolower($valor->situation)?>"><?=$valor->situation?></td>
        </tr>
    <?php endforeach?>
    </table>
</div>