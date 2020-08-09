




 <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Termos de Consentimento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php if(isset($this->data['consent_text'])){ echo $this->data['consent_text']->text; }?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Recusar</button>
        <a type="button" class="btn btn-success" href="/Questionario/QuestionarioContextoAcademico"> Aceitar</a>
      </div>
    </div>
  </div>
