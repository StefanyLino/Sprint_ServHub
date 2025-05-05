// script.js

const websiteData = {
    "pages": [
      {
        "filename": "cadastro-empresa.html",
        "title": "Cadastro Empresa",
        "description": "Página de cadastro de empresa."
      },
      {
        "filename": "cadastro-funcionario.html",
        "title": "Cadastro Funcionário",
        "description": "Página de cadastro de funcionário."
      },
      {
        "filename": "cadastro.html",
        "title": "Cadastro",
        "description": "Página de cadastro de novos usuários.",
        "fields": [
          {"label": "Nome", "type": "text", "id": "nome", "name": "nome", "placeholder": "Digite seu nome", "required": true},
          {"label": "E-mail", "type": "email", "id": "email", "name": "email", "placeholder": "Digite seu e-mail", "required": true},
          {"label": "Telefone", "type": "tel", "id": "telefone", "name": "telefone", "placeholder": "Digite seu telefone", "required": true},
          {"label": "Senha", "type": "password", "id": "senha", "name": "senha", "placeholder": "Digite sua senha", "required": true},
          {"label": "Confirme sua senha", "type": "password", "id": "confirmar-senha", "name": "confirmar-senha", "placeholder": "Digite sua senha novamente", "required": true}
        ],
        "buttons": [
          {"type": "submit", "text": "Cadastrar"}
        ],
        "links": [
          {"href": "index.html", "text": "Voltar"}
        ]
      },
      {
        "filename": "homepage-admin.html",
        "title": "Homepage Admin",
        "description": "Página inicial do administrador."
      },
      {
        "filename": "homepage.html",
        "title": "Homepage",
        "description": "Página inicial geral."
      },
      {
        "filename": "index.html",
        "title": "Login",
        "description": "Página de login de usuários.",
        "fields": [
          {"label": "Email", "type": "email", "id": "email", "name": "email", "required": true},
          {"label": "Senha", "type": "password", "id": "senha", "name": "senha", "required": true}
        ],
        "buttons": [
          {"type": "submit", "text": "Entrar"}
        ],
        "links": [
          {"href": "cadastro.html", "text": "Cadastre-se"}
        ]
      },
      {
        "filename": "recuperar-senha.html",
        "title": "Recuperar Senha",
        "description": "Página para recuperação de senha.",
        "fields": [
          {"label": "E-mail", "type": "email", "id": "email", "name": "email", "placeholder": "Digite aqui...", "required": true},
          {"label": "Nome", "type": "text", "id": "nome", "name": "nome", "placeholder": "Digite aqui...", "required": true},
          {"label": "Nova Senha", "type": "password", "id": "nova-senha", "name": "nova-senha", "placeholder": "Digite aqui...", "required": true},
          {"label": "Confirmação de Senha", "type": "password", "id": "confirmar-senha", "name": "confirmar-senha", "placeholder": "Digite aqui...", "required": true}
        ],
        "buttons": [
          {"type": "submit", "text": "Enviar"}
        ],
        "links": [
          {"href": "index.html", "text": "Sair"}
        ]
      },
      {
        "filename": "senha-alterada.html",
        "title": "Senha Alterada",
        "description": "Página de confirmação de senha alterada.",
        "buttons": [
          {"type": "button", "text": "Voltar", "link": "index.html"}
        ]
      },
      {
        "filename": "verificar-codigo.html",
        "title": "Verificação de Código",
        "description": "Página para verificar o código enviado por e-mail.",
        "fields": [
          {"label": "Digite o Código", "type": "text", "id": "codigo", "name": "codigo", "placeholder": "Digite aqui...", "required": true}
        ],
        "buttons": [
          {"type": "submit", "text": "Enviar"}
        ],
        "links": [
          {"href": "index.html", "text": "Voltar"}
        ]
      }
    ],
    "style": {
      "body": {
        "fontFamily": "Arial, sans-serif",
        "backgroundColor": "#f0f2f5",
        "margin": "0",
        "padding": "0"
      },
      ".container": {
        "width": "100%",
        "maxWidth": "400px",
        "margin": "60px auto",
        "padding": "20px",
        "background": "white",
        "borderRadius": "10px",
        "boxShadow": "0 4px 8px rgba(0,0,0,0.1)"
      },
      "h1": {
        "textAlign": "center"
      },
      ".form": {
        "display": "flex",
        "flexDirection": "column"
      },
      "label": {
        "marginTop": "10px"
      },
      "input": {
        "padding": "10px",
        "marginTop": "5px",
        "borderRadius": "5px",
        "border": "1px solid #ccc"
      },
      "button": {
        "marginTop": "20px",
        "padding": "10px",
        "backgroundColor": "#4CAF50",
        "border": "none",
        "color": "white",
        "borderRadius": "5px",
        "cursor": "pointer"
      },
      "button:hover": {
        "backgroundColor": "#45a049"
      },
      "a": {
        "color": "#4CAF50"
      }
    }
  };
  
  // Exemplo de como você pode usar os dados em JavaScript
  
  // Função para gerar um menu de navegação
  function generateNavigation() {
    const navContainer = document.createElement('nav');
    const homepageLink = document.createElement('a');
    homepageLink.href = 'index.html';
    homepageLink.textContent = 'Início';
    navContainer.appendChild(homepageLink);
  
    websiteData.pages.forEach(page => {
      if (page.filename !== 'index.html') {
        const link = document.createElement('a');
        link.href = page.filename;
        link.textContent = page.title;
        navContainer.appendChild(link);
      }
    });
  
    document.body.insertBefore(navContainer, document.querySelector('.container'));
  }
  
  // Exemplo de como acessar informações de uma página específica
  const cadastroPage = websiteData.pages.find(page => page.filename === 'cadastro.html');
  if (cadastroPage) {
    console.log(`Título da página de cadastro: ${cadastroPage.title}`);
    console.log(`Descrição da página de cadastro: ${cadastroPage.description}`);
    console.log(`Campos do formulário de cadastro:`, cadastroPage.fields);
  }
  
  // Exemplo de como aplicar estilos dinamicamente (simples)
  function applyStyles() {
    const bodyElement = document.body;
    const containerElement = document.querySelector('.container');
    const h1Elements = document.querySelectorAll('h1');
    const linkElements = document.querySelectorAll('a');
    const buttonElements = document.querySelectorAll('button');
  
    if (bodyElement) {
      bodyElement.style.fontFamily = websiteData.style.body.fontFamily;
      bodyElement.style.backgroundColor = websiteData.style.body.backgroundColor;
      bodyElement.style.margin = websiteData.style.body.margin;
      bodyElement.style.padding = websiteData.style.body.padding;
    }
  
    if (containerElement) {
      containerElement.style.width = websiteData.style['.container'].width;
      containerElement.style.maxWidth = websiteData.style['.container'].maxWidth;
      containerElement.style.margin = websiteData.style['.container'].margin;
      containerElement.style.padding = websiteData.style['.container'].padding;
      containerElement.style.backgroundColor = websiteData.style['.container'].background;
      containerElement.style.borderRadius = websiteData.style['.container'].borderRadius;
      containerElement.style.boxShadow = websiteData.style['.container'].boxShadow;
    }
  
    h1Elements.forEach(h1 => {
      h1.style.textAlign = websiteData.style.h1.textAlign;
    });
  
    linkElements.forEach(link => {
      link.style.color = websiteData.style.a.color;
    });
  
    buttonElements.forEach(button => {
      button.style.marginTop = websiteData.style.button.marginTop;
      button.style.padding = websiteData.style.button.padding;
      button.style.backgroundColor = websiteData.style.button.backgroundColor;
      button.style.border = websiteData.style.button.border;
      button.style.color = websiteData.style.button.color;
      button.style.borderRadius = websiteData.style.button.borderRadius;
      button.style.cursor = websiteData.style.button.cursor;
  
      button.addEventListener('mouseover', () => {
        button.style.backgroundColor = websiteData.style['button:hover'].backgroundColor;
      });
  
      button.addEventListener('mouseout', () => {
        button.style.backgroundColor = websiteData.style.button.backgroundColor;
      });
    });
  }
  
  // Chame as funções quando a página carregar
  document.addEventListener('DOMContentLoaded', () => {
    // Se você quiser gerar um menu dinamicamente, descomente a linha abaixo
    // generateNavigation();
  
    // Se você quiser aplicar os estilos via JS (substituindo o style.css), descomente a linha abaixo
    // applyStyles();
  });