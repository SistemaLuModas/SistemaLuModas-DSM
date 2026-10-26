function EnviarParaOZap(){
    // numero para qual a mensaegem vai ser enviada, se quiser mudar e so alterar o numero mas usando o mesmo formato
    let numero = "5511958904493";
    // se o carrinho estiver vazio e a pessoa clica em enviar vai aparecer esse alert e vai returna
    if (carrinho.length === 0){
        Swal.fire({
            icon: "warning",
            title: "Carrinho vazio!",
            text: "Adicione produtos antes de finalizar a compra.",
            background: "#2b1b36",
            color: "#F4F4F4"
        });
        return;
    }
    // comeco da mensagem , texto padrao puxando os dados do cliente atravez do objeto criado em cada script de cada catalogo
    let mensagem = `*NOVO PEDIDO - LU MODAS*\n`;
    mensagem += `-----------------------------------------------------------\n`;
    mensagem += `*DADOS DO CLIENTE:* \n`;
    mensagem += `Nome: ${dadosCliente.nome} \n`;
    mensagem += `Email: ${dadosCliente.email} \n`;
    mensagem += `-----------------------------------------------------------\n`;
    mensagem += `*Itens do pedido:*\n\n`;
    let totalFinal = 0;
    // aqui vai adicionando os items a cada loop
    carrinho.forEach((item, index) => {
        let subtotal = item.preco * item.quantidade;
        totalFinal += subtotal;
        mensagem += `*${index + 1}. ${item.nome}*\n`;
        mensagem += `Qtd: ${item.quantidade}x \n`;
        mensagem += `Subtotal: R$ ${subtotal.toFixed(2)}\n\n`;
    });
    mensagem += `-----------------------------------------------------------\n`
    mensagem += `_VALOR TOTAL DO PEDIDO:_ *${totalFinal.toFixed(2)}*\n\n`;
    mensagem += `_Pedido Realizado através o site Oficial_`;
    // de forma resumida comprime toda a mensagem em uma so, mensagem formatda
    let mensagemFormatada = encodeURIComponent(mensagem);
    // manipula a url do whatsap, onde o numero sempre e o numero que a mensagem vai, e o text e a mensagem em si
    let whatsapURL = `https://wa.me/${numero}?text=${mensagemFormatada}`;
    // abre outra janela atravez da url formatada
    window.open(whatsapURL, "_blank");
}
let btnFinalizar = document.querySelector('#btnFinalizarCompra');
if (btnFinalizar){
    btnFinalizar.addEventListener('click', EnviarParaOZap);
} 