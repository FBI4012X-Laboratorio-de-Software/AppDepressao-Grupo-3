

<script>
    $(function(){


        $('input[name="opcao_radio"]').click(function(){
            var cod_question_item =  $($('input[name="opcao_radio"]:checked')[0]).attr('id').split('_')[1];
            _ArrayPerguntas[_currentPergunta].answer = cod_question_item;

            if(_currentPergunta == _ArrayPerguntas.length - 1)
                $('.btn-finish').removeAttr('disabled');
        });

        $('.text-area-reply').change(function(){
            var cod_question_item =  $($('.text-area-reply')[0]).attr('id').split('_')[1];
            _ArrayPerguntas[_currentPergunta].answer = cod_question_item;
            _ArrayPerguntas[_currentPergunta].reply_text = $($('.text-area-reply')[0]).val();

            if(_currentPergunta == _ArrayPerguntas.length - 1)
                $('.btn-finish').removeAttr('disabled');
        });

        $('#justi_reply').change(function(){
            _ArrayPerguntas[_currentPergunta].justification = $('#justi_reply').val();
        });




        $('input[name="opcao_radio"]').click(function(){

            let answer_array = [];

            $('input[name="opcao_radio"]:checked').each(function(){
                let cod_question_item =  $(this).attr('id').split('_')[1];
                answer_array.push(cod_question_item);
            });

            _ArrayPerguntas[_currentPergunta].answer = answer_array;

            if(_currentPergunta == _ArrayPerguntas.length - 1)
                $('.btn-finish').removeAttr('disabled');
        });


        if(_ArrayPerguntas[_currentPergunta].answer != null){
            if(_currentPergunta == _ArrayPerguntas.length - 1)
                $('.btn-finish').removeAttr('disabled');
        }


    })
</script>

<div class="col-lg-12 col-md-12 col-sm-6 col-6">
    <div class="row">
        <div class="col">
            <div class="titulo-pergunta-quest"><?=$question->question_desc?></div>
        </div>

    </div>
    <div class="row" id="options_list">
        <div class="col">

            <?php if($question->question_mode == \App\Models\QuestionMode::descritiva): ?>
                <?php foreach ($ListaOpcoes as $opcao): ?>
                    <div class="form-group">
                    <label for="opcao_<?= $opcao->cod_question_item?>">Resposta</label>
                    <textarea class="form-control text-area-reply" id="opcao_<?= $opcao->cod_question_item?>" data-text="true" rows="3"></textarea>
                    </div>
                <?php endforeach; ?>

            <?php else:?>
                <?php
                    $type = "radio";
                    switch($question->question_mode){
                        case \App\Models\QuestionMode::unica_escolha:
                            $type = "radio";
                        break;
                        case \App\Models\QuestionMode::multipla_escolha:
                            $type = "checkbox";
                        break;
                    }
                ?>

                <?php foreach ($ListaOpcoes as $opcao): ?>
                    <div class="form-check app_check">
                        <input type="<?=$type?>" class="form-check-input" name="opcao_radio" id="opcao_<?php echo $opcao->cod_question_item?>" />
                        <label class="form-check-label" for="opcao_<?php echo $opcao->cod_question_item?>"><?php echo $opcao->question_item_desc?></label>
                    </div>
                <?php endforeach; ?>

            <?php endif; ?>


        </div>
    </div>

    <?php if($question->has_justification): ?>
            <div class="col">
                <div class="form-group" id='form-just-reply'>
                    <label for="justi_reply"> <?= $question->justification?> </label>
                    <input class="form-control" type="input" name="justi_reply" id="justi_reply">
                </div>
            </div>

    <?php endif; ?>



</div>

</div>
