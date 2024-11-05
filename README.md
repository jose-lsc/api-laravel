
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" />

# :rocket: Tecnologias
> Tecnologias usadas no desenvolvimento
- Laravel
- PHP
- PostgreSQL
- Docker

# :link: *Dependências* 
> Dependências para poder executar o projeto.
- PostgreSQL
- Composer

# :hammer_and_wrench: Instalação
> Download e configuração do projeto.

- Clone o projeto para o seu ambiente de desenvolvimento
```sh
git clone https://github.com/jose-lsc/api-laravel.git
```
- Acesse a pasta do repositório clonado
```sh
cd api-laravel/
```
- Execute o comando para retornar a raiz do projeto
```sh
cd ..

```
- Execute o comando dentro da pasta do projeto para inicializar o container do docker
```sh
docker-compose up
```
- Execute o comando em seu terminar para acessar o projeto dentro do docker
```sh
docker exec -it php-api-laravel /bin/bash
```
- Execute o comando para instalar as dependências do projeto
```sh
composer install
```
- Execute o comando para gerar as tabelas e os dados iniciais
```sh
php artisan migrate:fresh 
```
# :computer: Inicialização
> Execute os comandos abaixo no repositório clonado, para inicializar o docker.

- Inicializar o docker
```sh
docker-compose up
```
### :raising_hand_man: Acesso a área dos perfis:
- Url: http://127.0.0.1:8989