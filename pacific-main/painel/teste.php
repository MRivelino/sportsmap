<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Carrossel de Fundo</title>
  <style>
    html, body {
      margin: 0;
      padding: 0;
    }

    .carrossel-container {
      position: relative;
      width: 100%;
      height: 90vh; /* altura da seção do carrossel */
      overflow: hidden;
    }

    .hero-wrap {
      position: absolute;
      top: 0;
      left: 100%;
      width: 100%;
      height: 100%;
      opacity: 0;
      transition: all 1s ease;
    }

    .hero-wrap.active {
      left: 0;
      opacity: 1;
      z-index: 0;
    }

    .img-background {
      background-size: cover;
      background-position: center;    
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100% !important;
      z-index: -1;
      background-color: #000;
    }

    .content {
      position: relative;
      z-index: 1;
      padding: 20px;
      text-align: center;
      color: white;
    }

    .subheading {
      color: #00AAFF !important;
    }

    /* Conteúdo por cima do carrossel */
    nav {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      padding: 20px;
      z-index: 10;
      color: white;
      font-weight: bold;
      background: rgba(0, 0, 0, 0.3); /* só se quiser um fundo leve */
    }
  </style>
</head>
<body>

<div class="carrossel-container" id="home">
  <div class="hero-wrap active">
    <div class="img-background" style="background-image: url('./images/quadra-1.jpeg');"></div>
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
        <div class="col-md-10 ftco-animate">
          <span class="subheading">Bem-Vindo ao SportsMap</span>
          <h1 class="mb-4">Encontre o melhor local para a prática de esportes</h1>
          <p class="caps">Seu guia para locais esportivos está aqui</p>
        </div>
      </div>
    </div>
  </div>

  <div class="hero-wrap">
    <div class="img-background" style="background-image: url('./images/tenis.webp');"></div>
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
        <div class="col-md-10 ftco-animate">
          <span class="subheading">Comece Agora</span>
          <h1 class="mb-4">Encontre trilhas e centros esportivos</h1>
          <p class="caps">Pratique com liberdade e segurança</p>
        </div>
      </div>
    </div>
  </div>

  <div class="hero-wrap">
    <div class="img-background" style="background-image: url('./images/quadra-2.webp');"></div>
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
        <div class="col-md-10 ftco-animate">
          <span class="subheading">Explore Novos Lugares</span>
          <h1 class="mb-4">Campos, quadras e muito mais</h1>
          <p class="caps">Descubra onde praticar seu esporte favorito</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const slides = document.querySelectorAll('.hero-wrap');
  let current = 0;

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.classList.remove('active');
      if (i === index) slide.classList.add('active');
    });
  }

  function nextSlide() {
    current = (current + 1) % slides.length;
    showSlide(current);
  }

  setInterval(nextSlide, 5000); // troca a cada 5 segundos
</script>

</body>
</html>
