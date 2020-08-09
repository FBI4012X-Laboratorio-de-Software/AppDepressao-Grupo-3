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
            <a class="btn btn-dark" id="criar-pergunta" href="/Users/add_user"> <i class="fa fa-user-plus"></i> Cadastrar Usuário</a>
        </div>
    </div>
    <div class="row table-users">
      <table class="table-users table">
        <thead class="thead-light">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Usuário</th>
            <th scope="col">Email</th>
            <th scope="col">Ação</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($this->data['usuarios'] as $key => $value) {
          ?>
              <tr>
                <th scope="row"><?php echo $value["COD_USER"]; ?></th>
                <td><?php echo $value["DES_USER"]; ?></td>
                <td><?php echo $value["DES_EMAIL"]; ?></td>
                <td>
                  <a class="btn btn-danger btn-sm btn-delete-pergunta float-right btn-delete-user" href="Users/delete_user/<?php echo $value["COD_USER"] ?>" > <i class="fa fa-times"></i> Deletar</button>
                  <a class="btn btn-info btn-sm btn-edit-pergunta float-right" href="Users/edit_user/<?php echo $value["COD_USER"] ?>"> <i class="fa fa-list"></i> Editar</button>
                </td>
              </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
    </div>
</div>
<script>
  $('.btn-delete-user').click(function(event){
    event.preventDefault();

    if(confirm('Tem certeza de que deseja remover este usuário?')){
      window.location = $(this).attr('href');
    }
  });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<!-- <div class="modal fade" id="novaPerguntaModal" tabindex="-1" role="dialog" aria-labelledby="novaPerguntaModal" aria-hidden="true"></div> -->
<?= $this->endSection() ?>
