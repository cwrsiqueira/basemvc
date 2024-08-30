# BaseMVC
### O BaseMVC descrição!

### Para rodar o projeto a primeira vez

Vá até a pasta onde vc quer salvar o projeto e digite:
- `git clone https://github.com/cwrsiqueira/basemvc.git`
- `cd basemvc`

Inicie o Docker desktop, volte na pasta do projeto e digite:
- `docker-compose build`
- `docker-compose up -d`
- `docker exec -it php_app bash`

O último comando abrirá um prompt de comando do docker, digite:
- `composer install`

Altere o nome do arquivo .env.example para .env

Preencha as variáveis de ambiente

### Pra rodar o projeto depois da primeira vez:
- `docker-compose up -d`

### Pra parar o projeto
- `docker-compose down`

### Abra na URL:
http://localhost:8080

### Abra o phpmyadmin na URL:
http://localhost:8081

Usuário: basemvc

Senha: basemvc
