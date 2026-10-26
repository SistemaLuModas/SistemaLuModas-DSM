// persiste os dados do carrinho
let carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
let quantidade = 0;


// responsavel por abrir ou fechar o carrinho 
// usando display none para fechar e  display block/flex para abrir, adicionando class diretamente pelo css e js 
let carrinhoOverlay = document.querySelector('#carrinhoOverlay');
let carrinhoIcone = document.querySelector('#btnCarrinho');
let gavetaCarrinho = document.querySelector('#carrinhoGaveta');
let fecharCarrinho = document.querySelector('#btnFecharCarrinho');

let itensCarrinho = document.querySelector('#itensCarrinho');
let valorTotal = document.querySelector('#carrinhoTotal');

function abrirCarrinho() {
    gavetaCarrinho.classList.add('ativo');
    carrinhoOverlay.classList.add('ativo');
}

function fecharCarrinhos() {
    gavetaCarrinho.classList.remove('ativo');
    carrinhoOverlay.classList.remove('ativo');
}

if (carrinhoIcone) {
    carrinhoIcone.addEventListener('click', abrirCarrinho);
}

if (fecharCarrinho) {
    fecharCarrinho.addEventListener('click', fecharCarrinhos)
}

if (carrinhoOverlay) {
    carrinhoOverlay.addEventListener('click', fecharCarrinhos)
}

function atualizarCarrinho() {
    if (!itensCarrinho) {
        return
    }

    itensCarrinho.innerHTML = " ";
    // se o carrinho tiver vazio ele alterar o html pelo inner
    if (carrinho.length === 0) {
        itensCarrinho.innerHTML = '<p class="text-center text-muted my-4">O seu carrinho está vazio.</p>';
        if (valorTotal) {
            valorTotal.textContent = 'R$ 0,00';
        }
        return;
    }

    let totalGeral = 0;

    // percorre o item atual do loop, e o indice dele
    carrinho.forEach((item, index) => {
        let precoProduto = parseFloat(item.preco);
        precoProduto = precoProduto * item.quantidade
        totalGeral += precoProduto;

        // manipula o camihno da imagem, para ela aparecer no catalogo e no index
        let caminhoImg = item.imagem_url || item.imagem || item.foto || item.caminho || '';
        caminhoImg = caminhoImg.replace('../', ''); 

        if (window.location.pathname.includes('/PAGINAS/')) {
            caminhoImg = '../' + caminhoImg;
        }

        // cira a div de forma dinamica pelo createElement
        let itemDiv = document.createElement('div');
        itemDiv.classList.add('d-flex', 'align-items-center', 'mb-3', 'pb-3', 'border-bottom');
        
        // aqui cria os botoes de editar do carrinho de forma dinamica, alem da imagem nome etc 
        itemDiv.innerHTML = `
            <img src="${caminhoImg}" alt="${item.nome}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px;" class="me-3">
            <div class="flex-grow-1">
                <h5 class="mb-0 text-truncate" style="max-width: 170px;">${item.nome}</h5>
                <small class="text-success fw-bold">R$ ${item.preco}</small>
                <small class="text-success fw-bold">Qtd:  ${item.quantidade}</small>
            </div>
            
            <button class="btn btn-sm btn-outline-danger btnAdicionar" data-index="${index}" title="Aumentar Quantidade">
                <i class="bi bi-plus-circle"></i>
            </button>
            <button class="btn btn-sm btn-outline-danger btnDiminuir" data-index="${index}" title="Diminuir Quantidade">
                <i class="bi bi-dash-circle"></i>
            </button>
            <button class="btn btn-sm btn-outline-danger btnRemover" data-index="${index}" title="Remover item">
                <i class="bi bi-trash"></i>
            </button>
        `;
        // adiicona a div a estrututra do carrinho
        itensCarrinho.appendChild(itemDiv);
    });

    if (valorTotal) {
        valorTotal.textContent = `R$ ${totalGeral.toFixed(2).replace('.', ',')}`
    }
}

