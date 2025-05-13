<?php
    require_once 'header.php';  
    require_once 'conect.php';  
?>

<style>
    .custom-col-md-12 {
        min-width: 70vh !important; 
        margin: 0 auto;  
    }

    .search-property-1 .form-group .form-control.btn {
        background-color: #00AAFF !important;
    }

    .search-property-1 .form-group {
        border-left: 1px solid #6c757d;
    }
</style>

<section class="ftco-section ftco-no-pb ftco-no-pt">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="ftco-search d-flex justify-content-center">
                    <div class="row">
                        <div class="col-md-12 custom-col-md-12 nav-link-wrap">
                            <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true"
                                    style="color: #FFF !important; background-color: #004A6F !important;">Filtro</a>
                            </div>
                        </div>
                        <div class="col-md-12 tab-wrap">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                                    <form action="resultados.php" method="GET" class="search-property-1">
                                        <div class="row no-gutters" style="background-color: #004A6F !important;">
                                            <div class="col-md d-flex" style="align-items: center;">
                                                <div class="form-group p-4 border-0">
                                                    <label for="#" style="color: #FFF !important">Tipo de Esporte</label>
                                                    <div class="form-field">
                                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                            <select class="form-control" name="esporte" id="esporte" style="background-color: #fff !important; color: #6c757d !important; border: 1px solid #6c757d !important; padding: 0.375rem 0.75rem; border-radius: 5px; appearance: none; -webkit-appearance: none; -moz-appearance: none; width: 180px; height: 45px !important;">
                                                                <option value="">Selecione</option>
                                                                <?php
                                                                    $query_esportes = "SELECT * FROM tb_esporte";
                                                                    $result_esportes = $con->query($query_esportes);

                                                                    while ($esporte = $result_esportes->fetch_assoc()) {
                                                                        echo '<option value="' . $esporte['id_esporte'] . '">' . $esporte['nome'] . '</option>';
                                                                    }
                                                                ?>
                                                            </select>
                                                            <div class="dropdown-toggle-icon" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); pointer-events: none; color: #6c757d; font-size: 20px;">
                                                                &#9662; 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md d-flex" style="align-items: center;">
                                                <div class="form-group p-4">
                                                    <label for="#" style="color: #FFF !important">Locais</label>
                                                    <div class="form-field">
                                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                            <select class="form-control" name="bairro" id="bairro" style="background-color: #fff !important; color: #6c757d !important; border: 1px solid #6c757d !important; padding: 0.375rem 0.75rem; border-radius: 5px; appearance: none; -webkit-appearance: none; -moz-appearance: none; width: 180px; height: 45px !important;">
                                                                <option value="">Selecione</option>
                                                                <?php
                                                                    $query_bairros = "SELECT * FROM tb_bairros";
                                                                    $result_bairros = $con->query($query_bairros);
                                                                    
                                                                    // Exibir bairros no select
                                                                    while ($bairro = $result_bairros->fetch_assoc()) {
                                                                        echo '<option value="' . $bairro['id_bairro'] . '">' . $bairro['nome'] . '</option>';
                                                                    }
                                                                ?>
                                                            </select>
                                                            <div class="dropdown-toggle-icon" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); pointer-events: none; color: #6c757d; font-size: 20px;">
                                                                &#9662; 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md d-flex" style="text-align: center">
                                                <div class="form-group d-flex w-100 border-0">
                                                    <div class="form-field w-100 align-items-center d-flex">
                                                        <input type="submit" value="Buscar" class="align-self-stretch form-control btn btn-primary" style="background-color: #00AAFF !important">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>


