import api from "../api.js";

async function listarMeusPets() {
  try {
    const resposta = await api.get("/pets/meus");
    const pets = resposta.data; 
    
    const lista = document.getElementById("listaPets");
    lista.innerHTML = '<option value="">Selecione o pet</option>';;

    pets.forEach(pet => {
      const option = document.createElement("option");
      option.value = pet.id_pet
      option.textContent = `${pet.nome} (${pet.raca})`;
      lista.appendChild(option);
    });
  } catch (err) {
    console.error("Erro ao listar pets:", err);
    alert("Erro ao carregar seus pets.");
  }
}

document.addEventListener("DOMContentLoaded", () => {
    listarMeusPets();
});