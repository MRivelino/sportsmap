<?php require_once 'header.php' ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
            color: #333;
        }
        header {
            margin-bottom: 5em;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        .event-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .event-info {
            max-width: 60%;
        }
        .event-header h1 {
            font-size: 36px;
            margin: 0;
        }
        .event-header p {
            font-size: 18px;
            color: #777;
        }
        .event-image {
            width: 50%;
            margin-left: 20px;
            margin-right: 0;
            background-color: #cccccc;
            height: 300px;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #ffffff;
            font-size: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .event-description {
            margin-top: 20px;
            font-size: 16px;
            line-height: 1.6;
            color: #444;
        }
        .event-buttons {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }
        .comments-section {
            margin-top: 40px;
        }
        .comment {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .comment h3 {
            font-size: 18px;
            color: #333;
        }
        .comment p {
            font-size: 14px;
            color: #666;
        }
        .add-comment {
            margin-top: 20px;
        }
        .add-comment textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ddd;
            resize: none;
            height: 100px;
        }
        .add-comment button {
            background-color: #5c6bc0;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }
        .add-comment button:hover {
            background-color: #3f51b5;
        }

        .event-map {
            margin-top: 40px;
            width: 100%;
            height: 400px;
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
        }

        .event-map iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        .counter {
            margin-top: 20px;
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .counter h3 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .counter p {
            font-size: 18px;
            color: #444;
            margin: 10px 0;
        }

        .progress-bar-container {
            height: 20px;
            width: 100%;
            background-color: #e0e0e0;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .progress-bar {
            height: 100%;
            background-color: #5c6bc0;
            border-radius: 5px;
        }

        .rsvp-button {
            display: inline-block;
            padding: 12px 25px;
            font-size: 1.1em;
            color: #fff;
            background-color: #5c6bc0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .rsvp-button:hover {
            background-color: #3f51b5;
        }

        .sugest {
            padding: 10px 22px; 
            font-size: 18px; 
            height: auto; 
        }
    </style>

<body>
    <?php require_once 'nav.php'?>

    <header></header>

    <div class="container">
        <div class="event-header">
            <div class="event-info">
                <h1>Futebol na Praça - Torneio Local</h1>
                <p>Data: 15 de Maio de 2025 | Hora: 14:00 | Local: Praça Central</p>

                <div class="event-description">
                    <p>Venha participar do Torneio Local de Futebol na Praça Central! Uma ótima oportunidade para se divertir, conhecer novas pessoas e praticar esportes ao ar livre. Se você é fã de futebol, esse evento é para você! Os times serão divididos no dia do evento e teremos premiação para os vencedores!</p>
                </div>

                <div class="event-buttons">
                    <a href="#counter" class="btn btn-primary sugest">Participar do Evento</a>
                    <a href="#map" class="btn btn-primary sugest">Ver Local no Mapa</a>
                </div>
            </div>

            <div class="event-image">
                Imagem do Local
            </div>
        </div>

        <div class="event-map" id="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14627.285780607118!2d-47.9297059!3d-15.7801488!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMMKwNDAnMTQuMyJ5fCkZbGZfNl_4.6dLViiHRLJhRdDlXaPps8A9j8Qhe8oqp6SC2QQm7hZ60-35dGggE-4-0vvLfXKcY3DeuW89mWzylQal5YPH4J1QckdyDOYsQ==" allowfullscreen=""></iframe>
        </div>

        <div class="counter" id="counter">
            <h3>Participantes Confirmados</h3>
            <p id="counter-text">30 Confirmados</p>
            <div class="progress-bar-container">
                <div class="progress-bar" id="progress-bar" style="width: 60%;"></div>
            </div>
            <button class="rsvp-button" id="rsvp-button">Confirmar Presença</button>
        </div>

        <div class="comments-section">
            <div class="comment">
                <h3>João Silva</h3>
                <p>Estou super empolgado para participar! Vai ser muito legal!</p>
            </div>
            <div class="comment">
                <h3>Ana Souza</h3>
                <p>Vou levar meus amigos para o torneio. Vai ser incrível!</p>
            </div>
        </div>

        <div class="add-comment">
            <h3>Deixe seu comentário</h3>
            <textarea placeholder="Escreva seu comentário..."></textarea>
            <button>Comentar</button>
        </div>
    </div>

    <script>
        let isAttending = localStorage.getItem('isAttending') === 'true';
        let participantCount = 30;
        const maxParticipants = 50;

        const rsvpButton = document.getElementById('rsvp-button');
        const counterText = document.getElementById('counter-text');
        const progressBar = document.getElementById('progress-bar');

        function updateCounter() {
            counterText.textContent = `${participantCount} Confirmados`;
            const progressPercentage = (participantCount / maxParticipants) * 100;
            progressBar.style.width = `${progressPercentage}%`;
        }

        function togglePresence() {
            if (isAttending) {
                participantCount--;
                isAttending = false;
                localStorage.setItem('isAttending', 'false');
                rsvpButton.textContent = 'Confirmar Presença';
            } else {
                participantCount++;
                isAttending = true;
                localStorage.setItem('isAttending', 'true');
                rsvpButton.textContent = 'Desconfirmar Presença';
            }

            updateCounter();
        }

        if (isAttending) {
            rsvpButton.textContent = 'Desconfirmar Presença';
        } else {
            rsvpButton.textContent = 'Confirmar Presença';
        }

        rsvpButton.addEventListener('click', togglePresence);

        updateCounter();
    </script>

    <?php require_once 'footer.php' ?>
</body>
