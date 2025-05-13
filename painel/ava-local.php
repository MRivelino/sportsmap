<?php 
    require_once 'conexao.php';
    require_once 'header.php';
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
          // prepara query de comentários só deste local
          $sql_coment = "
            SELECT 
              c.avaliacao AS qtd_estrela,
              c.texto    AS mensagem,
              u.nome     AS nome_usuario
              u.foto     AS foto-usuario
            FROM comentario c
            INNER JOIN usuario u 
              ON c.id_usuario = u.id_usuario, c.foto-usuario = u.foto-usuario
            WHERE c.tipo_comentario = 'local'
              AND c.id_local        = ?
            ORDER BY c.id_comentario DESC
          ";
          $stmt_com = $con->prepare($sql_coment);
          if (! $stmt_com) {
            die("Erro na preparação de comentários: ".$con->error);
          }
          $stmt_com->bind_param("i", $id_local);
          $stmt_com->execute();
          $res_com = $stmt_com->get_result();

          // loop de cada comentário
          while ($row = $res_com->fetch_assoc()) {
            $q = (int)$row['qtd_estrela'];
            $msg = htmlspecialchars($row['mensagem']);
            $user = htmlspecialchars($row['nome_usuario']);
          ?>
            <div class="item">
              <div class="testimony-wrap py-4">
                <div class="text">
                  <p class="star">
                    <?php
                      for ($i = 1; $i <= 5; $i++) {
                        echo $i <= $q
                          ? '<i class="estrela-preenchida fa-solid fa-star"></i>'
                          : '<i class="estrela-vazia fa-solid fa-star"></i>';
                      }
                    ?>
                  </p>
                  <p class="mb-4"><?php echo $msg; ?></p>
                  <div class="d-flex align-items-center">
                    <div class="user-img" style="background-image: url('<?= htmlspecialchars($user['foto']); ?>')"></div>
                    <div class="pl-3">
                      <p class="name"><?php echo $user; ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
          $stmt_com->close();
          ?>

          <div class="more">
            <button class="circle" data-toggle="modal" data-target="#modal-avaliacao2" title="Adicionar avaliação">
              <i class="bi bi-plus"></i>
            </button>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once 'footer.php'?>

<div class="modal fade" id="modal-avaliacao2" tabindex="-1" aria-labelledby="avaliacaoLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="avaliacaoLabel">Adicionar Avaliação</h5>
      </div>
      <form id="formAvaliacao" action="processa-ava.php" method="post">                 
      <div class="modal-body">

          <div class="mb-3">
            <div class="estrelas">
                <input type="radio" name="estrela" id="vazio" value="" checked>

                <label for="estrela_um"><i class="opcao fa"></i></label>
                <input type="radio" name="estrela" id="estrela_um" id="vazio" value="1">

                <label for="estrela_dois"><i class="opcao fa"></i></label>
                <input type="radio" name="estrela" id="estrela_dois" id="vazio" value="2">

                <label for="estrela_tres"><i class="opcao fa"></i></label>
                <input type="radio" name="estrela" id="estrela_tres" id="vazio" value="3">

                <label for="estrela_quatro"><i class="opcao fa"></i></label>
                <input type="radio" name="estrela" id="estrela_quatro" id="vazio" value="4">

                <label for="estrela_cinco"><i class="opcao fa"></i></label>
                <input type="radio" name="estrela" id="estrela_cinco" id="vazio" value="5">
            </div>
          </div>

          <input type="hidden" name="id_local" value="<?= htmlspecialchars($id_local) ?>">


          <div class="mb-3">
            <label for="comentario" class="form-label">Comentário:</label>
            <textarea class="form-control" id="comentario" rows="3" name="mensagem" placeholder="Escreva sua avaliação aqui..." required></textarea>
          </div>

      </div>    

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary color" data-dismiss="modal">Cancelar</button>
        <button type="submit" form="formAvaliacao" class="btn btn-primary color">Enviar Avaliação</button>
      </div>
      </form>
    </div>
  </div>
</div>
