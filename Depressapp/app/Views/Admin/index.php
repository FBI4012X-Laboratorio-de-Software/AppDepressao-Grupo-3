<?= $this->extend('_Layout') ?>

<?= $this->section('content') ?>
    <div class="col-lg-12 col-md-12 col-sm-6 col-6">
 
    <div class="row" id="title-bar">
        <div class="col">
            <span class="view-title"> Menu Administrativo</span>
        </div>
    </div>
    <section id="menu-grid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 app app-icon-red" onclick="EditarPerguntas()">
                <div class="text-center">
                    <i class="fa fa-edit"></i> <br>
                    <label>Editar Perguntas</label>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 app app-icon-purple">
                <div class="text-center">
                    <i class="fa fa-chart-pie"></i> <br>
                    <label>Analisar Dados</label>
                </div>
            </div>

        </div>
    </section>

    </div>

<?= $this->endSection() ?>