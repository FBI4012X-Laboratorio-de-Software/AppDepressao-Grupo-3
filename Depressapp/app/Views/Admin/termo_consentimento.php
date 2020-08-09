<?= $this->extend('_Layout') ?>

<?= $this->section('content') ?>

<div class="col-lg-12 col-md-12 col-sm-6 col-6">
    <div class="row" id="title-bar">
        <span class="view-title"> Termo Consentimento</span>
    </div>
    <div class="row">
        <div class="col btn-control">
            <a class="btn btn-dark" id="criar-pergunta" href="/Users"> <i class="fa fa-arrow-left"></i> Voltar</a>
        </div>
    </div>
    <div class="row">
      <form class="form-signin" method="POST" action="<?php echo base_url(); ?>/Admin/editar_termo" enctype="multipart/form-data">
        <div class="form-group">
          <label for="des_user" class="sr-only">Usuário</label>
          <textarea name="text" class="form-control rounded-0" rows="20" cols="100"><?php if(isset($this->data['consent_text'])){ echo $this->data['consent_text']->text; }?></textarea>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Editar</button>
      </form>
    </div>
</div>
<?= $this->endSection() ?>
