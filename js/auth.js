export function protegerPagina(tipoNecessario) {
  const userTipo = localStorage.getItem("userTipo");

  if (!userTipo) {
    alert("Você precisa estar logado!");
    window.location.href = "../login.html";
    return;
  }

  if (userTipo !== tipoNecessario) {
    alert("Acesso não autorizado!");
    window.location.href = "../login.html";
  }
}

export function logout() {
  localStorage.clear();
  window.location.href = "../login.html";
}
