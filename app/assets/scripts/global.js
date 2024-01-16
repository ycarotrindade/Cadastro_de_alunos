function adjust (id)
{
    //substitui letras acentuadas por letras não acentuadas e tira caracteres especiais
    var element=document.getElementById(id)
    var content=element.value
    content=content.normalize("NFD").replace(/[\u0300-\u036f]/g,"").toUpperCase()
    content=content.replace(/[^A-Z\s]/g,"")
    element.value=content
}