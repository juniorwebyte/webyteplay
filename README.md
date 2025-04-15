# Rifa

Este é um sistema de rifas online desenvolvido em PHP. Ele permite a criação, gerenciamento e participação em rifas, com suporte a pagamentos via PIX e outras funcionalidades como gerenciamento de clientes, produtos e licenças.

## Funcionalidades

- **Gerenciamento de Rifas**: Criação e edição de rifas com diferentes tipos de sorteios.
- **Gerenciamento de Clientes**: Cadastro, edição e validação de dados como CPF, telefone e e-mail.
- **Pagamentos via PIX**: Integração com PIX para pagamentos rápidos e automáticos.
- **Sistema de Licenciamento**: Controle de licenças para uso do sistema.
- **Logs e Auditoria**: Registro de ações realizadas no sistema.
- **Integração com PHPMailer**: Envio de e-mails para notificações e comunicação com os clientes.
- **Geração de QR Codes**: Utilização da biblioteca PHPQRCode para geração de códigos QR.

## Estrutura do Projeto

A estrutura do projeto é organizada da seguinte forma:


## Requisitos

- **PHP**: Versão 7.4 ou superior.
- **Banco de Dados**: MySQL ou MariaDB.
- **Extensões PHP**:
  - `mysqli`
  - `curl`
  - `gd` (para geração de QR Codes)
- **Servidor Web**: Apache ou Nginx.

## Instalação

Siga os passos abaixo para configurar o sistema:

### 1. Clonar o Repositório

Clone o repositório para o diretório do seu servidor web:

```bash
git clone https://github.com/juniorwebyte/webyteplay