
<script>
  $(function(){

    $('#btn-confirm-questionario').click(function(){
        $('#termosModal').load('Home/termosModal',function(){
            $('#termosModal').modal('show');
            $('#novoQuestionarioModal').modal('hide');
        });
    })
  })
</script>
 <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fazer novo questionário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            Deseja realizar novo questionário?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
        <button type="button" class="btn btn-success" id="btn-confirm-questionario"> Sim</button>
      </div>
    </div>
  </div>