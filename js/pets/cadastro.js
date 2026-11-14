import api from "../api.js";

async function cadastrarPet() {
  const form = document.getElementById("formPet");
  const formData = new FormData(form);

  const novoPet = {
    nome: formData.get("nome"),
    especie: formData.get("especie"),
    raca: formData.get("raca"),
    peso_atual: parseFloat(formData.get("peso_atual")),
    porte: formData.get("porte"),
    sexo: formData.get("sexo"),
    castrado: parseInt(formData.get("castrado")),
    data_nascimento: formData.get("data_nascimento"),
    observacoes_saude: formData.get("observacoes_saude")
  };

  try {
    const resposta = await api.post("/pet/cadastro", novoPet);
    console.log("Resposta da API:", resposta);

    alert("Pet cadastrado com sucesso!");
    form.reset();
  } catch (err) {
    console.error("Erro ao cadastrar pet:", err);
    alert(
      `Erro ao cadastrar pet:\n` +
      `${err.message || "Erro desconhecido"}`
    );
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formPet");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      cadastrarPet();
    });
  }
});