import api from "../api.js";

async function cadastrarFuncionario() {
  const form = document.getElementById("formFuncionario");
  const formData = new FormData(form);

  const novoFuncionario = {
    nome: formData.get("nome"),
    email: formData.get("email"),
    senha: formData.get("senha"),
    cargo: formData.get("cargo"),
    crmv: formData.get("crmv") || null
  };

  try {
    const resposta = await api.post("/funcionarios/cadastro", novoFuncionario);

    alert("Funcionário cadastrado com sucesso!");
    console.log("Resposta da API:", resposta);
    form.reset();
  } catch (erro) {
    console.error("Erro no cadastro:", erro);
    alert("Erro ao cadastrar funcionário. Verifique os dados e tente novamente.");
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formFuncionario");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      cadastrarFuncionario();
    });
  }
});