

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
            <h4><b> Depressão: </b> <b class="text-warning"> 6 </b></h4>
            <h5 style="padding-left: 30px;"> - De acordo com o seu autorrelato e com pontos de corte para população americana  você possui sintomas leve de depressão. </h5>

            <h4><b> Ansiedade:</b> <b class="text-warning"> 7 </b></h4>
            <h5 style="padding-left: 30px;">- De acordo com o seu autorrelato e com pontos de corte para população americana  você possui sintomas moderados de ansiedade.  </h5>

            <h4><b> Stress:</b> <b class="text-warning"> 10 </b></h4>
            <h5 style="padding-left: 30px;"> - De acordo com o seu autorrelato e com pontos de corte para população americana  você  possui sintomas severos de stress.  </h5>
            <a href="/Home" class="btn btn-success" style="margin-top: 50px;"><i class="fa fa-home"></i> Voltar a página inicial</a>
           
        </div>
        
    </div>
</div>
<div class="modal fade" id="novaPerguntaModal" tabindex="-1" role="dialog" aria-labelledby="novaPerguntaModal" aria-hidden="true"></div>
<?= $this->endSection() ?>