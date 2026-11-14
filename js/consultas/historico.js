import api from "../api.js";

async function buscarHistoricoConsultas() {
  const form = document.getElementById("formHistorico");
  const formData = new FormData(form);

  const idPet = formData.get("id_pet");

  try {
    const resposta = await api.get(`/consulta/historico${idPet ? `?idPet=${idPet}` : ""}`);

    const lista = document.getElementById("listaConsultas");
    lista.innerHTML = "";

    resposta.forEach(c => {
      const li = document.createElement("li");
      li.textContent = `Diagnóstico: ${c.diagnostico}, Peso: ${c.peso_pet} kg`;
      lista.appendChild(li);
    });
  } catch (erro) {
    console.error("Erro ao buscar histórico:", erro);
    alert("Não foi possível carregar o histórico de consultas.");
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formHistorico");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      buscarHistoricoConsultas();
    });
  }
});