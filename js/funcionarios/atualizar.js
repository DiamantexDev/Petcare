import { apiPut } from "../api.js";

async function atualizarFuncionario() {
  const form = document.getElementById("formFuncionario");
  const formData = new FormData(form);

  const id_profissional = formData.get("id_profissional");

  const dadosAtualizados = {
    nome: formData.get("nome"),
    email: formData.get("email"),
    cargo: formData.get("cargo"),
    crmv: formData.get("crmv") || null
  };

  try {
    const resposta = await apiPut(`/funcionarios/atualizar/${id_profissional}`, dadosAtualizados);
    alert("Funcionário atualizado com sucesso!");
    console.log("Resposta da API:", resposta);
    form.reset();
  } catch (erro) {
    console.error("Erro ao atualizar:", erro);
    alert("Erro ao atualizar funcionário. Verifique os dados e tente novamente.");
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formFuncionario");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      atualizarFuncionario();
    });
  }
});