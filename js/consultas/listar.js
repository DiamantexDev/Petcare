import api from "../api.js";

async function listarConsultas() {
  const form = document.getElementById("formConsultas");
  const formData = new FormData(form);

  const data = formData.get("data");
  const idProfissional = formData.get("id_profissional");

  const params = new URLSearchParams();
  if (data) params.append("data", data);
  if (idProfissional) params.append("idProfissional", idProfissional);

  try {
    const resposta = await api.get(`/consulta?${params.toString()}`);

    const lista = document.getElementById("listaConsultas");
    lista.innerHTML = "";

    resposta.forEach(c => {
      const li = document.createElement("li");
      li.textContent = `Pet: ${c.nome_pet}, Diagnóstico: ${c.diagnostico}`;
      lista.appendChild(li);
    });
  } catch (erro) {
    console.error("Erro ao listar consultas:", erro);
    alert("Não foi possível carregar as consultas.");
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formConsultas");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      listarConsultas();
    });
  }
});