# SISTEMA DE CADASTRO DE ALUNOS COM MVC+CRUD

Sistema de cadastro de alunos utilizando PHP com arquiteturas MVC (Model, View, Controller) e CRUD (Create, Read, Update, Delete)

# DESCRIÇÃO

O sistema contará com sistema de Login, Cadastro de alunos, Listagem e Cadastro de Notas (seguindo o padrão de três provas, ou seja três notas), análise da situação do aluno (Aprovado, Reprovado, Recuperação), utilizando as linguagens PHP e Javascript junto com o banco de dados MySql e o gerenciador de pacotes composer

# INSTRUÇÕES

## 1. Clone este Repositório
```bash
git clone https://github.com/ycarotrindade/Cadastro_de_alunos.git
```
## 2. Importe o dll do banco de dados
## 3. Altere o nome do arquivo `config_example.php` para `config.php` e preencha com as informações necessárias
## 4. Instale o composer em sua máquina
## 5. Rode o seguinte comando no diretório do projeto
```bash
composer install
```
## 6 . Execute o seguinte comando para rodar o servidor substituindo os campos em "<>" pelas suas informações
```bash
php -S <VHostname>:<Port> -t public
```