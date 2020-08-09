
<?= \Config\Services::validation()->listErrors(); ?>


<script>
    var _ArrayOpcoesExistente = [];
    var _ArrayOpcoes = [];
    var _index = 0;


    function AdicionarOpcao(){
        let opcao = $('#input-opcao').val();
        if(opcao.trim() == '' || opcao == null || opcao == undefined )
            return;
        let item = {};
        item.index = _index;
        item.question_item_desc = opcao;
        _ArrayOpcoes.push(item);

        let li = `<li id="li_${_index}">
                    <div class="row">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control input-opcao-add" id="option_${_index}" placeholder="Opção" aria-label="Opção" value="${opcao}" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="save_${_index}" onclick="SaveOpcao(${_index})"><i class="fa fa-check"></i></button>
                                <button class="btn btn-outline-danger" type="button" onclick="DeleteOpcao(${_index})"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                </li>`;

        $('#lista-opcoes').append(li);
        $('#input-opcao').val('');
        _index += 1;
    }

    function SaveOpcao(o_index){
        let id = `#option_${o_index}`;
        let opcao = $(id).val();
        if($(id).is(':disabled')){
            $(id).removeAttr('disabled');
        }
        else{
            _ArrayOpcoes.forEach(function(element, index, array){
                if(element.index == o_index)
                    element.question_item_desc = opcao;
            });
            $(id).attr('disabled', true);
        }

    }

    function DeleteOpcao(o_index){
        let array_index = -1;
        _ArrayOpcoes.forEach(function(element, index, array){
                if(element.index == o_index)
                    array_index = index;
            });
        if(array_index >= 0){
            _ArrayOpcoes.splice(array_index, 1);
            $(`#li_${o_index}`).remove();
        }
    }

    function Submit(){
        var item = {};
        item.question_desc = $('#question_desc').val();
        item.question_type = $('#question_type').val();
        item.question_mode = $('#question_mode').val();

        item.has_justi = false;
        if($('#justi_check').is(':checked')){
            item.has_justi = true;
            item.justi = $('#justi_desc').val();
        }
            
        if(item.question_type == 1)
            item.question_symp = $('#question_symp').val();
            
        item.question_options = _ArrayOpcoes;
        var baseurl = '<?=base_url()?>';

        $.post(baseurl+'/Perguntas/Create',{item: JSON.stringify(item)}, function(data){
            if(data == "true"){
                $('#perguntas-grid').load('Perguntas/CarregarLista');
                $('#novaPerguntaModal').modal('hide');
            }
            else{
                console.log(data);
            }
        },'text');
    }

    function Save(cod_question){
        var item = {};
        item.question_desc = $('#question_desc').val();
        item.question_type = $('#question_type').val();
        item.question_mode = $('#question_mode').val();



        item.has_justi = false;
        if($('#justi_check').is(':checked')){
            item.has_justi = true;
            item.justi = $('#justi_desc').val();
        }


        if(item.question_type == 1)
            item.question_symp = $('#question_symp').val();
            
        item.question_options = _ArrayOpcoes;
        var baseurl = '<?=base_url()?>';

        $.post(baseurl+'/Perguntas/Update',{item: JSON.stringify(item), cod_question: cod_question}, function(data){
            if(data == "true"){
                $('#perguntas-grid').load('Perguntas/CarregarLista');
                $('#novaPerguntaModal').modal('hide');
            }
            else{
                console.log(data);
            }
        },'text');
    }

 
        <?php if(isset($questionItemList)): ?>
            _ArrayOpcoesExistente = JSON.parse('<?=$questionItemList?>');
        <?php endif?>

        if( _ArrayOpcoesExistente.length > 0){
        
            let item ;
            for(var i = 0; i < _ArrayOpcoesExistente.length; i++){
                item = {};
                let opcao = _ArrayOpcoesExistente[i];
                item.index = _index;
                item.question_item_desc = opcao;
                _ArrayOpcoes.push(item);


                let li = `<li id="li_${_index}">
                        <div class="row">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control input-opcao-add" id="option_${_index}" placeholder="Opção" aria-label="Opção" value="${opcao}" disabled>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="save_${_index}" onclick="SaveOpcao(${_index})"><i class="fa fa-check"></i></button>
                                    <button class="btn btn-outline-danger" type="button" onclick="DeleteOpcao(${_index})"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    </li>`;
                $('#lista-opcoes').append(li);

                _index += 1;
            }
       
        }



        $(function(){
            $('#question_type').change(function(){
                if( $('#question_type').val() == 1)
                    $('#symp_input').show();
                else
                    $('#symp_input').hide();
            });

            $('#question_mode').change(function(){
                if( $('#question_mode').val() != 2)
                    $('#div-options').show();
                else
                    $('#div-options').hide();
            });

            $('#justi_check').change(function(){
                if($('#justi_check').is(':checked'))
                    $('#form-just-desc').show();
                else
                    $('#form-just-desc').hide();
            });

            $('#question_type').change();
            $('#question_mode').change();
            $('#justi_check').change();
        });

