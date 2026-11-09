import api from "../api.js";

async function criarAgendamento(e) {
  e.preventDefault();

  const id_pet = document.getElementById("listaPets").value;
  const id_servico = document.getElementById("selectServicos").value;
  const id_profissional = document.getElementById("listaProfissional").value || null;
  const data = document.getElementById("data").value;
  const hora = document.getElementById("hora").value;
  const observacoes = document.getElementById("notes").value;

  const data_hora = `${data} ${hora}`;

  const novoAgendamento = {
    id_pet,
    id_servico,
    data_hora,
    id_profissional,
    observacoes
  };

  try {
    const resposta = await api.post("/agendamento/criar", novoAgendamento);
    alert("Agendamento criado com sucesso!");
    console.log("Resposta da API:", resposta);
    document.getElementById("formAgendamento").reset();
  } catch (erro) {
    console.error("Erro ao criar agendamento:", erro);
    alert("Erro ao criar agendamento. Verifique os dados e tente novamente.");
  }
}

document.getElementById("formAgendamento").addEventListener("submit", criarAgendamento);