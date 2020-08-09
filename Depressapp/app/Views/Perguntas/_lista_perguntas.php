<script>
    $(function(){
       $('#toggle-psd').click(function(){
            if($('#perguntas-socio-demografica').is(':visible')){
                $('#perguntas-socio-demografica').hide();
                $('.ic-psd').html('<i class="fa fa-angle-down"></i>');
            }
            else{
                $('.ic-psd').html('<i class="fa fa-angle-up"></i>');
                $('#perguntas-socio-demografica').show();
            }
        });

        $('#toggle-aa').click(function(){
            if($('#perguntas-auto-avaliacao').is(':visible')){
                $('#perguntas-auto-avaliacao').hide();
                $('.ic-aa').html('<i class="fa fa-angle-down"></i>');



                
            }
            else{
                $('.ic-aa').html('<i class="fa fa-angle-up"></i>');
                $('#perguntas-auto-avaliacao').show();
            }
        });

        $('#toggle-ca').click(function(){
            if($('#perguntas-contexto-academico').is(':visible')){
                $('#perguntas-contexto-academico').hide();
                $('.ic-ca').html('<i class="fa fa-angle-down"></i>');



                
            }
            else{
                $('.ic-ca').html('<i class="fa fa-angle-up"></i>');
                $('#perguntas-contexto-academico').show();
            }
        });


        $('.btn-edit-pergunta').click(function(){
            let cod_question = $(this).data('pergunta');
            $('#novaPerguntaModal').load('Perguntas/novaPerguntaModal',{ cod_question: cod_question },function(){
                $('#novaPerguntaModal').modal('show');
            });
        });

        $('.btn-delete-pergunta').click(function(){
            let cod_question = $(this).data('pergunta');

            var baseurl = '<?=base_url()?>';
            $.getJSON(baseurl+'/Perguntas/Delete',{cod_question: cod_question}, function(data){
                if(data == "true"){
                    $('#perguntas-grid').load('Perguntas/CarregarLista');
                }
                else{
                    console.log(data);
                }
            });
        });


    });
</script>

 <div class="col-lg-12 col-md-12 col-sm-6 col-6">

            <div class="row" id="lista-socio-demografica">
                <div class="col-lg-12" id="toggle-psd">
                    <span>Perguntas Sócio-Demográficas</span>
                    <span class="float-right ic-psd"><i class="fa fa-angle-down"></i></span>
                </div>
                <div class="col-lg-12">
                    <div id="perguntas-socio-demografica" class="lista-perguntas" style="display: none;">

                        <?php $ListaSociaDemografica =  array_filter($ListaPerguntas, function($pergunta){
                                return $pergunta->question_type == \App\Models\QuestionType::socio_demografico;
                            })
                        ?>
                        <?php if(!empty($ListaSociaDemografica)): ?>

                            <table class="table-perguntas table table-sm">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Pergunta</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ListaSociaDemografica as $pergunta): ?>
                                        <tr>
                                            <td>
                                                <?= esc($pergunta->question_desc) ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger btn-sm btn-delete-pergunta float-right" data-pergunta="<?=$pergunta->cod_question?>" > <i class="fa fa-times"></i> Deletar</button>
                                                <button class="btn btn-info btn-sm btn-edit-pergunta float-right" data-pergunta="<?=$pergunta->cod_question?>"> <i class="fa fa-list"></i> Editar</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>

                        <?php else: ?>
                            <h4>Lista de perguntas vazia.</h4>
                            <p>Utilize o botão "Criar Pergunta" para criar perguntas.</p>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="row" id="lista-auto-avaliacao">
                <div class="col-lg-12" id="toggle-aa">
                    <span>Perguntas Auto-Avaliação</span>
                    <span class="float-right ic-aa"><i class="fa fa-angle-down"></i></span>
                </div>
                <div class="col-lg-12">
                    <div id="perguntas-auto-avaliacao" class="lista-perguntas" style="display: none;">
                        <?php $ListaAutoAvaliacao =  array_filter($ListaPerguntas, function($pergunta){
                                return $pergunta->question_type == \App\Models\QuestionType::auto_avaliacao;
                            })
                        ?>
                        <?php if(!empty($ListaAutoAvaliacao)): ?>

                            <table class="table-perguntas table table-sm">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Descrição</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ListaAutoAvaliacao as $pergunta): ?>
                                        <tr>
                                            <td>
                                                <?= esc($pergunta->question_desc) ?>
                                            </td>
                                            <td>
                                              <button class="btn btn-danger btn-sm btn-delete-pergunta float-right" data-pergunta="<?=$pergunta->cod_question?>" > <i class="fa fa-times"></i> Deletar</button>
                                              <button class="btn btn-info btn-sm btn-edit-pergunta float-right" data-pergunta="<?=$pergunta->cod_question?>"> <i class="fa fa-list"></i> Editar</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        <?php else: ?>
                        <h3>Lista de perguntas vazia.</h3>
                        <p>Utilize o botão "Criar Pergunta" para criar perguntas.</p>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="row" id="lista-contexto-academico">
                <div class="col-lg-12" id="toggle-ca">
                    <span>Perguntas de Contexto Acadêmico</span>
                    <span class="float-right ic-ca"><i class="fa fa-angle-down"></i></span>
                </div>
                <div class="col-lg-12">
                    <div id="perguntas-contexto-academico" class="lista-perguntas" style="display: none;">
                        <?php $ListaAutoAvaliacao =  array_filter($ListaPerguntas, function($pergunta){
                                return $pergunta->question_type == \App\Models\QuestionType::contexto_academico;
                            })
                        ?>
                        <?php if(!empty($ListaAutoAvaliacao)): ?>

                            <table class="table-perguntas table table-sm">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Descrição</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ListaAutoAvaliacao as $pergunta): ?>
                                        <tr>
                                            <td>
                                                <?= esc($pergunta->question_desc) ?>
                                            </td>
                                            <td>
                                              <button class="btn btn-danger btn-sm btn-delete-pergunta float-right" data-pergunta="<?=$pergunta->cod_question?>" > <i class="fa fa-times"></i> Deletar</button>
                                              <button class="btn btn-info btn-sm btn-edit-pergunta float-right" data-pergunta="<?=$pergunta->cod_question?>"> <i class="fa fa-list"></i> Editar</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        <?php else: ?>
                        <h3>Lista de perguntas vazia.</h3>
                        <p>Utilize o botão "Criar Pergunta" para criar perguntas.</p>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
