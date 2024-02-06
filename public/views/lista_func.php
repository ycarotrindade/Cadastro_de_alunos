<?php $this->extends('template',['title'=>$title]);?>
<div class="table_area">
    <table class="table_widget" style="display: none;">
        <tr>
            <th></th>
            <th>Id</th>
            <th>Username</th>
            <th>Access</th>
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
            for (const x in data)
            {

                const row = document.createElement('tr')

                const deleteWidget = document.createElement('td')
                deleteWidget.innerHTML = `<a href='/deletar/funcionarios/${data[x].id}' class='delete')>X</a>`
                deleteWidget.addEventListener("click",function(){deleteUser(event,deleteWidget,row)})
                row.appendChild(deleteWidget)

                const id = document.createElement('td')
                id.innerText = data[x].id
                row.appendChild(id)

                const username = document.createElement('td')
                username.innerHTML = `<a href='/editar/funcionarios/${data[x].id}' class='edit'>${data[x].user}</a>`
                row.appendChild(username)

                const access = document.createElement('td')
                access.innerText = data[x].access.toUpperCase()
                row.appendChild(access)

                table.appendChild(row)

            }
            table.setAttribute('style','display:block;')
            img.remove()
        })
        .catch(err=> {
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