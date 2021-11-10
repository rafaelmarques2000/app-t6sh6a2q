## Informações do Projeto

Setup do projeto

#### siga os passos abaixo:
- renomear .env.exemple para .env
- docker-compose up
- docker exec -it {nome do container} bash
- composer install
- php artisan doctrine:migrations:migrate
- php artisan db:seed

Tecnologias Utilizadas

- PHP 7.4
- Laravel 8.6
- PhpUnit 9.5 
- Postgres 12
- ORM Doctrine V1.7
- Docker 20.10.7
- Docker Compose 20.10.7

Padrões de Projeto e Design de software:

 **Padrões de projeto**

- Template Method
- Facade  
- Simple Factory
- Data Transaction Objects(DTO)

Metodologia de desenvolvimento: TDD(Test Driven Development)

Estrutura do projeto baseada em DDD e Arquiteture Hexagonal

#### Base de codigo
toda a codificação se encontra dentro de App/Packages onde temos a seguinte estrutura
- Base - Todo codigo comum que será compartilhado interfaces entre utils entre outros
- Doctrine - Implementações para o ORM doctrine2
- Produto - pacote onde se encontra as regras de negocio para produto

***
#### Endpoints: 

**Produto**:

Cadastrar Produto:
POST: http://localhost:1200/api/produtos <br>
`Payload:
{
"sku": "BR/506",
"nome": "IPHONE 12",
"quantidadeInicial": 100
}
`<br><br>
Listar Produtos:
GET: http://localhost:1200/api/produtos

Detalhes do Produto:
GET: http://localhost:1200/api/produtos/{Id Produto}
****
**Movimentação estoque**

Dar entrada produto estoque:
PUT : http://localhost:1200/api/produtos/{Id Produto}/estoque/entrada <br>
`Payload:
{
"sku": "BR/506",
"quantidade": 100
}
`<br><br>
Dar Saida produto estoque:
PUT : http://localhost:1200/api/produtos/{Id Produto}/estoque/saida <br>
`Payload:
{
"sku": "BR/506",
"quantidade": 100
}
`<br>

Historico De movimentação:
PUT : http://localhost:1200/api/produtos/{Id Produto}/estoque/historico-movimento
