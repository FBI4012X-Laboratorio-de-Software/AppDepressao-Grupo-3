<?= $this->extend('_Layout') ?>

<?= $this->section('content') ?>

<div class="col-lg-12 col-md-12 col-sm-6 col-6">
    <div class="row" id="title-bar">
        <span class="view-title"> Usuários</span>
    </div>
    <div class="row">
        <p>Usuários ativos</p>
    </div>
    <div class="row">
        <div class="col btn-control">
            <a class="btn btn-dark" id="criar-pergunta" href="/Users"> <i class="fa fa-arrow-left"></i> Voltar</a>
        </div>
    </div>
    <div class="row">
      <form class="form-signin" method="POST" action="<?php echo base_url(); ?><?php if(isset($this->data['usuario'])){echo "/Users/edit_user/"; }else{ echo "/Users/add_user/"; }?>" enctype="multipart/form-data">
        <div class="form-group">
          <label for="des_user" class="sr-only">Usuário</label>
          <?php if(isset($this->data['usuario'])){ ?>
            <input type="hidden" id="cod_user" name="cod_user" value="<?php echo $this->data['usuario']->COD_USER;?>" class="form-control" placeholder="Usuário" required autofocus>
          <?php } ?>
          <input type="text" id="des_user" name="des_user" value="<?php if(isset($this->data['usuario'])){ echo $this->data['usuario']->DES_USER; }?>" class="form-control" placeholder="Usuário" required autofocus>
        </div>
        <div class="form-group">
          <label for="des_email" class="sr-only">E-mail</label>
          <input type="email" id="des_email" name="des_email" value="<?php if(isset($this->data['usuario'])){ echo $this->data['usuario']->DES_EMAIL; }?>" class="form-control" placeholder="E-mail" required autofocus>
        </div>
        <div class="form-group">
          <label for="des_password" class="sr-only">Senha</label>
          <input type="password" id="des_password" name="des_password" class="form-control" placeholder="Senha" <?php if(!isset($this->data['usuario'])){ echo "required"; }?>>
        </div>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Tipo de Usuário</label>
          <select class="form-control" name="tip_master" id="exampleFormControlSelect1">
            <option value="1" <?php if(isset($this->data['usuario'])){ if($this->data['usuario']->TIP_MASTER == 1) echo "selected"; }?>>admin</option>
            <option value="2" <?php if(isset($this->data['usuario'])){ if($this->data['usuario']->TIP_MASTER == 2) echo "selected"; }?>>comum</option>
          </select>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit"><?php if(isset($this->data['usuario'])){ echo "Editar"; }else{ echo "Cadastrar"; }?></button>
      </form>
    </div>
</div>
<?= $this->endSection() ?>
