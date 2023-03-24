### Build do Projeto:

Crie o Arquivo .env e copie o conteúdo de .env.example


Comando para subir os containers do projeto:
```sh
docker-compose up -d
```


Acessar o bash do container:
```sh
docker-compose exec app bash
```


Instalar as dependências do projeto
```sh
composer install
```


Gerar a key do projeto Laravel
```sh
php artisan key:generate
```

Renovar Cache de Rotas e Configurações
```sh
php artisan optimize
```


O projeto estará disponível pelo link local:
[http://localhost:8989](http://localhost:8989)


ps.: Esse projeto utiliza a imagem do docker hub da especializa-ti.

### Sobre o Projeto:
Aplicação com: Laravel 10 e PHP 8.1

Essa aplicação tem por finalidade conectar com a API de pagamentos do Mercado Pago. 

Está sendo utilizado o SDK do Mercado Pago para PHP, na versão 2.5.3, que abstrai as conexões com a API de pagamentos.

### Estrutura do Projeto
- Controllers: app/Http/Controllers
- RequestValidators: app/Http/Requests
- Providers: app/Providers
- Services: app/Services
- Testes: app/tests/Services
- Front: app/resources

### Melhorias a fazer / crescimento do projeto:
- Criar autenticação da aplicação 
    - Sugestões: JWT / Tymon
- Evoluções e correções no Frontend
    - Separação dos arquivos js/css/html 
        - Acabei fazendo junto por conta do tempo e de algumas dificuldades, mas o correto seria separar os arquivos por finalidade.
    - Melhorar usabilidade, responsividade e design.
- Evoluções na Estrutura:
    - Criação de interfaces (ou contracts) para isolamento dos repositories/serviços
        - No caso de contracts, vincular ao AppServiceProvider os contratos aos respectivos serviços.
    - Caso a aplicação cresça, utilizar repositories para implementação das querys do eloquent e estudar a separação por camadas (App/Domain/Infra)
    - Também, com o crescimento da aplicação é interessante realizar a quebra de contextos da mesma, isolando as estruturas para cada contexto.
- Evolução e correção dos Testes
    - Não estão concluídos os testes, pois não houve tempo ábil para tratar como fazer os Mocks do SDK e deixei os mesmos por último.
    - Implementação de testes de integração com a API de pagamentos (Pesquisar sobre como implementar com o SDK)
- Melhorias e correções relativas a uso da SDK do Mercado Pago. 
    - Entender porque a parte de cartões não está retornando nada e o que fiz de errado nessa integração. 
    - Aprofundar mais na documentação de materiais para o SDK, para uma melhor utilização do mesmo.
    - Melhorar tratamento de erros.
