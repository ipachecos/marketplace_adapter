# Proof Of Concept - Padrão Adapter

### Conceito
Um marketplace online que apresenta os produtos de 3 lojas, (store1, store2 e store3).

Cada loja possui um banco de dados e API próprios e o formato retornado não é uniforme.

A página inical do marketplace apresenta os produtos de apenas uma das 3 lojas por vez, revezando a loja apresentada com frequência.

### Motivação
O padrão Adapter pode ser utilizado para facilitar a alteração da loja apresentada na tela inicial.

### Inicialização

#### Instalando as dependências
Dentro da pasta de cada projeto (_marketplace_adapter_, _marketplace_store1_, _marketplace_store2_ e _marketplace_store3_), executar o comando `composer install` para instalar as dependências dos projetos.
	
#### Configurando as variáveis de ambiente
Dentro da pasta de cada projeto, renomear o arquivo _.env.example_ para _.env_. 
Desta forma, as variáveis de ambiente corretas poderão ser visualizadas pelo código do projeto.
	
#### Iniciando os servidores de cada loja
 1. Executar `php artisan serve --port=8000` no dentro do diretório _marketplace_store1_.
 2. Executar `php artisan serve --port=8080` no dentro do diretório _marketplace_store2_.
 3. Executar `php artisan serve --port=3000` no dentro do diretório _marketplace_store3_.

#### Iniciando o servidor do marketplace
 1. Executar `php artisan serve --port=8086` no dentro do diretório _marketplace_adapter_.

#### Criando Produtos
##### Loja 1
Enviar para _http://localhost:8000/api/_, pelo método _http POST_ as informações do produto no seguinte formato, com _score_ sendo um _float_ entre 0 e 10:
```javascript
{
	"nome": "Novo Produto",
	"preco": 23.99,
	"descricao": "Um novo produto",
	"nota": 9.7,
	"qtd_estoque": 23
}
```
##### Loja 2
Enviar para _http://localhost:8080/api/products_ pelo método _http POST_ as informações do produto no seguinte formato, com _score_ sendo um inteiro entre 1 e 100:
```javascript
{
	"prod_name": "New Product",
	"prod_description": "A new, recently designed product",
	"prod_score": 94,
	"prod_price": 27.99,
	"prod_in_stock": 34
}
```
##### Loja 3
Enviar para _http://localhost:3000/api/store/products_ pelo método _http POST_ as informações do produto no seguinte formato, com _score_ sendo um inteiro entre 1 e 100:
``` javascript
{
	"name": "Luxury Product",
	"description": "A new awesome product",
    	"score": 10,
    	"price": 94.50,
	"in_stock": 8
}
```
<br/>

### Utilização
#### Visualizando os produtos criados
Realizar requisiões _GET_ para a _API_ de cada loja:

 1. http://localhost:8000/api/
 2. http://localhost:8080/api/products
 3. http://localhost:3000/api/store/products

#### Utilizando o marketplace
O marketplace possui 2 _endpoints_, que devem ser acessados através de requisições _GET_, são eles:

**Página Inicial:** http://localhost:8086/api/products 

**Página com todos os produtos:** http://localhost:8086/api/all

#### Alterando a loja na página inicial
A variável de ambiente `CURRENT_STORE`, contida no arquivo _marketplace_adapter/.env_, armazena o número da loja cujos produtos serão apresentados na tela inicial do Marketplace. 

Para alterar a loja, basta modificar o valor armazenado pela variável pelo número correspondente à loja desejada.

Após a alteração, o _ProductsController_ do Marketplace se encarregará de chamar o _Adapter_ correspondente.
