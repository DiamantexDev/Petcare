// 🔐 Verifica se o usuário está logado
export function verificarLogin() {
    const token = localStorage.getItem("authToken");

    if (!token) {
        window.location.href = "../login.html";
        return false;
    }

    return true;
}

// 🔐 Verifica tipo de usuário (cliente / funcionario)
export function permitirTipo(tipoPermitido) {
    const tipo = localStorage.getItem("userTipo");

    if (!tipo || tipo !== tipoPermitido) {
        window.location.href = "./erro/403.html";
        return false;
    }

    return true;
}

// 🔐 Verifica cargo específico (Administrador, Veterinário, etc.)
export function permitirCargo(cargoPermitido) {
    const cargo = localStorage.getItem("userCargo");

    if (!cargo || cargo !== cargoPermitido) {
        window.location.href = "./erro/403.html";
        return false;
    }

    return true;
}

// 🔐 Função completa que combina tudo
export function protegerPagina({ login = true, tipo = null, cargo = null } = {}) {

    // 1) Bloqueia quem não está logado
    if (login && !verificarLogin()) return;

    // 2) Bloqueia se o tipo não bate
    if (tipo && !permitirTipo(tipo)) return;

    // 3) Bloqueia se o cargo não bate
    if (cargo && !permitirCargo(cargo)) return;
}
