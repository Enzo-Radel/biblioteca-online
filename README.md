# Projeto Biblioteca Online

Este projeto utiliza Laravel 10, Docker e Vite para criar um ambiente de desenvolvimento eficiente e fácil de configurar. A biblioteca Breeze é utilizada para autenticação e layout base.

## Dependências

- **Composer**: Versão 2
- **Docker**: Incluindo Docker Compose
- **Node.js**: Versão 20

## Instruções de Configuração

1. **Configuração do Ambiente**
   - Instale as dependências do PHP:
     ```bash
     composer install
     ```
   - Instale as dependências do Node.js:
     ```bash
     npm install
     ```
   - Clone o arquivo `.env.example` para `.env`.
     ```bash
     cp .env.example .env
     ```
   - Instalar Sail na aplicação (selecione mysql)
     ```bash
     php artisan sail:install
     ```

3. **Iniciar o Ambiente de Desenvolvimento**
   - Suba os containers do Docker:
     ```bash
     sail up -d
     ```
   - Gere a chave da aplicação:
     ```bash
     sail artisan key:generate
     ```
   - Rodar Migrations:
     ```bash
     sail artisan migrate
     ```
   - Compile os assets do frontend:
     ```bash
     npm run dev
     ```

4. **Acessar a Aplicação**
   - Abra o navegador e acesse `localhost`.

## Informações Adicionais

- O projeto é executado com o Laravel Sail para facilitar a configuração do ambiente.
- A biblioteca Breeze é utilizada para implementar a autenticação e fornecer a base do layout.

---

Siga as instruções acima para configurar e iniciar o projeto. Se encontrar problemas, verifique se todas as dependências estão instaladas corretamente e se as variáveis de ambiente estão configuradas conforme necessário.