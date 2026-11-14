import { apiPut } from "./api.js";

async function atualizarCliente() {
  const form = document.getElementById("formAtualizar");
  const formData = new FormData(form);

  const nome = formData.get("nome");
  const telefone = formData.get("telefone");
  const cidade = formData.get("cidade");

  const dadosAtualizados = {};
  if (nome) dadosAtualizados.nome = nome;
  if (telefone) dadosAtualizados.telefone = telefone;
  if (cidade) dadosAtualizados.cidade = cidade;

  try {
    const resposta = await apiPut("/clientes/atualizar", dadosAtualizados);
    alert("Dados atualizados com sucesso!");
    console.log("Resposta da API:", resposta);
    form.reset();
  } catch (erro) {
    console.error("Erro ao atualizar:", erro);
    alert("Erro ao atualizar dados. Verifique e tente novamente.");
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formAtualizar");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      atualizarCliente();
    });
  }
});