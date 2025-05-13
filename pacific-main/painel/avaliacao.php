<?php 
    include_once './conexao.php';
?>

<style>
    .more {
        margin-left: 35%;
        margin-top: 30%;
    }

    .circle {
        background-color: transparent;
        color: #00aaff;
        border: 3px solid #00aaff;
        border-radius: 50%;
        width: 90px;
        height: 90px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 50px;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease, background-color 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        outline: none;
    }

    .circle:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        border-color: #0099cc;
        background-color: #00aaff;
        color: #fff;
    }

    .circle:active {
        transform: translateY(2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .circle i {
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .circle:hover i {
        transform: scale(1.2);
        color: #fff;
    }

    :root{
        --amarelo: #ffcc00;
        --cinza: #cccccc;
    }

    .estrelas{
        text-align: center;
    }

    .estrelas .opcao{
        font-size: 40px;
        margin-top: 30px;
    }

    .estrelas input[type=radio]{
        display: none;
    }

    .estrelas label i.opcao.fa:before{
        content: '\f005';
        color: var(--amarelo);
        cursor: pointer;
    }

    .estrelas input[type=radio]:checked~label i.fa::before{
        color: var(--cinza);
    }

    .owl-dot.active{
        background-color: #00aaff !important;
    }

    .owl-dot,
.owl-dot:focus,
.owl-dot:active {
  background: rgba(94, 94, 94, 0.53) !important;
}

.owl-dot.active,
.owl-dot.active:focus,
.owl-dot.active:active {
  background-color: #00aaff !important;
  outline: none !important;
  box-shadow: none !important;
}

        :root{
            --amarelo: #ffcc00;
            --cinza: #cccccc;
        }

        .estrela-preenchida{
            color: var(--amarelo);
        }

        .estrela-vazia{
            color: var(--cinza);
        }

        .stars{
            display: flex;
            justify-content: center;
            grid-gap: 0.125rem;
            gap: 0.125rem;
            color: rgba(34, 197, 94, 1);
        }

        .star{
            display: flex;
            gap: 5px;
            font-size: 20px;
        }

        .name {
            margin-top: 0.25rem;
            font-size: 1.125rem;
            line-height: 1.75rem;
            font-weight: 600;
            color: rgba(55, 65, 81, 1);
        }

        .message {
            margin-top: 1rem;
            color: rgba(107, 114, 128, 1);
        }

        .overlay{
            background: #040e26 !important;
        }      
</style>

<section class="ftco-section testimony-section bg-bottom" id="avaliacao" style="background-image: url('./images/campo.jpeg'); background-attachment: fixed;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                <span class="subheading">Avaliações</span>
                <h2 class="mb-4">Avaliações de Usuários</h2>
            </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel">
                    <?php
                        $query_avaliacoes = "SELECT id, qtd_estrela, mensagem FROM avaliacoes ORDER BY id DESC";
                        $result_avaliacoes = $conn->prepare($query_avaliacoes);
                        $result_avaliacoes->execute();

                        while ($row_avaliacao = $result_avaliacoes->fetch(PDO::FETCH_ASSOC)) {
                            extract($row_avaliacao);
                    ?>
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div class="text">
                                    <p class="star">
                                        <?php
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $qtd_estrela) {
                                                    echo '<i class="estrela-preenchida fa-solid fa-star"></i>';
                                                } else {
                                                    echo '<i class="estrela-vazia fa-solid fa-star"></i>';
                                                }
                                            }
                                        ?>
                                    </p>
                                    <p class="mb-4"><?php echo htmlspecialchars($mensagem); ?></p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img" style="background-image: url('images/person_1.jpg')"></div>
                                        <div class="pl-3">
                                            <p class="name">Avaliação: <?php echo $id; ?></p>
                                            <span class="position">Marketing Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>

                    <div class="more">
                        <a href="tela-login/login.php" class="circle" title="Adicionar avaliação">
                            <i class="bi bi-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>






