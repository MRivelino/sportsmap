<style>
    .tam{
        height: 600px !important;
        place-items: center !important; 
        display: grid;   
    }

    .sec2{
        padding: 7em 0 0 0 !important;
    }

    .add-event-wrapper {
        margin: 40px auto;
        text-align: center;
    }

    .add-event-circle {
        border: 4px solid #00aaff;
        border-radius: 50%;
        width: 100px;
        height: 100px;
        background-color: #00aaff;
        transition: background-color 0.4s ease, transform 0.3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

    .add-event-circle:hover {
        background-color: #0077cc;
        transform: scale(1.05);
    }

    .add-event-circle i {
        font-size: 42px;
        color: #ffffff;
        transition: transform 0.6s ease;
    }
</style>

<section class="ftco-section sec2" id="evento">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h2 class="mb-4">Eventos</h2>
            </div>
        </div>
    </div>
</section>

<section class="ftco-intro ftco-section ftco-no-pt">
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <?php
                require_once 'conect.php'; 

                // Verifica a conexão com o banco de dados
                if ($con->connect_error) {
                    die("Falha na conexão: " . $con->connect_error);
                }

                // Consulta para pegar nome, descrição e o esporte associado ao evento
                $sql = "SELECT 
                            e.id_evento, 
                            e.nome_evento, 
                            e.descricao, 
                            esp.nome AS nome_esporte, 
                            esp.esporte_imagem
                        FROM eventos e
                        JOIN tb_esporte esp ON e.id_esporte = esp.id_esporte";

                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    // Exibe todos os eventos
                    while($evento = $result->fetch_assoc()) {
                        ?>
                        <div class="col-md-4 text-center" style="margin-top: 50px;">
                            <div class="img tam" style="background-image: url('<?php echo $evento['esporte_imagem']; ?>');">
                                <div class="overlay"></div>
                                <h2><?php echo $evento['nome_evento']; ?></h2>
                                <p><?php echo $evento['descricao']; ?></p>
                                <p class="mb-0"><a href="evento.php?id=<?php echo $evento['id_evento']; ?>" class="btn btn-primary px-4 py-3">Ver evento</a></p>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "Nenhum evento encontrado!";
                }

                $con->close();
            ?>


            <div class="col-md-4 d-flex justify-content-center align-items-center">
                <div class="add-event-wrapper">
                    <a href="addEvento.php" class="add-event-circle" title="Adicionar Evento">
                        <i class="bi bi-calendar-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>