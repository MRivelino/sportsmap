<?php
session_start();
$aviso = "";
if (isset($_SESSION["aviso"])) {
    $aviso = $_SESSION["aviso"];
    unset($_SESSION["aviso"]);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    
    <style>
.modal {
  display: none;
  position: fixed;
  z-index: 9999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
}

.modal.show {
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-content {
  background: white;
  padding: 30px 20px;
  border-radius: 10px;
  width: 90%;
  max-width: 400px;
  box-shadow: 0 0 15px rgba(0,0,0,0.3);
  position: relative;
  text-align: center;
  animation: fadeIn 0.3s ease-in-out;
}

.modal-content p {
  margin: 0;
  font-size: 18px;
  color: #333;
}

.close {
  position: absolute;
  top: 10px;
  right: 15px;
  font-size: 24px;
  color: #aaa;
  cursor: pointer;
  transition: color 0.2s;
}

.close:hover {
  color: #000;
}

@keyframes fadeIn {
  from { opacity: 0; transform: scale(0.95); }
  to { opacity: 1; transform: scale(1); }
}


.btn, input[type="button"]{
    width: 100%;
    height: 48px;
    background: #0082C3;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, .1);
    border: none;
    cursor: pointer;
    font-size: 16px;
    color: #fff;
    position: relative;
    overflow: hidden;
    
}

.btn:hover, input[type="button"]:hover{
    color:#fff;
    transform: scale(1);
    outline: 2px solid #00aaff;
    box-shadow: 4px 5px 17px -4px #00aaff;
}

.btn::before, input[type="button"]::before{
    content: "";
    position: absolute;
    left: -50px;
    top: 0;
    width: 0;
    height: 100%;
    background-color: #00aaff;
    transform: skewX(45deg);
    z-index: -1;
    transition: width 1000ms;
}

.btn:hover::before, input[type="button"]:hover::before{
    width: 150%;
  }

    </style>

    <script>
        function submeterForm(acao){ //submete o formulario mas passando...
            document.getElementById('acao').value = acao; //o valor do campo de texto escondido para o valor do botao clicado para selecionar a acao e...
            document.getElementById('f').submit(); //efetua a submissao do formulario
        }
    </script>

</head>
<body>
    <div class="container">
        <div class="form-box login">
            <form action="validar.php" method="post">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="email" name="email" id="" placeholder="E-mail" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="senha" id="" placeholder="Senha" required>
                    <i class='bx bxs-lock-alt' ></i>
                </div>
                <div class="forgot-link">
                    <a href="#">Esqueceu a senha?</a>
                </div>
                <button type="submit" class="btn" name="acao" value="Entrar">Login</button>
                <button 
                    class="btn" 
                    type="button" 
                    onclick="window.location.href='../index.php';" 
                    style="margin-top: 20px;">
                    Voltar
                </button>
            </form>
        </div>

        <div class="form-box register">
            <form action="crud.php" name="f" id="f" method="post">
                <h1>Registrar</h1>
                <div class="input-box">
                    <input type="text" name="nome" id="" placeholder="Nome" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" name="email" id="" placeholder="E-mail" required>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="senha" id="" placeholder="Senha" required>
                    <i class='bx bxs-lock-alt' ></i>
                </div>
                <input type="text" class="input" name="acao" id="acao" style="display:none"></input>
                <button type="submit" class="btn" onclick="document.getElementById('acao').value='c';">Registrar</button>
                <button 
                    class="btn" 
                    type="button" 
                    onclick="window.location.href='../../index.php';" 
                    style="margin-top: 20px;">
                    Voltar
                </button>
            </form>
        </div>

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Olá, Bem Vindo!</h1>
                <p>Não possui uma conta?</p>
                <button class="btn register-btn">Registrar</button>
            </div>

            <div class="toggle-panel toggle-right">
                <h1>Bem Vindo de Volta!</h1>
                <p>Possui uma conta?</p>
                <button class="btn login-btn">Login</button>
            </div>
        </div>
    </div>

    <script src="script.js"></script>

    <?php if (!empty($aviso)): ?>
<div id="customModal" class="modal show">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p><?php echo $aviso; ?></p>
  </div>
</div>
<?php endif; ?>


<script>
document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("customModal");
  const closeBtn = document.querySelector(".modal .close");

  if (modal) {
    modal.classList.add("show");

    closeBtn.onclick = () => {
      modal.classList.remove("show");
    };

    window.onclick = (e) => {
      if (e.target === modal) {
        modal.classList.remove("show");
      }
    };
  }
});
</script>






</body>
</html>