import api from "../api.js";

async function cadastrarCliente() {
  const form = document.getElementById("formCadastro");
  const formData = new FormData(form);
  

  const novoCliente = {
    cpf: formData.get("cpf"),
    nome: formData.get("nome"),
    email: formData.get("email"),
    senha: formData.get("senha"),
    telefone: formData.get("telefone"),
    logradouro: formData.get("logradouro"),
    numero: formData.get("numero"),
    bairro: formData.get("bairro"),
    cidade: formData.get("cidade"),
    estado: formData.get("estado"),
    cep: formData.get("cep"),
    complemento: formData.get("complemento") || null
  };

  try {
    const resposta = await api.post("/clientes/cadastro", novoCliente);
    alert("Cliente cadastrado com sucesso!");
    console.log("Resposta da API:", resposta);
    form.reset();
  } catch (erro) {
    console.error("Erro no cadastro:", erro);
    alert("Erro ao cadastrar cliente. Verifique os dados e tente novamente.");
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formCadastro");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      cadastrarCliente();
    });
  }
});