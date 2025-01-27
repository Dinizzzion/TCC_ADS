<?php
session_start();
include_once('conexao.php');

if (!isset($_SESSION['autenticado'])) {
  header('Location: index.html');
  exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" charset="UTF-8" />
  <title>Software para Atendimento de Assistencia Social</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="assets/img/kaiadmin/Logo_SPAAS.png" type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Public Sans:300,400,500,600,700"]
      },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["assets/css/fonts.min.css"],
      },
      active: function() {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/plugins.min.css" />
  <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />

</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header d-flex justify-content-center align-items-center" style="height: 130px;" data-background-color="dark">
          <a href="#" class="logo">
            <img src="assets/img/kaiadmin/Logo_SPAAS.png" alt="navbar brand" class="navbar-brand" style="height: 100%; width: auto; transform: scale(1.6)" />
          </a>
        </div>
        <!-- End Logo Header -->
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <ul class="nav nav-secondary">
            <li class="nav-item active">
              <a href="#">
                <i class="fas fa-home"></i>
                <p>Informações Gerais</p>
              </a>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#base">
                <i class="fas fa-clipboard"></i>
                <p>Atendimentos</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="base">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="atendimento.php">
                      <span class="sub-item">Registrar Atendimento</span>
                    </a>
                  </li>
                  <li>
                    <a href="consultar.php">
                      <span class="sub-item">Consultar Atendimentos</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#sidebarLayouts">
                <i class="fas fa-address-card"></i>
                <p>Usuários</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="sidebarLayouts">
                <ul class="nav nav-collapse">
                  <?php if ($_SESSION['id_assistente'] == 1): ?>
                    <li>
                      <a href="cadastroassistente.php">
                        <span class="sub-item">Assistentes</span>
                      </a>
                    </li>
                  <?php endif; ?>
                  <li>
                    <a href="cadastrousuarios.php">
                      <span class="sub-item">Usuários</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#forms">
                <i class="fas fa-book-open"></i>
                <p>Relatórios</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="forms">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="relatorio_semanal.php">
                      <span class="sub-item">Relatório Semanal</span>
                    </a>
                  </li>
                  <li>
                    <a href="relatorio_mensal.php">
                      <span class="sub-item">Relatório Mensal</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a href="config.php">
                <i class="fas fa-cog"></i>
                <p>Configurações</p>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
          <div class="container-fluid">
            <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
              <div class="input-group">
                <div class="input-group-prepend">
                </div>
              </div>
            </nav>

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
              <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                  <div class="avatar-sm">
                    <img src="<?php echo $_SESSION['foto_usuario']; ?>" alt="..." class="avatar-img rounded-circle" />
                  </div>
                  <span class="profile-username">
                    <span class="op-7">Olá,</span>
                    <span class="fw-bold"><?php echo $_SESSION['nome_usuario']; ?></span>
                  </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                  <div class="dropdown-user-scroll scrollbar-outer">
                    <li>
                      <div class="user-box">
                        <div class="avatar-lg">
                          <img src="<?php echo $_SESSION['foto_usuario']; ?>" alt="image profile" class="avatar-img rounded" />
                        </div>
                        <div class="u-text">
                          <h4><?php echo $_SESSION['nome_usuario']; ?></h4>
                          <p class="text-muted"><?php echo $_SESSION['funcao_usuario']; ?></p>
                          <p class="text-muted"><?php echo $_SESSION['email_usuario']; ?></p>
                          <a href="perfil.php" class="btn btn-xs btn-secondary btn-sm">Ver Perfil</a>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="config.php">Configurações da Conta</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="logout.php?url=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">Sair</a>
                    </li>
                  </div>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>


      <div class="container">
        <div class="page-inner">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                  <h4 class="card-title">Assistentes Sociais</h4>
                </div>
                <p class="card-category">
                  Estatísticas dos assistentes sociais cadastrados no sistema
                </p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    id="basic-datatables"
                    class="display table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>Local</th>
                        <th>Função</th>
                        <th>CRESS</th>
                        <th>Matrícula</th>
                        <th>Atendimentos</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

  <!-- Chart JS -->
  <script src="assets/js/plugin/chart.js/chart.min.js"></script>

  <!-- jQuery Sparkline -->
  <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

  <!-- Chart Circle -->
  <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

  <!-- Datatables -->
  <script src="assets/js/plugin/datatables/datatables.min.js"></script>

  <!-- Kaiadmin JS -->
  <script src="assets/js/kaiadmin.min.js"></script>

  <script>
    $(document).ready(function() {
      $("#basic-datatables").DataTable({

        ajax: {
          url: 'dados.php',
          dataSrc: ''
        },

        columns: [{
            data: 'nome'
          },
          {
            data: 'local'
          },
          {
            data: 'funcao'
          },
          {
            data: 'cress'
          },
          {
            data: 'matricula'
          },
          {
            data: 'atendimentos'
          },
        ],

        language: {
          "info": "Mostrando _END_ de _TOTAL_ entradas",
          "lengthMenu": "Mostrar _MENU_ entradas",
          "search": "Buscar:",
          "zeroRecords": "Nenhum registro encontrado",
          "infoEmpty": "Mostrando 0 de 0 entradas",
          "infoFiltered": "(Filtrado de _MAX_ entradas totais)",
          "paginate": {
            "next": "Próxima",
            "previous": "Anterior"
          },
        }
      });
    });
  </script>
</body>

</html>