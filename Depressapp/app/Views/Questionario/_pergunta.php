

<script>
    $(function(){


        $('input[name="opcao_radio"]').click(function(){
            var cod_question_item =  $($('input[name="opcao_radio"]:checked')[0]).attr('id').split('_')[1];
            _ArrayPerguntas[_currentPergunta].answer = cod_question_item;

            if(_currentPergunta == _ArrayPerguntas.length - 1)
                $('.btn-finish').removeAttr('disabled');
        })



    })
</script>

<div class="col-lg-12 col-md-12 col-sm-6 col-6">
    <div class="row">
        <div class="col">
            <h5>- <?php echo $Descricao?></h5>
        </div>

    </div>
    <div class="row" id="options_list">
        <div class="col">
            <?php foreach ($ListaOpcoes as $opcao): ?>
                <div class="form-check app_check">
                    <input type="radio" class="form-check-input" name="opcao_radio" id="opcao_<?php echo $opcao->cod_question_item?>" />
                    <label class="form-check-label" for="opcao_<?php echo $opcao->cod_question_item?>"><?php echo $opcao->question_item_desc?></label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
</div>

