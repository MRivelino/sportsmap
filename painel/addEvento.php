<?php 
    require_once 'header.php'; 
    require_once 'conect.php'; 
?>

<style>
    .form-container {
        background-color: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 800px; /* Largura confortável */
        margin: 0 auto;
        margin-top: 10%;
        margin-bottom: 10%;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .form-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .form-header h1 {
        font-size: 2.5em;
        color: #004A6F;
        text-transform: uppercase;
    }

    .form-header p {
        font-size: 1.1em;
        color: #777;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 1.1em;
        margin-bottom: 8px;
        color: #333;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        font-size: 1em;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #fafafa;
        transition: border-color 0.3s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #4caf50;
        outline: none;
    }

    .form-group textarea {
        resize: none; /* Desativa o redimensionamento */
        min-height: 120px;
    }

    .form-row {
        display: flex;
        justify-content: space-between;
        gap: 20px; /* Espaçamento entre os campos */
    }

    .form-column {
        width: 48%; /* Largura ajustada para 48% */
    }

    .form-button {
        width: 100%;
        padding: 14px;
        font-size: 1.2em;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
    }

    .form-button:hover {
        background-color: #0056b3;
    }

    .form-button:active {
        background-color: #004085;
    }

    /* Estilo responsivo */
    @media (max-width: 768px) {
        .form-column {
            width: 100%; /* Em telas pequenas, os campos ocupam 100% da largura */
        }
    }
</style>

<body>
    <?php require_once 'nav.php'; ?>

    <div class="form-container">
        <div class="form-header">
            <h1>Criar Evento</h1>
            <p>Organize seu evento esportivo de forma simples e rápida.</p>
        </div>

        <form method="POST" action="criar_evento.php">
            <div class="form-group">
                <label for="eventName">Nome do Evento</label>
                <input type="text" id="eventName" name="eventName" placeholder="Ex: Futebol no parque" required>
            </div>

            <div class="form-group">
                <label for="sportType">Tipo de Esporte</label>
                <select id="sportType" name="sportType" required>
                    <option value="">Selecione o esporte</option>
                    <?php
                        // Consulta para pegar os esportes
                        $query_esportes = "SELECT * FROM tb_esporte";
                        $result_esportes = $con->query($query_esportes);

                        // Exibir esportes no select
                        while ($esporte = $result_esportes->fetch_assoc()) {
                            echo '<option value="' . $esporte['id_esporte'] . '">' . $esporte['nome'] . '</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="form-group form-row">
                <div class="form-column">
                    <label for="eventDate">Data do Evento</label>
                    <input type="date" id="eventDate" name="eventDate" required>
                </div>
                <div class="form-column">
                    <label for="eventTime">Hora do Evento</label>
                    <input type="time" id="eventTime" name="eventTime" required>
                </div>
            </div>

            <div class="form-group">
                <label for="eventLocation">Local do Evento</label>
                <select id="eventLocation" name="eventLocation" required>
                    <option value="">Selecione o local</option>
                    <?php
                        // Consulta para pegar os locais
                        $query_locais = "SELECT l.id_local, l.nome, b.nome AS bairro
                                         FROM tb_local l
                                         JOIN tb_bairros b ON l.bairro = b.id_bairro";
                        $result_locais = $con->query($query_locais);

                        // Exibir locais no select
                        while ($local = $result_locais->fetch_assoc()) {
                            echo '<option value="' . $local['id_local'] . '">' . $local['nome'] . ' - ' . $local['bairro'] . '</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="eventDescription">Descrição do Evento</label>
                <textarea id="eventDescription" name="eventDescription" placeholder="Fale um pouco mais sobre o evento..." required></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="form-button">Criar Evento</button>
                <button 
                    class="form-button" 
                    type="button" 
                    onclick="window.location.href='index.php';" 
                    style="margin-top: 20px;">
                    Voltar
                </button>
            </div>
        </form>
    </div>

    <?php require_once 'footer.php'; ?>
</body>
