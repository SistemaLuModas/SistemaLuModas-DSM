let inputPesquisa = document.querySelector('#inputPesquisa');
let resultadoPesquisa = document.querySelector('#resultadoPesquisa');

if (inputPesquisa) {
    // o keyup faz uma especie de pesquisa a cada tecla clicada no array ou string
    inputPesquisa.addEventListener('keyup', function() {

        // trim remove espacos brancos etc e guarda no termo
        let termo = inputPesquisa.value.trim();
        // se estiver vazio deixa o input vazio para n ficar espaco atoa
        if (termo === "") {

            resultadoPesquisa.innerHTML = "";
            return;

        }
        // chama o pesquisa.php
        fetch('./PHP/pesquisa.php?termo=' + encodeURIComponent(termo))
            // pega a resposta e converte em html
            .then(response => response.text())

            // mete dentro do resultado pesquisa
            .then(html => {
                resultadoPesquisa.innerHTML = html;

            })
            // se tiver algum erro mostra no console
            .catch(error => console.error('Erro na pesquisa:', error));
    });
}