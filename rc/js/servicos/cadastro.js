import api  from "../api.js";

async function cadastrarServico() {
  const form = document.getElementById("formServico");
  const formData = new FormData(form);

  const novoServico = {
    nome_servico: formData.get("nome"),
    valor: parseFloat(formData.get("valor")),
    categoria: formData.get("categoria"),
  };

  try {
    const resposta = await api.post("/servico/cadastro", novoServico);
    console.log("Resposta da API:", resposta);
    alert("Serviço cadastrado com sucesso!");
    form.reset();
  } catch (err) {
    console.error("Erro ao cadastrar serviço:", err);
    alert(
      `Erro ao cadastrar serviço:\n` +
      `${err.message || "Erro desconhecido"}`
    );
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formServico");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      cadastrarServico();
    });
  }
});