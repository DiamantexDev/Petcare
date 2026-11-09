import api from "../api.js";

async function listarAgendamentos() {
  const form = document.getElementById("formAgendamentos");
  const formData = new FormData(form);

  const data = formData.get("data");
  const idProfissional = formData.get("id_profissional");
  const cpfCliente = formData.get("cpf_cliente");
  const status = formData.get("status");

  const params = new URLSearchParams();
  if (data) params.append("data", data);
  if (idProfissional) params.append("idProfissional", idProfissional);
  if (cpfCliente) params.append("cpfCliente", cpfCliente);
  if (status) params.append("status", status);

  try {
    const resposta = await api.get(`/agendamentos?${params.toString()}`);

    const lista = document.getElementById("listaAgendamentos");
    lista.innerHTML = "";

    resposta.forEach(ag => {
      const li = document.createElement("li");
      li.textContent = `Cliente: ${ag.cliente}, Serviço: ${ag.servico}, Status: ${ag.status}`;
      lista.appendChild(li);
    });
  } catch (erro) {
    console.error("Erro ao listar agendamentos:", erro);
    alert("Não foi possível carregar os agendamentos.");
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formAgendamentos");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      listarAgendamentos();
    });
  }
});