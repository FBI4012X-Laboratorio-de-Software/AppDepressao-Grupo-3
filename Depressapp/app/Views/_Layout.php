<!doctype html>
<html>
<head>
    <title>DepressApp - UCS</title>
    <script src="<?php echo base_url('../Content/jQuery/jquery-3.5.1.min.js')?>"></script>
    <script src="<?php echo base_url('../Content/popper/popper.min.js')?>"></script>
    <script src="<?php echo base_url('../Content/bootstrap-4.5.0-dist/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('../Content/fontawesome-free-5.13.0-web/js/fontawesome.js')?>"></script>
    <script src="<?php echo base_url('../Content/fontawesome-free-5.13.0-web/js/solid.js')?>"></script>
    <script src="<?php echo base_url('../Content/appJs/script.js')?>"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('../Content/bootstrap-4.5.0-dist/css/bootstrap.min.css')?>"></link>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('../Content/fontawesome-free-5.13.0-web/css/fontawesome.css')?>"></script>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('../Content/fontawesome-free-5.13.0-web/css/solid.css')?>"></script>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('../Content/appStyle/style.css')?>"></link>
</head>

<body id="page-top">
    <section class="main-nav nav-side">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand" href="#page-top">
              <span class="d-block d-lg-none">
                  <img class="img-logo-sm" src="<?=base_url()?>/Content/images/logo_ucs.png" alt="">
              </span>
              <span class="d-none d-lg-block">
                  <img class="img-logo-lg" src="<?=base_url()?>/Content/images/logo_ucs.png" alt="">
              </span>
            </a>


            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="/Home"><i class="fa fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <?php
                      $session = session();
                      $questionHistoryModel = new \App\Models\QuestionHistoryModel();
                      $last_date = $questionHistoryModel->getLastAnswerData($session->get('cod_usuario'));
                      // var_dump($last_date);
                      // die;
                      if($last_date != NULL){
                        $cmp = new DateTime('15 days ago');
                        $last_reply_date = new DateTime($last_date->reply_date);
                        // var_dump($last_reply_date);
                        // var_dump($cmp);
                        // die;
                        if ($last_reply_date <= $cmp) {
                    ?>
                          <a class="nav-link js-scroll-trigger" id="start-novo-questionario"><i class="fa fa-clipboard-list"></i> Novo Questionário</a>
                    <?php
                        }else{
                    ?>
                        <a class="nav-link js-scroll-trigger"><i class="fa fa-clipboard-list"></i> Aguarde para iniciar novo questionario</a>
                    <?php
                        }
                      }else{
                    ?>
                        <a class="nav-link js-scroll-trigger" id="start-novo-questionario"><i class="fa fa-clipboard-list"></i> Novo Questionário</a>
                    <?php
                      }
                    ?>
                </li>
                <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#"><i class="fa fa-history"></i> Meu Histórico</a>
                </li>
                <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="/Admin"><i class="fa fa-chart-bar"></i> Menu Administrativo</a>
                </li>
            </ul>
            </div>
        </nav>
    </section>

    <section class="main-nav">
      <nav class="navbar navbar-expand-lg navbar-light">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- <span><h4>Seja Bem-vindo</h4></span> -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" tabindex="-1"><?php echo $session->get('nome_usuario');?> <i class="fa fa-user-circle"></i></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url(); ?>/Account/logout" tabindex="-1">Logout</a>
                </li>
            </ul>
        </div>
        </nav>
    </section>
    <div class="body-content">
      <?= $this->renderSection('content') ?>
    </body>
    <!-- <script src="<?=base_url()?>/public/Content/jQuery/jquery-3.5.1.min.js"></script>
    <script src="<?=base_url()?>/public/Content/popper/popper.min.js"></script>
    <script src="<?=base_url()?>/public/Content/bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>/public/Content/fontawesome-free-5.13.0-web/js/fontawesome.js"></script>
    <script src="<?=base_url()?>/public/Content/fontawesome-free-5.13.0-web/js/solid.js"></script>
    <script src="<?=base_url()?>/public/Content/appJs/script.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script> -->
    <div class="modal fade" id="novoQuestionarioModal" tabindex="-1" role="dialog" aria-labelledby="novoQuestionarioModal" aria-hidden="true"></div>
    <div class="modal fade" id="termosModal" tabindex="-1" role="dialog" aria-labelledby="termosModal" aria-hidden="true"></div>
</body>
</html>
