import { apiGet } from "../api.js";

async function listarTodosPets() {
  try {
    const pets = await apiGet("/pets/todos");
    const lista = document.getElementById("listaTodosPets");
    lista.innerHTML = "";

    pets.forEach(pet => {
      const li = document.createElement("li");
      li.textContent = `ID: ${pet.id}, Nome: ${pet.nome}, Tutor: ${pet.nome_cliente}`;
      lista.appendChild(li);
    });
  } catch (err) {
    console.error("Erro ao listar todos os pets:", err);
    alert("Erro ao carregar pets.");
  }
}