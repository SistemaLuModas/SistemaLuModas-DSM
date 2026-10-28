<?php
// PHP para gerar os cards da pesquisa e puxar os dados do Bb
include 'conexao.php';
if (isset($_GET['termo'])) {
    $termo = $connect->real_escape_string($_GET['termo']);
    $sql = "SELECT * FROM produtos WHERE nome LIKE '%$termo%' LIMIT 8";
    $result = $connect->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($produto = $result->fetch_assoc()) {
            $imagem = !empty($produto['imagem_url']) ? $produto['imagem_url'] : '';
            echo '
            <div class="col-sm-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 18px; overflow: hidden;">
                    <img src="' . htmlspecialchars($imagem) . '" class="card-img-top" alt="' . htmlspecialchars($produto['nome']) . '" style="height: 220px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold" style="font-size: 1.1rem; color: var(--texto);">' . htmlspecialchars($produto['nome']) . '</h5>
                        <p class="card-text text-muted" style="font-size: 0.9rem;">' . htmlspecialchars($produto['descricao']) . '</p>
                        <div class="mt-auto">
                            <span class="text-success fw-bold fs-5 d-block mb-2">R$ ' . number_format($produto['preco'], 2, ',', '.') . '</span>
                            <button class="btn btn-dark w-100 btnComprar"
                                style="border-radius: 30px; background-color: #43065a; border: none;"
                                data-id="' . $produto['id'] . '"
                                data-nome="' . htmlspecialchars($produto['nome']) . '"
                                data-preco="' . $produto['preco'] . '"
                                data-estoque="' . $produto['quantidade_estoque'] . '"
                                data-imagem="' . htmlspecialchars($imagem) . '">
                              <i class="bi bi-cart-plus"></i> Comprar
                            </button>
                        </div>
                    </div>
                </div>
            </div>';
        }
    } else {
        echo '<p class="text-center text-light mt-3">Nenhum produto encontrado.</p>';
    }
}
?> 