document.addEventListener('click', function (clique) {
    let btn = clique.target.closest('.btnComprar')

    if (btn) {
        clique.preventDefault();
        let produtoCLicado = null;

        // tive que criar isso pois no index os cards de catalogo nao existem, logo tive que criar pelo pesquisa.php os dados que o botao precisa puxar quando esta no index
        if (btn.dataset.nome){
            produtoCLicado = {
                id : btn.dataset.id,
                nome : btn.dataset.nome,
                preco : parseFloat(btn.dataset.preco),
                quantidade_estoque: parseInt(btn.dataset.estoque),
                imagem_url: btn.dataset.imagem
            }
        }
        // verifica como o array veio, se veio certo ele transforma a posicao no id do produto, caso ele venha do index
        else if (typeof produtosJS !== 'undefined' && produtosJS[Number(btn.dataset.id)]){
            let posicao = Number(btn.dataset.id);
            produtoCLicado = produtosJS[posicao]
        }

        // verifica se tudo foi valido, se nao, imprime esse erro no console
        if (!produtoCLicado) {
            console.error("Erro: Não foi possível obter os dados do produto clicado.");
            return;
        }

        // verifica se o produto existe no carrinho, se existir ele atribui o produto a quantidade, se estouruar a quantiadde de estoque ele cai no primeiro if, que barra
        let produtoDentroDoCarrinho = carrinho.find((p) => Number(p.id) === Number(produtoCLicado.id));
        let quantidadeNoCarrinho = 0;

        if (produtoDentroDoCarrinho){
            quantidadeNoCarrinho = produtoDentroDoCarrinho.quantidade;
        }

        if (quantidadeNoCarrinho >= Number(produtoCLicado.quantidade_estoque)){
            Swal.fire({
                toast: true,
                position: "bottom-end",
                icon: "warning",
                title: "Quantidade máxima em estoque atingida!",
                showConfirmButton: false,
                timer: 2000,
                customClass: { popup: 'meu-toast-personalizado' },
                background: "#2b1b36",
                color: "#F4F4F4",
                iconColor: "#d6bcfa"
            });
            return;
        }
        
        if (produtoDentroDoCarrinho) {
            produtoDentroDoCarrinho.quantidade++;
            Swal.fire({
                toast: true,
                position: "bottom-end",
                icon: "success",
                title: `A quantidade do Produto: ${produtoCLicado.nome} foi atualizada!`,
                showConfirmButton: false,
                timer: 2000,
                customClass: { popup: 'meu-toast-personalizado' },
                background: "#2b1b36",
                color: "#F4F4F4",
                iconColor: "#d6bcfa"
            });
        } else {
            // copia todos os utens do produto clicado (...) e coloca no novoItem
            let novoItem = { ...produtoCLicado, quantidade: 1 };
            carrinho.push(novoItem);
            Swal.fire({
                toast: true,
                position: "bottom-end",
                icon: "success",
                title: `${produtoCLicado.nome} foi adicionado ao carrinho!`,
                showConfirmButton: false,
                timer: 2000,
                customClass: { popup: 'meu-toast-personalizado' },
                background: "#2b1b36",
                color: "#F4F4F4",
                iconColor: "#d6bcfa"
            });
        }

        salvarDados();
        atualizarCarrinho();
    }
})

// ouve todos os clicks de uma vez se eles ocorrerem
document.addEventListener('click', (clique) => {
    let btnGeral = clique.target.closest('.btnAdicionar, .btnDiminuir, .btnRemover')
    if (!btnGeral) return;

    let posicao = Number(btnGeral.dataset.index);
    let itemCarrinho = carrinho[posicao]; 

    // botao de remover
    if (btnGeral.classList.contains('btnRemover')) {
        carrinho.splice(posicao, 1);
    }
    else if (btnGeral.classList.contains('btnAdicionar')) {

        // ve se ja atingiu o limite de estoque
        if (itemCarrinho.quantidade >= itemCarrinho.quantidade_estoque) {
            Swal.fire({
                toast: true,
                position: "bottom-end",
                icon: "warning",
                title: "Quantidade máxima em estoque atingida!",
                showConfirmButton: false,
                timer: 1200,
                customClass: { popup: 'meu-toast-personalizado' },
                background: "#2b1b36",
                color: "#F4F4F4",
                iconColor: "#d6bcfa"
            });
            return;
        }
        itemCarrinho.quantidade++;
    }
    else if (btnGeral.classList.contains('btnDiminuir')){
        itemCarrinho.quantidade--;
            if (itemCarrinho.quantidade < 1){
            // remove da array, onde ele pega o indice da vez e remove so 1 elemento, se o produto tiver menor que 1
            carrinho.splice(posicao, 1);
            }
    }

    salvarDados();
    atualizarCarrinho();
})

// funcao para persistri os dados
function salvarDados() {
    localStorage.setItem('carrinho', JSON.stringify(carrinho));
}

// carrega o carrinho quando a pagina abre
document.addEventListener('DOMContentLoaded', () => {
    atualizarCarrinho();
});