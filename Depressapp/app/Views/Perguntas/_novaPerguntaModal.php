
<?= \Config\Services::validation()->listErrors(); ?>


<script>
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
                    <div class="row"></div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control input-opcao-add" id="option_${_index}" placeholder="Opção" aria-label="Opção" value="${opcao}" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="save_${_index}" onclick="SaveOpcao(${_index})"><i class="fa fa-check"></i></button>
                                <button class="btn btn-outline-danger" type="button" onclick="DeleteOpcao(${_index})"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                </li>
                `
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
                <input class="form-control" type="input" name="question_desc" id="question_desc">
            </div>

            <div class="form-group">
                <label for="question_type"> Tipo de Pergunta: </label>
                <select class="form-control col-3" name="question_type" id="question_type">
                    <option value= '0' >Sócio-Demografico</option>
                    <option value= '1' >Auto-Avaliação</option>
                </select>
            </div>
            
        </form>
        <div class="col">
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
        </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" onclick="Submit()"> Confirmar</button>
      </div>
    </div>
  </div>