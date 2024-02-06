function adjust (id)
{
    let input = document.querySelector(`input#${id}`);

    let content_unformatted = input.value;
    let content_formatted = content_unformatted.normalize("NFD").replace(/[\u0300-\u036f]/g,"").toUpperCase();
    content_formatted = content_formatted.replace(/[^A-Z\s]/g,"");

    input.value = content_formatted
}


async function deleteUser(event,widget,row)
{
    event.preventDefault()
    
    const table = document.querySelector('table.table_widget')
    const url = widget.children[0].href

    await fetch(url, {method:'delete',})
        .then(response=> {
            if (response.status == 200)
            {
                alert("Usuário deletado")
                table.removeChild(row)
            }else if(response.status == '400')
            {
                alert("Você não pode deletar seu próprio usuário")
            }
        })
        .catch(err=> {
            alert("Ocorreu um erro no servidor, tente novamente mais tarde")
        })
}

async function catchJson(event)
{
    event.preventDefault()

    const body=new FormData(form_login)
    
    await fetch('/login',{body,method:"post"})
        .then(response=> {
            if(response.status == 401)
            {
                alert("Usuário ou senha inválidos")
            }else if(response.status == 204)
            {
                alert("Usuário não encotrado")
            }else
            {
                window.location.href="/home"
            }
        })
        .catch(error=> {
            alert("Erro interno do servidor, tente novamente mais tarde")
        })
}

async function registration_response(event)
{
    event.preventDefault()

    const body = new FormData(form_cadastro)

    await fetch(`${window.location.href}/salvar`, {body,method:'post'})
        .then(response=> {
            if (response.status == 400)
            {
                alert("Usuário já cadastrado no servidor")
            }else
            {
                alert("Usuário Cadastrado com sucesso")
            }
        })
        .catch(err=> {
            alert("Ocorreu um erro inesperado no servidor, tente novamente mais tarde")
        })
}

async function editUser(event)
{
    event.preventDefault()

    const body = new FormData(form_edit)

    await fetch(`${window.location.href}/salvar`, {body,method:'post'})
        .then(response=>{
            if (response.status != 200)
            {
                throw new Error('Problema no servidor')
            }else
            {
                alert("Informações atualizadas")
            }
        })
        .catch(err=>{
            alert('Ocorreu um problema no servidor, tente novamente mais tarde')
        })
}

const form_login = document.querySelector("form#form_login")
form_login != null ? form_login.addEventListener("submit",catchJson) : null

const form_cadastro = document.querySelector("form#form_cadastro")
form_cadastro != null ? form_cadastro.addEventListener("submit",registration_response) : null

const form_edit = document.querySelector('form#form_edit')
form_edit != null ? form_edit.addEventListener('submit',editUser) : null