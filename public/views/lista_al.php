<?php $this->extends('template',[
    'title'=>$title
]);?>
<div class="table_area">
    <table class="table_widget" style="display: none;">
    <tr>
        <th></th>
        <th>Id</th>
        <th>Nome</th>
        <th>Nota 1</th>
        <th>Nota 2</th>
        <th>Nota 3</th>
        <th>Situação</th>
    </tr>
    </table>
</div>
<script>
    fetch(`${window.location.href}/valores`)
        .then(response=>{
            if (response.status == 204)
            {
                throw new Error('Vazio')
            }else
            {
                return response.json()
            }
        })
        .then(data=> {
            const conteudo = document.querySelector("div.content")
            const table = document.querySelector('table.table_widget')
            const img = document.createElement('img')

            img.setAttribute('src','<?=BASE_PATH?>/public/assets/imgs/loading.gif')
            img.setAttribute('id','loader')
            conteudo.appendChild(img)

            for(const x in data)
            {

                const row = document.createElement('tr')

                const deleteWidget = document.createElement('td')
                deleteWidget.innerHTML = `<a href='/deletar/alunos/${data[x].id}' class='delete'>X</a>`
                deleteWidget.addEventListener('click',function(){deleteUser(event,deleteWidget,row)})
                row.appendChild(deleteWidget)

                const id = document.createElement('td')
                id.innerText = data[x].id
                row.appendChild(id)

                const name = document.createElement('td')
                name.innerHTML = `<a href='/editar/alunos/${data[x].id}'class='edit'>${data[x].name}</a>`
                row.appendChild(name)

                const grade1 = document.createElement('td')
                grade1.innerText = data[x].grade1
                row.appendChild(grade1)

                const grade2 = document.createElement('td')
                grade2.innerText = data[x].grade2
                row.appendChild(grade2)

                const grade3 = document.createElement('td')
                grade3.innerText = data[x].grade3
                row.appendChild(grade3)

                const situation = document.createElement('td')
                situation.setAttribute('id',data[x].situation.toLowerCase())
                situation.innerText = data[x].situation.toUpperCase()
                row.appendChild(situation)

                table.appendChild(row)
            }

            table.setAttribute('style','display:block;')
            img.remove()

        })
        .catch(err=>{
            if (err.message == 'Vazio')
            {
                const table = document.querySelector('table.table_widget')
                table.remove()

                const table_content = document.querySelector('div.content')

                const errorP = document.createElement('h1')
                errorP.setAttribute('id','erro')
                errorP.innerText = 'Banco de dados vazio'

                table_content.appendChild(errorP)
            }else
            {
                alert('Erro no servidor, tente novamente mais tarde');
            }
        })
</script>