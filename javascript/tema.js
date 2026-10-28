(function () {
    var chaveTema = "lu-modas-tema";
    var raiz = document.documentElement;
    var temaSalvo = "light";

    try {
        temaSalvo = localStorage.getItem(chaveTema) || "light";
    } catch (erro) {
        console.warn("Não foi possível ler a preferência de tema salva.", erro);
        temaSalvo = "light";
    }

    function aplicarTema(tema) {
        var escuro = tema === "dark";
        raiz.classList.toggle("tema-escuro", escuro);
        raiz.dataset.theme = escuro ? "dark" : "light";
        raiz.setAttribute("data-bs-theme", escuro ? "dark" : "light");
    }

    function montarControle() {
        var lista = document.querySelector(".navbar .navbar-nav");
        if (!lista || lista.querySelector(".theme-toggle")) {
            return;
        }

        var item = document.createElement("li");
        item.className = "nav-item";

        var botao = document.createElement("button");
        botao.type = "button";
        botao.className = "btn btn-sm btn-outline-light theme-toggle";
        botao.addEventListener("click", function () {
            var novoTema = raiz.classList.contains("tema-escuro") ? "light" : "dark";
            aplicarTema(novoTema);
            atualizarBotao();

            try {
                localStorage.setItem(chaveTema, novoTema);
            } catch (erro) {
                console.warn("Não foi possível salvar a preferência de tema.", erro);
            }
        });

        function atualizarBotao() {
            var escuro = raiz.dataset.theme === "dark";
            botao.innerHTML = escuro
                ? '<i class="bi bi-sun-fill me-1" aria-hidden="true"></i> Modo claro'
                : '<i class="bi bi-moon-stars-fill me-1" aria-hidden="true"></i> Modo escuro';
            botao.setAttribute("aria-label", escuro ? "Ativar modo claro" : "Ativar modo escuro");
            botao.setAttribute("aria-pressed", escuro ? "true" : "false");
        }

        atualizarBotao();
        item.appendChild(botao);
        lista.appendChild(item);
    }

    aplicarTema(temaSalvo === "dark" ? "dark" : "light");

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", montarControle);
    } else {
        montarControle();
    }
})();
