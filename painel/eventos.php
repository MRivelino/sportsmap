<?php require_once 'header.php'; require_once 'nav.php';?>
    <style>
        /* Reset de margens e padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f3f3f3; /* Fundo sólido cinza claro */
            color: #333;
        }

        /* Container principal */
        .event-details-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        /* Largura fixa para o conteúdo */
        .event-content {
            width: 100%;
            max-width: 960px; /* Largura fixa */
            padding: 20px;
        }

        /* Imagem do evento */
        .event-image {
            margin-top: 50px;
            width: 90%;
            height: 400px;
            object-fit: cover;
            border-bottom: 4px solid #ddd;
            background-color: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      background-position: center 20%; /* Centraliza a imagem no contêiner */
    background-size: cover;
        }

        /* Título e descrição do evento */
        .event-header {
            padding: 20px;
            text-align: center;
            color: #1e3d58; /* Cor do título */
        }

        .event-header h2 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .event-header p {
            font-size: 1.1em;
            color: #555;
        }

        /* Informações do evento */
        .event-info {
            display: flex;
            justify-content: space-between;
            width: 100%;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Fundo semi-transparente */
            margin-top: 20px;
            border-radius: 8px;
        }

        .event-info div {
            flex-basis: 30%;
            text-align: center;
        }

        .event-info div span {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .event-info div p {
            color: #777;
            font-size: 1.1em;
        }

        /* Descrição do evento */
        .event-description {
            padding: 20px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8); /* Fundo semi-transparente */
            margin-top: 20px;
            border-radius: 8px;
        }

        .event-description p {
            font-size: 1.2em;
            color: #444;
            line-height: 1.6;
        }

        /* Mapa */
        .event-map {
            width: 100%;
            height: 400px;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
        }

        .event-map iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* Botão de Confirmar Presença */
        .rsvp-button {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            font-size: 1.1em;
            color: #fff;
            background-color: #1e3d58;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .rsvp-button:hover {
            background-color: #3e5d7e;
        }

        /* Contador de presença */
        .counter {
            margin-top: 20px;
            font-size: 1.2em;
            color: #444;
        }
    </style>
</head>
<body>

    <div class="event-details-container">
        <!-- Container com largura fixa de 960px -->
        <div class="event-image img" style="background-image: url('https://estudenapuc.pucpr.br/pos-graduacao/wp-content/uploads/2024/11/Futebol-da-Formacao-a-Competicao.jpg');"></div>
        
        <div class="event-content">
            <!-- Imagem do evento -->

            <!-- Cabeçalho do evento -->
            <div class="event-header">
                <h2>Futebol no Parque</h2>
                <p><strong>15 de Maio, 14:00</strong></p>
            </div>

            <!-- Informações do evento -->
            <div class="event-info">
                <div>
                    <span>Local</span>
                    <p>Parque Central</p>
                </div>
                <div>
                    <span>Tipo</span>
                    <p>Futebol</p>
                </div>
                <div>
                    <span>Participantes</span>
                    <p id="participant-count">30 Pessoas</p>
                </div>
            </div>

            <!-- Descrição do evento -->
            <div class="event-description">
                <p>Venha praticar futebol no Parque Central. Um evento para todos os níveis de habilidade, onde você pode se divertir e fazer novas amizades. Traga seu espírito esportivo e seu equipamento!</p>
            </div>

            <h2 style="margin: 50px; text-align:center;">Local</h2>
            <!-- Mapa interativo -->
            <div class="event-map"></div>

            <!-- Botão de Confirmar Presença -->
            <div class="row col-md-12 d-flex justify-content-between align-items-center">
                <button class="rsvp-button col-md-4" id="rsvp-button">Confirmar Presença</button>
                <!-- Contador de presença -->
                <div class="counter col-md-4" id="counter">Participantes Confirmados:</div>
            </div>
        </div>
    </div>

    <script>
        // Variáveis de controle
        let isAttending = localStorage.getItem('isAttending') === 'true';
        let participantCount = 0; // Inicializando com 30 participantes

        const rsvpButton = document.getElementById('rsvp-button');
        const counter = document.getElementById('counter');
        const participantCountDisplay = document.getElementById('participant-count');

        // Função para atualizar o estado do contador
        function updateCounter() {
            participantCountDisplay.textContent = `${participantCount} Pessoas`;
            counter.textContent = `Participantes Confirmados: ${participantCount}`;
        }

        // Função para alternar entre Confirmar e Desconfirmar presença
        function togglePresence() {
            if (isAttending) {
                // Desconfirmar presença
                participantCount--;
                isAttending = false;
                localStorage.setItem('isAttending', 'false');
                rsvpButton.textContent = 'Confirmar Presença';
            } else {
                // Confirmar presença
                participantCount++;
                isAttending = true;
                localStorage.setItem('isAttending', 'true');
                rsvpButton.textContent = 'Desconfirmar Presença';
            }

            // Atualiza a contagem de participantes
            updateCounter();
        }

        // Inicializar a interface com base no estado
        if (isAttending) {
            rsvpButton.textContent = 'Desconfirmar Presença';
        } else {
            rsvpButton.textContent = 'Confirmar Presença';
        }

        // Configurar o evento do botão
        rsvpButton.addEventListener('click', togglePresence);

        // Atualizar contador no carregamento
        updateCounter();
    </script>

</body>
</html>
