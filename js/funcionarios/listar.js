import api from "../api.js";

async function listarProfissionais() {
    try {
        const resposta = await api.get("/funcionarios/listar");
        const profissionais = resposta.data;

        const lista = document.getElementById("listaProfissional");
        lista.innerHTML = '<option value="">Automático</option>';

        profissionais.forEach(profissional => {
            const option = document.createElement("option");
            option.value = profissional.id_profissional;
            option.textContent = `${profissional.nome} - ${profissional.cargo}`;
            lista.appendChild(option);
        });

    } catch (err) {
        console.error("Erro ao carregar profissionais:", err);
        alert("Erro ao carregar profissionais.");
    }
}

document.addEventListener("DOMContentLoaded", () => {

    const selectServicos = document.getElementById("selectServicos");

    selectServicos.addEventListener("change", async (event) => {
        try {
            const categoria = event.target.selectedOptions[0].dataset.categoria;

            if (!categoria) return;

            const resposta = await api.get(`/funcionarios/por-categoria/${categoria}`);
            const profissionais = resposta.data;

            const lista = document.getElementById("listaProfissional");
            lista.innerHTML = '<option value="">Automático</option>';

            profissionais.forEach(profissional => {
                const option = document.createElement("option");
                option.value = profissional.id_profissional;
                option.textContent = `${profissional.nome} - ${profissional.cargo}`;
                lista.appendChild(option);
            });

        } catch (err) {
            console.error("Erro ao filtrar profissionais:", err);
            alert("Erro ao carregar profissionais compatíveis.");
        }
    });

    listarProfissionais();
});
