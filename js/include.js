async function incluir(component, file, callback) {
    const elemento = document.querySelector(component);
    const html = await fetch(file).then(res => res.text());
    elemento.innerHTML = html;

    if (callback && typeof callback === "function") {
        callback();
    }
}