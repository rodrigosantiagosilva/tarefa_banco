# WSL
Permite rodar distribuições Linus  dentro do Windows.


o comando abaixo instala o Ubuntu como distribuição wsl.

```bash 
wsl --instal -d Ubuntu

```
No powershell, na primeira vez que executar o comando `wsl`, 
vai ser pedido para escolher um nome de usuário,
digitar a senha e digitar a senha novamente.

> Obs: ao digitar a senha **nunca**, será mostrado os caracteres.

# Pós instalação 
Na pós instalação deve-se atualizar o sistema operacional com os comandos 

```bash
sudo apt update
sudo apt upgrade
```

# Instalar o **mariadb**

Antes de instalar qualquer programa, sempre validar se a lista e programas está atualizada
```bash
sudo apt update
```
Instalar o mariadb:
```bash
sudo apt install mariadb-server
```
## Pós instalação do mariadb
Roda o comando após a instalação: 
```bash
sudo mysql_secure_installation
```
# Perguntas e Respostas

## Enter current password for root (enter for none): 
#### Clicar "ENTER" 
## Switch to unix_socket authentication [Y/n]        
#### n
## Change the root password? [Y/n]                   
#### y
## New password:                                     
#### digite senha 123456
## Re-enter new password:                            
#### digite senha 123456
## Disallow root login remotely? [Y/n]               
#### n
## Remove test database and access to it? [Y/n]      
#### y
## Reload privilege tables now? [Y/n] 
#### y

# Como gerenciar o serviço do banco de dados 
```bash
sudo systemctl start mariadb    #inicia
sudo systemctl stop mariadb     #para
sudo systemctl restart mariadb  #reinicia
sudo systemctl status mariadb   #verifica o status
```

# Para entrar no servidor 
```bash
mysql -uroot -p
```

# Mostrar database 
```sql
show databases;
```

# Comandos mariadb:

## Criar:
```sql
create database nome_banco;
```

## Deletar:
```sql
drop database nome_banco;
```

## Mostrar:
```sql
show database nome_banco;
```
## Criar Tabelas:
### Tabela: 
```sql
--- Tabela de Usuario
create table usuario (
    id int not null primary key auto_increment,
    nome varchar(100) not null,
    login varchar (50) not null unique,
    senha varchar (255) not null,
    email varchar(255) not null unique,
    foto_path varchar(255) null
);
 
--- Tabela de Tarefa
create table tarefa (
    id int not null primary key auto_increment,
    titulo varchar(255) not null,
    descricao text not null unique,
    status TINYINT(1) NOT NULL,
    user_id INT NOT NULL,
    CONSTRAINT fk_usuario_tarefa FOREIGN KEY (user_id) REFERENCES usuario(id) -- LAÇO DE LIGAÇÃO
    ON DELETE CASCADE ON UPDATE CASCADE
);


```
### Ubuntu:
```sql
sudo systemctl status mariadb para ver se o servidor ta dorando

```

### DESCRIBE:
```sql
describe "nometabela"; 

```
Mostra a tarefa

### Usar 
```sql
use "nomedatabase"; 

```
### Mostrar usuarios do banco 
```sql
SELECT * FROM usuario; 

```

# Fazer frontend com phpslim 
```bash
composer require slim/php-view

```