<?= $this->extend('_Layout') ?>

<?= $this->section('content') ?>


<script>
    var _ArrayPerguntas = [];
    var _currentPergunta = 0;
    $(function(){
        _ArrayPerguntas = JSON.parse('<?php echo $arrayPerguntas ?>');
        $('#max').html(_ArrayPerguntas.length);
        CarregarPergunta();

    })

    function CarregarPergunta(type = null){
        index = _currentPergunta;
        if(type != null){
            if(type == 1 && _ArrayPerguntas[_currentPergunta].answer == null)
                return;

            switch(type){
                case 0: // -
                    if(index > 0)
                        index -= 1;
                    break;
                case 1: // +
                    if(index < _ArrayPerguntas.length)
                        index += 1;
                    break;
            }
        }


        $('#main-pergunta').load("/Questionario/loadPergunta",{cod_question: _ArrayPerguntas[index].key},function(){
            _currentPergunta = index;

            if( _ArrayPerguntas[_currentPergunta].answer != null){

                let answer = _ArrayPerguntas[_currentPergunta].answer;

                if(typeof(answer) == "string"){
                    let option = '#opcao_'+_ArrayPerguntas[_currentPergunta].answer;
                    $(option).val(_ArrayPerguntas[_currentPergunta].reply_text);
                    $(option).click();
                }
                else{
                    for(var i = 0; i< answer.length; i++){
                        let option = '#opcao_'+answer[i];
                        $(option).click();
                    }
                }
                $('#justi_reply').val(_ArrayPerguntas[_currentPergunta].justification)




            }


            $('#currentPergunta').html(index+1);
            if(index == 0)
            $('#p-a').attr('disabled',true);
            else
                $('#p-a').removeAttr('disabled');

            if(index == _ArrayPerguntas.length - 1){
                $('#p-p').attr('disabled',true);
                $('#nav-btn').append('<button class="btn btn-success btn-finish" onclick="SubmitQuestionario()" disabled><i class="fa fa-check"></i> Concluir</button>');
            }
            else{
                $('#p-p').removeAttr('disabled');
                $('.btn-finish').remove();
            }
        })

    }

    function SubmitQuestionario(){

        var ListaRespostas = _ArrayPerguntas.map(
            function(item){
                return {
                    cod_question: item.key,
                    cod_question_item: item.answer,
                    reply_text: item.reply_text,
                    justification: item.justification
                }
            });
        var baseurl = '<?=base_url()?>';
        $.post(baseurl+'/Questionario/SubmitQuestionario', {ListaRespostas:JSON.stringify(ListaRespostas)},function(data){
            if(data == "true"){
                window.location = "/Questionario/QuestionarioSocio";
            }
        },"text");
    }

</script>

<div class="col-lg-12 col-md-12 col-sm-6 col-6">
    <div class="row" id="title-bar">
        <div class="col">
            <span class="view-title"> Questionário de Contexto Acadêmico</span>
            <span class="float-right"> <b id="currentPergunta"></b>/<b id="max"></b></span>
        </div>

    </div>

    <div class="row">
        <div class="col-12" id="main-pergunta">
        </div>
    </div>

    <div class="row">
        <div class="col-12" id="nav-btn">
            <button class="btn btn-outline-dark btn-sm" id="p-a" onclick="CarregarPergunta(0)"><i class="fa fa-angle-left"></i> Anterior</button>
            <button class="btn btn-dark btn-sm" id="p-p" onclick="CarregarPergunta(1)">Próximo <i class="fa fa-angle-right"></i></button>

        </div>
    </div>
</div>


<?= $this->endSection() ?>
