import { apiGet } from "./api.js";

async function listarPets() {
  try {
    const pets = await apiGet("/pets/meus");

    const lista = document.getElementById("listaPets");
    lista.innerHTML = "";

    pets.forEach(pet => {
      const li = document.createElement("li");
      li.textContent = `Pet: ${pet.nome}, Raça: ${pet.raca}`;
      lista.appendChild(li);
    });
  } catch (erro) {
    console.error("Erro ao listar pets:", erro);
    alert("Não foi possível carregar os pets.");
  }
}

document.addEventListener("DOMContentLoaded", listarPets);