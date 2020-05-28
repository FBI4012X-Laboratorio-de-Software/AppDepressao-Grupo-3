<?= $this->extend('_Layout') ?>

<?= $this->section('content') ?>

<script>
    $(function(){
       $('#perguntas-grid').load('Perguntas/CarregarLista');

       $('#criar-pergunta').click(function(){
            $('#novaPerguntaModal').load('Perguntas/novaPerguntaModal',function(){
                $('#novaPerguntaModal').modal('show');
            });
        });

    });
</script>

<div class="col-lg-12 col-md-12 col-sm-6 col-6">
    <div class="row" id="title-bar">
        <div class="col">
            <span class="view-title"> Editar Perguntas</span>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button class="btn btn-success" id="criar-pergunta"> <i class="fa fa-plus"></i> Criar Pergunta</button>
        </div>
    </div>
    <section id="perguntas-grid">
  
    </section>
</div>
<div class="modal fade" id="novaPerguntaModal" tabindex="-1" role="dialog" aria-labelledby="novaPerguntaModal" aria-hidden="true"></div>
<?= $this->endSection() ?>
