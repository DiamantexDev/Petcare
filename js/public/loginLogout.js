function atualizarMenu() {
    const userTipo = localStorage.getItem("userTipo");
    const userCargo = localStorage.getItem("userCargo"); 

    const linkBanhoTosa = document.getElementById("linkBanhoTosa");
    const linkCadastroPet = document.getElementById("linkCadastroPet");
    const linkAreaCliente = document.getElementById("linkAreaCliente");
    const linkLogin = document.getElementById("linkLogin");
    const linkLogout = document.getElementById("linkLogout");
    const linkCadastro = document.getElementById("linkCadastro");
    const linkAreaFuncionario = document.getElementById("linkAreaFuncionario");
    const linkCadastroFuncionario = document.getElementById("linkCadastroFuncionario");
    const linkCadastroServico = document.getElementById("linkCadastroServico");
    const linkCriarConsulta = document.getElementById("linkCriarConsulta");

    const mobileBanhoTosa = document.getElementById("mobileBanhoTosa");
    const mobileCadastroPet = document.getElementById("mobileCadastroPet");
    const mobileAreaCliente = document.getElementById("mobileAreaCliente");
    const mobileLogin = document.getElementById("mobileLogin");
    const mobileLogout = document.getElementById("mobileLogout");
    const mobileCadastro = document.getElementById("mobileCadastro");

    [linkBanhoTosa, linkCadastroPet, linkAreaCliente, linkLogout, linkCadastroFuncionario, linkAreaFuncionario, linkCadastroServico, linkCriarConsulta].forEach(e => e.classList.add("hidden"));
    
    [mobileBanhoTosa, mobileCadastroPet, mobileAreaCliente, mobileLogout].forEach(e => e.classList.add("hidden"));

    linkLogin.classList.remove("hidden");
    mobileLogin.classList.remove("hidden");
    linkCadastro.classList.remove("hidden");
    mobileCadastro.classList.remove("hidden");

    if (!userTipo) return;

    if (userTipo === "cliente") {
        linkAreaCliente.classList.remove("hidden");
        mobileAreaCliente.classList.remove("hidden");
        linkBanhoTosa.classList.remove("hidden");
        mobileBanhoTosa.classList.remove("hidden");
        linkCadastroPet.classList.remove("hidden");
        mobileCadastroPet.classList.remove("hidden");
    }

    if (userTipo === "funcionario") {

        linkAreaFuncionario?.classList.remove("hidden");

        if (userCargo === "Administrador") {
            linkCadastroFuncionario?.classList.remove("hidden");
            linkCadastroServico?.classList.remove("hidden");
        }

        if (userCargo === "Veterinario") {
            linkCriarConsulta?.classList.remove("hidden");
        }
        
    }

    linkLogin.classList.add("hidden");
    mobileLogin.classList.add("hidden");
    linkCadastro.classList.add("hidden");
    mobileCadastro.classList.add("hidden");
    linkLogout.classList.remove("hidden");
    mobileLogout.classList.remove("hidden");
}

function logout() {
    localStorage.removeItem("authToken");
    localStorage.removeItem("userTipo");
    localStorage.removeItem("userCargo");
    localStorage.removeItem("userCpf");
    localStorage.removeItem("userId");

    window.location.href = "../index.html";
}

document.addEventListener("DOMContentLoaded", () =>{
    atualizarMenu();
});

