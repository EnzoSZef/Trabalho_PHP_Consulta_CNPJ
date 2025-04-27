# 📋 Projeto: Consulta de CNPJ via API da Receita Federal

Exemplo de consulta realizada com sucesso

---

## 👥 Integrantes
| Nome                          | RA               |
|-------------------------------|------------------|
| Vinicius Claudio Barbosa      | 0220482323008    |
| Enzo Stoque Zeferino          | 0220482413042    |
| Livea Mendes de Vasconcelos   | 0220482413047    |

---

## 🚀 Sobre o Projeto
Página web em PHP que consulta dados de empresas através do CNPJ utilizando a API pública da [ReceitaWS](https://receitaws.com.br). Desenvolvido para a disciplina de *Programação Web* do 3º semestre noturno de ADS da Fatec de Taquaritinga.

### Funcionalidades
- ✅ Validação de CNPJ (14 dígitos numéricos).
- ✅ Exibição organizada de dados cadastrais, atividades econômicas e contatos.
- ✅ Tratamento de erros (CNPJ inválido, falha na API, etc.).
- ✅ Interface responsiva e amigável.

---

## 🛠 Tecnologias
- *PHP* (Backend e integração com API)
- *HTML/CSS* (Frontend e estilização)
- *cURL* (Requisições HTTP)
- *Postman* (Testes iniciais da API)

---

## 📌 Como Executar

### Pré-requisitos
- Servidor web com PHP (XAMPP, WAMP ou similar).
- Extensão cURL habilitada no PHP.
- Conexão com internet.

### Passo a Passo
1. *Clone o repositório*:
   ```bash
   git clone https://github.com/seu-usuario/consulta-cnpj.git

2. *Coloque os arquivos no servidor*:
- Copie a pasta consulta-cnpj para o diretório htdocs (XAMPP) ou www (WAMP).
- Inicie o servidor: Abra o XAMPP/WAMP e inicie os serviços Apache e MySQL.
- Acesse a aplicação: No navegador, digite: http://localhost/consulta-cnpj.
- Para fazer uma consulta: Insira um CNPJ válido (ex: 00000000000191).
- Clique em Consultar para ver os resultados.

--- 

## ⚠ Observações Importantes

### Limitações da API:
- A ReceitaWS permite 3 consultas por minuto gratuitamente.
- Dados podem estar desatualizados dependendo da empresa.

### Validação:
- O campo CNPJ só aceita números e valida o formato (14 dígitos).

---

## 📄Licença
Este projeto é destinado exclusivamente para fins educacionais.
Desenvolvido para a disciplina de Programação Web - 3º Semestre noturno de ADS.# Trabalho_PHP_Consulta_CNPJ
