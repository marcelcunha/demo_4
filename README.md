# Aplicação de Demonstração

## Sobre

Esse projeto foi criado usando TALL Stack (Tailwind, Alpine, Laravel e Livewire), PHP 8.2 e MySql 8 em containeres Docker. A interface é baseada nos componentes da TailwindUi, porém as telas que lidam com autenticação tem o design do Laravel Breeze. Os ícones são do HeroIcons para manter o ecossistema da Tailwind.

Para tradução de termos em português foi usado o pacote laravel-pt-BR-localization. Laravel Pint (PHP CsFixer) para padronizar o código PHP(já vem instalado por padrão no framework). Larastan (PHPStan) para análise estática do código (evita errors, principalmente inconsistência de tipos). PestPHP para testes de funcionalidades. Como citado anteriormente Laravel Breeze para gearar o código e telas de autenticação.

## Instalação

É recomendado que se use Docker para rodar o projeto, porém é possível executá-lo sem o uso de containeres. Para isso é necessário ter instalado o PHP 8.2, MySql 8.0, Composer e NodeJs e algum servidor Http  compatível (Apache ou Nginx).

### Passos com Docker

  1. Baixe esse projeto em sua máquina.
  2. Abra um terminal na pasta do projeto e execute o comando:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

Isso irá instalar as dependências do `composer.json` e junto com elas um script (`sail`) para facilitar o uso com Docker.
Voce pode ignorar os comandos com o script e usar o Docker diretamente, porém o script facilita o uso então os passos usarão esses comandos.

3. Copie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente de como necessitar.

É importante que especifique os valores para `APP_PORT`, `FORWARD_DB_PORT` e `VITE_PORT` para portas que não estão sendo usadas em sua máquina.
Caso queira que a previsão do tempo seja exibida com precisão, é necessário que especifique a variável `WEATHER_API_KEY` com uma chave válida da API da [HgBrasil](https://hgbrasil.com/status/weather), no link há os passos para conseguir uma chave.

4. Execute o comando `./vendor/bin/sail up -d` para subir os containeres.

5. Execute o comando `./vendor/bin/sail artisan migrate --seed` para criar as tabelas no banco de dados e populá-las.

6. Execute o comando `./vendor/bin/sail npm install` para instalar as dependências do NodeJs.

7. Execute o comando `./vendor/bin/sail npm run dev` para compilar os assets e manter em hot reload ou simplesmente execute `./vendor/bin/sail npm run build` e não precisará se preocupar enquanto não fizer alterações no código.

8. Execute o comando `./vendor/bin/sail artisan key:generate` para gerar uma chave para a aplicação.

9. Acesse o endereço `http://localhost:APP_PORT` (onde `APP_PORT` é valor especificado no`.env`) no navegador e poderá ver a aplicação rodando.
