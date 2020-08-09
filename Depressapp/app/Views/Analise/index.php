<?= $this->extend('_Layout') ?>

<?= $this->section('content') ?>

<script>
    function LoadView(){
        var dt_ini = $('date-init').val();
        var dt_end = $('date-end').val();
        $('#analise-view').load('Analise/View', {dt_ini:dt_ini, dt_end:dt_end});
    }
    $(function(){
        LoadView();
        $('#analise-btn').click(function(){
            LoadView();
        });
    });
</script>


<div class="col-lg-12 col-md-12 col-sm-6 col-6">

    <div class="row" id="title-bar">
            <span class="view-title">  Análise de Dados</span>
    </div>
    <!-- <section id="analise-filtros">
        <div class="row">
                <div class="form-inline">
                    <div class="form-group col-4">
                        <label for="date-init">Mês inicial:</label>
                        <input type="month" id="date-init" name="date-init">
                    </div>
                    <div class="form-group col-4">
                        <label for="date-end">Mês final:</label>
                        <input type="month" id="date-end" name="date-end">
                    </div>
                    <button type="submit" class="btn btn-primary" id="analise-btn">Confirmar</button>
            
                </div>
                    
        </div>
    </section> -->

    <section id="analise-view">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
            <span><i class="fa fa-spinner fa-pulse fa-2x"></i> Carregando Dados...</span>
        </div>
    </section>

</div>

<?= $this->endSection() ?>