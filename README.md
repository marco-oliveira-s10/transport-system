# 🚗 Sistema de Controle de Abastecimento - Frontend

![Angular](https://img.shields.io/badge/Angular-17-red)
![TypeScript](https://img.shields.io/badge/TypeScript-5.2-blue)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.2-purple)
![License](https://img.shields.io/badge/License-MIT-yellow)

## 📋 Índice 

* [Sobre o Projeto](#-sobre-o-projeto)
* [Funcionalidades](#-funcionalidades)
* [Tecnologias](#-tecnologias)
* [Arquitetura](#-arquitetura)
* [Instalação](#-instalação)
* [Como Usar](#-como-usar)
* [Estrutura do Projeto](#-estrutura-do-projeto)
* [Variáveis de Ambiente](#-variáveis-de-ambiente)

## 🎯 Sobre o Projeto

Interface web do sistema de gerenciamento de abastecimentos para frotas de veículos, desenvolvido com Angular 17 e Bootstrap 5. Oferece uma interface moderna e responsiva para interação com o backend Spring Boot.

## ✨ Funcionalidades

- ✅ Cadastro de abastecimentos com validação de formulário
- 🔍 Busca em tempo real por placa
- 📊 Paginação com opções de 5, 10 e 15 registros
- 🌙 Modo escuro persistente
- 🎨 Interface responsiva com Bootstrap 5
- ✨ Animações suaves de transição
- 🚫 Validações de formulário:
  - Data futura não permitida
  - Placa em formato válido (AAA-1234 ou ABC1D23)
  - Campos obrigatórios

## 🛠 Tecnologias

- ![Angular](https://img.shields.io/badge/Angular-17-DD0031?style=flat&logo=angular&logoColor=white)
- ![TypeScript](https://img.shields.io/badge/TypeScript-5.2-3178C6?style=flat&logo=typescript&logoColor=white)
- ![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.2-7952B3?style=flat&logo=bootstrap&logoColor=white)
- ![Bootstrap Icons](https://img.shields.io/badge/Bootstrap_Icons-1.11.1-7952B3?style=flat&logo=bootstrap&logoColor=white)

## 🏗 Arquitetura

O projeto segue a estrutura padrão do Angular com componentes standalone:

```
src/
├── app/
│   ├── components/          # Componentes da aplicação
│   │   └── abastecimento/  # Componente principal
│   ├── services/           # Serviços
│   └── environments/       # Configurações de ambiente
├── assets/                 # Recursos estáticos
└── styles.css             # Estilos globais
```

## 🚀 Instalação

1. Clone o repositório:
```bash
git clone https://github.com/seu-usuario/sistema-abastecimentos.git
```

2. Navegue até o diretório do projeto:
```bash
cd sistema-abastecimentos
```

3. Instale as dependências:
```bash
npm install
```

## 💻 Como Usar

1. Inicie a aplicação em modo de desenvolvimento:
```bash
ng serve
```

2. Para build de produção:
```bash
ng build --configuration=production
```

3. Acesse:
- Desenvolvimento: http://localhost:4200
- Produção: Configure conforme seu ambiente de deploy

## 📁 Estrutura do Projeto

### Componentes Principais
- `AbastecimentoComponent`: Gerencia a listagem e formulário
- `AbastecimentoService`: Comunicação com a API
- `ConfigService`: Gerenciamento de configurações

### Arquivos de Configuração
- `angular.json`: Configurações do projeto
- `proxy.conf.json`: Configuração do proxy para desenvolvimento
- `environments/`: Variáveis de ambiente

## 🔧 Variáveis de Ambiente

O projeto utiliza diferentes configurações para desenvolvimento e produção:

```typescript
// environment.development.ts
export const environment = {
    production: false,
    apiUrl: 'http://localhost:8080/api'
};

// environment.production.ts
export const environment = {
    production: true,
    apiUrl: 'https://seu-servidor-producao.com/api'
};
```

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 👥 Autores

* **Marco Oliveira** - *Desenvolvedor* - [GitHub](https://github.com/marco-oliveira-s10)

## 🤝 Contribuindo

1. Fork o projeto
2. Crie sua branch de feature (`git checkout -b feature/NovaFuncionalidade`)
3. Commit suas mudanças (`git commit -m 'Adiciona nova funcionalidade'`)
4. Push para a branch (`git push origin feature/NovaFuncionalidade`)
5. Abra um Pull Request

---

⌨️ com ❤️ por [Marco Oliveira](https://github.com/marco-oliveira-s10) 😊