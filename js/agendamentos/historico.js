import api from "../api.js";

async function buscarHistoricoAgendamentos() {
  const form = document.getElementById("formHistorico");
  const formData = new FormData(form);

  const idPet = formData.get("id_pet");

  try {
    const resposta = await api.get(`/agendamentos/historico${idPet ? `?idPet=${idPet}` : ""}`);
    
    const lista = document.getElementById("listaHistorico");
    lista.innerHTML = "";

    resposta.forEach(item => {
      const li = document.createElement("li");
      li.textContent = `Serviço: ${item.servico}, Data: ${item.data_hora}`;
      lista.appendChild(li);
    });
  } catch (erro) {
    console.error("Erro ao buscar histórico:", erro);
    alert("Não foi possível carregar o histórico de agendamentos.");
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formHistorico");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      buscarHistoricoAgendamentos();
    });
  }
});