</script>



 <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Criar Pergunta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="question_form">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="question_desc"> Pergunta: </label>
                <input class="form-control" type="input" name="question_desc" id="question_desc" value="<?= isset($question) ? $question->question_desc : "" ?>">
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="question_type"> Tipo de Pergunta: </label>
                        <select class="form-control" name="question_type" id="question_type">
                            <option value= '0' <?= isset($question) ? $question->question_type == 0 ? 'selected="selected"' : "" : "" ?> >Sócio-Demografico</option>
                            <option value= '1' <?= isset($question) ? $question->question_type == 1 ? 'selected="selected"' : "" : "" ?>  >Auto-Avaliação</option>
                            <option value= '2' <?= isset($question) ? $question->question_type == 2 ? 'selected="selected"' : "" : "" ?>  >Contexto Acadêmico</option>
                        </select>
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <label for="question_mode"> Tipo de Resposta: </label>
                        <select class="form-control" name="question_mode" id="question_mode">
                            <option value= '0' <?= isset($question) ? $question->question_mode == 0 ? 'selected="selected"' : "" : "" ?>>Única Escolha</option>
                            <option value= '1' <?= isset($question) ? $question->question_mode == 1 ? 'selected="selected"' : "" : "" ?>>Múltipla Escolha</option>
                            <option value= '2' <?= isset($question) ? $question->question_mode == 2 ? 'selected="selected"' : "" : "" ?>>Descritiva</option>
                        </select>
                    </div>
                </div>

                <div class="col-3" id="symp_input">
                    <div class="form-group">
                        <label for="question_symp"> Sintoma Atribuido: </label>
                        <select class="form-control" name="question_symp" id="question_symp">
                            <option value= '0' <?= isset($question) ? $question->question_symp == 0 ? 'selected="selected"' : "" : "" ?> >Depressão</option>
                            <option value= '1' <?= isset($question) ? $question->question_symp == 1 ? 'selected="selected"' : "" : "" ?>>Ansiedade</option>
                            <option value= '2' <?= isset($question) ? $question->question_symp == 2 ? 'selected="selected"' : "" : "" ?> >Stress</option>
                        </select>
                    </div>
                </div>
            </div>

          
        </form>
        <div class="col" id="div-options">
            <div class="row">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Adicionar Opção" aria-label="Adicionar Opção" id="input-opcao">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" onclick="AdicionarOpcao()"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
               
            </div>
            <ul id="lista-opcoes">
                
            </ul>

            <div class="form-check app_check">
                <input type="checkbox" class="form-check-input" name="justi_check" id="justi_check" <?= isset($question) ? $question->has_justification ? "checked" : "" : "" ?>/>
                <label class="form-check-label" for="justi_check">Solicitar justificativa de resposta</label>
            </div>
            <div class="form-group" id='form-just-desc'>
                <label for="justi_desc"> Descrição da justificativa: </label>
                <input class="form-control" type="input" name="justi_desc" id="justi_desc" value="<?= isset($question) ? $question->justification: "" ?>">
            </div>
        </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

        <?php if(isset($question)): ?>
            <button type="button" class="btn btn-success" onclick="Save('<?=$question->cod_question?>')"> Salvar</button>
        <?php else:?>
            <button type="button" class="btn btn-success" onclick="Submit()"> Confirmar</button>
        <?php endif ?>
      
      </div>
    </div>
  </div>