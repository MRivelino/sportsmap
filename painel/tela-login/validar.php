<?php
    require_once 'conect.php';

    if(!empty($_POST)){
        ValidarLogin($_POST['email'], $_POST['senha']);
    }
    else{
        header("Location: login.php");
    }

    function ValidarLogin($email, $senha){
        global $con;
    
        // Consulta para pegar id_cliente, nome e senha_hash
        $sql = "SELECT id_cliente, nome, senha FROM cliente WHERE email = ?";
        $res = $con->prepare($sql);
    
        if($res === false){
            die('Erro ao preparar a consulta: '.$con->error);
        }
    
        // Vincula o parâmetro
        if(!$res->bind_param('s', $email)){
            die('Erro ao vincular parâmetro: '.$res->error);
        }
    
        // Executa a consulta
        if(!$res->execute()){
            die('Erro ao executar a consulta: '.$con->error);
        }
    
        // Vincula os resultados
        $res->bind_result($idCliente, $nome, $senhaHash);
    
        // Se a consulta retornar um resultado
        if($res->fetch()){
            // Verifica se a senha informada corresponde ao hash armazenado
            if(password_verify($senha, $senhaHash)){
                session_start();
                $_SESSION['id'] = $idCliente;
                $_SESSION['nome'] = $nome;
    
                // Redireciona para o painel com mensagem de sucesso
                Confirma("Bem-vindo " . $_SESSION['nome'], "../painel/index.php?data=");
            } else {
                // Se a senha não for válida
                Erro("E-mail ou senha incorretos.");
            }
        } else {
            // Se o email não for encontrado
            Erro("E-mail ou senha incorretos.");
        }
    
        // Fecha a consulta
        $res->close();
    }
    

    function Confirma($msg, $redirect){
        echo '
            <style>
                .modal {
                    margin: 0 auto;
                    text-align: center;
                    border: none;
                    padding: 30px;
                    width: 300px;
                    background: #fff;
                    border-radius: 12px;
                    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
                    margin-top: 10%; 
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    flex-direction: column;
                }

                .modal-body {
                    text-align: center;
                    padding: 20px;
                }

                .modal-footer {
                    padding-top: 20px;
                    display: flex;
                    justify-content: center;
                }

                /* Estilo para o ícone */
                i {
                    color: #28a745; /* Cor verde mais suave */
                    font-size: 80px;
                    margin-bottom: 20px;
                }

                /* Título do modal */
                .modal h3 {
                    font-size: 1.5rem;
                    font-weight: 600;
                    color: #333;
                    margin-bottom: 20px;
                }

                /* Estilo do botão OK */
                .btn-success {
                    background-color: #28a745;
                    border: none;
                    color: white;
                    padding: 10px 30px;
                    font-size: 1.1rem;
                    border-radius: 25px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                    width: 60%; /* Largura do botão */
                }

                .btn-success:hover {
                    background-color: #218838;
                }

                .btn-close {
                    color: #28a745;
                    border: none;
                    background: none;
                }

                .modal-header {
                    border-bottom: 1px solid #f1f1f1;
                }
            </style>

            <div class="modal fade" id="myModal" data-backdrop="static">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-body text-center text-success" style="height: 200px">
                            <i class="bi bi-check2-circle" style="font-size: 75pt"></i>
                            <br>
                            <h3>'.$msg.'</h3>
                        </div>
                        <div class="modal-footer text-center">
                            <button class="btn btn-success mx-auto" onclick="redirecionar()" style="widht:50%;">OK</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function redirecionar(){
                    location.href = "'.$redirect.'";
                }
            </script> 
        ';
    }
    
    
    
    

    function Erro($msg){
        echo '
            <style>
                .modal {
                    margin: 0 auto;
                    text-align: center;
                    border: none;
                    padding: 30px;
                    width: 300px;
                    background: #fff;
                    border-radius: 12px;
                    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
                    margin-top: 35%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    flex-direction: column;
                }

                .modal-body {
                    text-align: center;
                    padding: 20px;
                }

                .modal-footer {
                    padding-top: 20px;
                    display: flex;
                    justify-content: center;
                }

                /* Estilo para o ícone de erro */
                i {
                    color: #dc3545; /* Cor vermelha suave */
                    font-size: 80px;
                    margin-bottom: 20px;
                }

                /* Título do modal */
                .modal h3 {
                    font-size: 1.5rem;
                    font-weight: 600;
                    color: #333;
                    margin-bottom: 20px;
                }

                /* Estilo do botão OK (vermelho para erro) */
                .btn-danger {
                    background-color: #dc3545; /* Cor vermelha suave */
                    border: none;
                    color: white;
                    padding: 10px 30px;
                    font-size: 1.1rem;
                    border-radius: 25px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                    width: 60%; /* Largura do botão */
                }

                .btn-danger:hover {
                    background-color: #c82333; /* Tom mais escuro de vermelho */
                }

                .btn-close {
                    color: #dc3545; /* Cor de close com tom vermelho */
                    border: none;
                    background: none;
                }

                .modal-header {
                    border-bottom: 1px solid #f1f1f1;
                }
            </style>

            <div class="modal fade" id="myModal" data-backdrop="static">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-body text-center text-danger" style="height: 200px">
                            <i class="bi bi-x-circle" style="font-size: 75pt"></i>
                            <br>
                            <h3>'.$msg.'</h3>
                        </div>
                        <div class="modal-footer text-center">
                            <button class="btn btn-danger" onclick="redirecionar()" style="width:50%;">OK</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function redirecionar(){
                    history.go(-1);
                }
            </script> 
        ';
    }
?>

<script>
    $(document).ready(function(){
        $('#myModal').modal('show');
    });

    $('#myModal').on('shown.bs.modal', function(){
        $('#myInput').trigger('focus');
    });
</script>   