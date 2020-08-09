

<?= $this->extend('_Layout') ?>

<?= $this->section('content') ?>
<div class="col-lg-12 col-md-12 col-sm-6 col-6">
    <div class="row" id="title-bar">
        <div class="col">
            <span class="view-title"> Resultados</span>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" style="padding: 0px 30px 0px 30px;">

            <h4><b> Depressão: </b> <b class="text-warning"> <?= $total_depressao?> </b></h4>

            <?php if($total_depressao >=0 && $total_depressao <=4): ?>
                <h5 style="padding-left: 30px;"> - De acordo com o seu autorrelato e com pontos de corte para população americana você não possui sintomas de depressão. </h5>
            <?php else: ?>
                <?php if($total_depressao >=5 && $total_depressao <=6): ?>
                    <h5 style="padding-left: 30px;"> - De acordo com o seu autorrelato e com pontos de corte para população americana você possui sintomas leves de depressão. </h5>
                    <?php else: ?>
                        <?php if($total_depressao >=7 && $total_depressao <=10): ?>
                            <h5 style="padding-left: 30px;"> - De acordo com o seu autorrelato e com pontos de corte para população americana você possui sintomas moderados de depressão. </h5>
                            <?php else: ?>
                                <?php if($total_depressao >=11 && $total_depressao <=13): ?>
                                    <h5 style="padding-left: 30px;"> - De acordo com o seu autorrelato e com pontos de corte para população americana você possui sintomas severos de depressão. </h5>
                                    <?php else: ?>
                                        <?php if($total_depressao >=14): ?>
                                            <h5 style="padding-left: 30px;"> - De acordo com o seu autorrelato e com pontos de corte para população americana você possui sintomas extremamente severos de depressão. </h5>
                                        <?php endif ?> 
                                <?php endif ?> 
                        <?php endif ?> 
                <?php endif ?>            
            <?php endif ?>


            <h4><b> Ansiedade:</b> <b class="text-warning"> <?= $total_ansiedade?> </b></h4>

            <?php if($total_ansiedade >=0 && $total_ansiedade <=3): ?>
                <h5 style="padding-left: 30px;"> - De acordo com o seu autorrelato e com pontos de corte para população americana você não possui sintomas de ansiedade. </h5>
            <?php else: ?>
                <?php if($total_ansiedade >=4 && $total_ansiedade <=5): ?>
                    <h5 style="padding-left: 30px;"> - De acordo com o seu autorrelato e com pontos de corte para população americana você possui sintomas leves de ansiedade. </h5>
                    <?php else: ?>
                        <?php if($total_ansiedade >=6 && $total_ansiedade <=7): ?>
                            <h5 style="padding-left: 30px;"> - De acordo com o seu autorrelato e com pontos de corte para população americana você possui sintomas moderados de ansiedade. </h5>
                            <?php else: ?>
                                <?php if($total_ansiedade >=8 && $total_ansiedade <=9): ?>
                                    <h5 style="padding-left: 30px;"> - De acordo com o seu autorrelato e com pontos de corte para população americana você possui sintomas severos de ansiedade. </h5>
                                    <?php else: ?>
                                        <?php if($total_ansiedade >=10): ?>
                                            <h5 style="padding-left: 30px;"> - De acordo com o seu autorrelato e com pontos de corte para população americana você possui sintomas extremamente severos de ansiedade. </h5>
                                        <?php endif ?> 
                                <?php endif ?> 
                        <?php endif ?> 
                <?php endif ?>            
            <?php endif ?>

            <h4><b> Stress:</b> <b class="text-warning"> <?= $total_stress?> </b></h4>
           
            <?php if($total_stress >=0 && $total_stress <=7): ?>
                <h5 style="padding-left: 30px;"> - De acordo com o seu autorrelato e com pontos de corte para população americana você não possui sintomas de stress. </h5>
            <?php else: ?>
                <?php if($total_stress >=8 && $total_stress <=9): ?>
                    <h5 style="padding-left: 30px;"> - De acordo com o seu autorrelato e com pontos de corte para população americana você possui sintomas leves de stress. </h5>
                    <?php else: ?>
                        <?php if($total_stress >=10 && $total_stress <=12): ?>
                            <h5 style="padding-left: 30px;"> - De acordo com o seu autorrelato e com pontos de corte para população americana você possui sintomas moderados de stress. </h5>
                            <?php else: ?>
                                <?php if($total_stress >=13 && $total_stress <=16): ?>
                                    <h5 style="padding-left: 30px;"> - De acordo com o seu autorrelato e com pontos de corte para população americana você possui sintomas severos de stress. </h5>
                                    <?php else: ?>
                                        <?php if($total_stress >=17): ?>
                                            <h5 style="padding-left: 30px;"> - De acordo com o seu autorrelato e com pontos de corte para população americana você possui sintomas extremamente severos de stress. </h5>
                                        <?php endif ?> 
                                <?php endif ?> 
                        <?php endif ?> 
                <?php endif ?>            
            <?php endif ?>





            <a href="/Home" class="btn btn-success" style="margin-top: 50px;"><i class="fa fa-home"></i> Voltar a página inicial</a>
           
        </div>
        
    </div>
</div>
<div class="modal fade" id="novaPerguntaModal" tabindex="-1" role="dialog" aria-labelledby="novaPerguntaModal" aria-hidden="true"></div>
<?= $this->endSection() ?>