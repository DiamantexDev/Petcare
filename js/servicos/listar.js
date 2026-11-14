import api from "../api.js";

async function listarServicos() {
    try {
        const resposta = await api.get("/servicos");
        const servicos = resposta.data;

        const listaEsquerda = document.querySelector(".lista-servicos");
        listaEsquerda.innerHTML = ""; 

        servicos.forEach(servico => {
            const li = document.createElement("li");
            li.textContent = `${servico.nome_servico} - R$ ${servico.valor}`;
            listaEsquerda.appendChild(li);
        });

        const selectFormulario = document.getElementById("selectServicos");
        selectFormulario.innerHTML = '<option value="">Selecione o serviço</option>';

        servicos.forEach(servico => {
            const option = document.createElement("option");
            option.value = servico.id_servico;
            option.dataset.categoria = servico.categoria;
            option.textContent = `${servico.nome_servico}`;
            selectFormulario.appendChild(option);
        });

    } catch (erro) {
        console.error("Erro ao carregar serviços:", erro);
        alert("Não foi possível carregar os serviços.");
    }
}

document.addEventListener("DOMContentLoaded", () => {
    listarServicos();
});
