import  api from "../api.js";

async function criarConsulta() {
  const form = document.getElementById("formConsulta");
  const formData = new FormData(form);

  const novaConsulta = {
    id_agendamento: parseInt(formData.get("id_agendamento")),
    diagnostico: formData.get("diagnostico"),
    medicacao: formData.get("medicacao") || null,
    peso_pet: parseFloat(formData.get("peso_pet"))
  };

  try {
    const resposta = await api.post("/consulta/criar", novaConsulta);
    alert("Consulta registrada com sucesso!");
    console.log("Resposta da API:", resposta);
    form.reset();
  } catch (erro) {
    console.error("Erro ao registrar consulta:", erro);
    alert("Erro ao registrar consulta. Verifique os dados e tente novamente.");
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formConsulta");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      criarConsulta();
    });
  }
});