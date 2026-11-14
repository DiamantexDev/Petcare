import api from "./api.js";

async function login() {
  const form = document.getElementById("formLogin");
  const formData = new FormData(form);

  const credenciais = {
    email: formData.get("email"),
    senha: formData.get("senha")
  };

  try {
    const resposta = await api.post("/login", credenciais);

    const dados = resposta.data;

    localStorage.setItem("authToken", dados.token);
    localStorage.setItem("userTipo", dados.tipo);

    if (dados.tipo === "cliente") {
      localStorage.setItem("userCpf", dados.cpf);
      alert("Login realizado como cliente!");
      window.location.href = "../pages/areaCliente.html";
    }

    if (dados.tipo === "funcionario") {
      localStorage.setItem("userId", dados.id);
      localStorage.setItem("userCargo", dados.cargo);
      alert("Login realizado como funcionário!");
      window.location.href = "../pages/areaFuncionario.html";
    }

  } catch (erro) {
    console.error("Erro no login:", erro);
    alert("Email ou senha inválidos. Tente novamente.");
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formLogin");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      login();
    });
  }
});
