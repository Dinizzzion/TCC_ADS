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
  <script
    type="text/javascript"
    src='https://cdn.tiny.cloud/1/ml46es889ozl4dmmo33rnf3bpuzqs3jrzpsy6qurscjq7bou/tinymce/7/tinymce.min.js'
    referrerpolicy="origin">
  </script>
  <script type="text/javascript">
    tinymce.init({
      selector: '#myTextarea',
      width: 600,
      height: 300,
      plugins: [],
      toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist',
      menubar: 'file edit insert help',
      statusbar: false,
      entity_encoding: "raw",
      language: 'pt_BR',
      setup: function(editor) {
        editor.on('init', function() {
          const nome = <?php echo json_encode($_SESSION['nome_usuario'] ?? ''); ?>;
          const funcao = <?php echo json_encode($_SESSION['funcao_usuario'] ?? ''); ?>;
          const conteudoNaoEditavel = '<div id="dados-usuario" style="font-size: smaller; font-style: italic; color: gray;" contenteditable="false">' +
            '- <br><br>' + nome + '<br>' + funcao + '</div>';
          editor.setContent(editor.getContent() + '<br><br>' + conteudoNaoEditavel);
        });

        document.querySelector('form').addEventListener('submit', function(e) {
          const editorContent = editor.getContent();
          const novoConteudo = editorContent.replace(/<div id="dados-usuario".*?<\/div>/, '');
          editor.setContent(novoConteudo);
          editor.save();
        });
      }
    });

    function confirmarCancelar() {
      swal({
        title: "Cancelar",
        text: "Deseja mesmo cancelar? Todo o trabalho será perdido.",
        icon: "warning",
        buttons: {
          cancel: {
            text: "Não",
            value: null,
            visible: true,
            className: "btn btn-secondary",
            closeModal: true,
          },
          confirm: {
            text: "Sim",
            value: true,
            visible: true,
            className: "btn btn-danger",
            closeModal: true
          }
        }
      }).then((willCancel) => {
        if (willCancel) {
          document.querySelector('form').reset();
          tinymce.get('myTextarea').setContent('');
          configurarEditor(tinymce.get('myTextarea'));
        }
      });
    }

    function configurarEditor(editor) {
      const nome = <?php echo json_encode($_SESSION['nome_usuario'] ?? ''); ?>;
      const funcao = <?php echo json_encode($_SESSION['funcao_usuario'] ?? ''); ?>;
      const conteudoNaoEditavel = '<div style="font-size: smaller; font-style: italic; color: gray;" contenteditable="false">' +
        '- <br><br>' + nome + '<br>' + funcao + '</div>';
      editor.setContent(editor.getContent() + '<br><br>' + conteudoNaoEditavel);
    }
  </script>
  </script>
  <script>
    $(document).ready(function() {
      $('#usuario').select2({
        placeholder: "Selecione um usuário",
        allowClear: true
      });
    });
  </script>
  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/plugins.min.css" />
  <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header d-flex justify-content-center align-items-center" style="height: 130px;" data-background-color="dark">
          <a href="index.php" class="logo">
            <img src="assets/img/kaiadmin/Logo_SPAAS.png" alt="navbar brand" class="navbar-brand" style="height: 100%; width: auto; transform: scale(1.6)" />
          </a>
        </div>
        <!-- End Logo Header -->
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <ul class="nav nav-secondary">
            <li class="nav-item active">
              <a href="index.php">
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
              <div class="collapse show" id="base">
                <ul class="nav nav-collapse">
                  <li class="active">
                    <a href="#">
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
          </ul>
        </div>
      </div>
    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.php" class="logo">
              <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
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
                      <a class="dropdown-item" href="perfil.php">Configurações da Conta</a>
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

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">Registro de Atendimento</div>
                </div>
                <div class="card-body">
                  <form id="formRegistra" onsubmit="tinymce.triggerSave();">
                    <div class="row">
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="assunto">Assunto *:</label>
                          <input type="text" class="form-control" id="assunto" name="assunto" placeholder="Preencha este campo." required />
                        </div>
                        <div class="form-group">
                          <label for="usuário">Usuário *:</label>
                          <select class="form-control" id="usuario" name="id_usuario" required>
                            <option value="">Selecione o usuário</option>
                            <?php
                            $sql = "SELECT id, nome FROM usuarios";
                            $result = $db->query($sql);

                            if ($result) {
                              while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                              }
                            } else {
                              echo "<option value=''>Nenhum usuário encontrado</option>";
                            }
                            ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="data">Data *:</label>
                          <input type="date" class="form-control" id="data" name="data" required />
                        </div>
                        <div class="form-group"><br>
                          <button type="submit" class="btn btn-success" id="alert_demo_4">Enviar</button>
                          <button type="button" class="btn btn-danger" onclick="confirmarCancelar()">Cancelar</button>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="descricao">Descrição *:</label>
                          <textarea id="myTextarea" name="descricao" class="form-control"></textarea>
                        </div>

                      </div>
                    </div>
                  </form>
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

  <!-- SweetAlert-->
  <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

  <!-- jQuery Sparkline -->
  <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

  <!-- Chart Circle -->
  <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

  <!-- Datatables -->
  <script src="assets/js/plugin/datatables/datatables.min.js"></script>

  <!-- Kaiadmin JS -->
  <script src="assets/js/kaiadmin.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
    const today = new Date().toISOString().split('T')[0];

    document.getElementById('data').setAttribute('max', today);
    
    $(document).ready(function() {
      $('#formRegistra').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
          type: 'POST',
          url: 'registraatendimento.php',
          data: formData,
          dataType: 'json',
          success: function(response) {
            if (response.status === 'success') {
              swal({
                title: "Sucesso!",
                content: {
                  element: "span",
                  attributes: {
                    innerHTML: response.message 
                  },
                },
                icon: "success",
                buttons: {
                  confirm: {
                    text: "OK",
                    className: "btn btn-success",
                  },
                },
              }).then(() => {
                window.location.reload();
              });
            } else {
              swal({
                title: "Erro!",
                text: response.message,
                icon: "error",
                buttons: {
                  confirm: {
                    text: "OK",
                    className: "btn btn-danger",
                  },
                },
              });
            }
          },
          error: function(xhr, status, error) {
            swal({
              title: "Erro!",
              text: "Ocorreu um erro ao processar a requisição.",
              icon: "error",
              buttons: {
                confirm: {
                  text: "OK",
                  className: "btn btn-danger",
                },
              },
            });
          }
        });
      });
    });
  </script>

</body>

</html>