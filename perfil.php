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
                    <a href="index.php" class="logo">
                        <img src="assets/img/kaiadmin/Logo_SPAAS.png" alt="navbar brand" class="navbar-brand" style="height: 100%; width: auto; transform: scale(1.6)" />
                    </a>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item">
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
                                        <a href="#">
                                            <span class="sub-item">Relatório Semanal</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
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
                                                    <a href="#" class="btn btn-xs btn-secondary btn-sm">Ver Perfil</a>
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
                                    <h4 class="card-title">Seu Perfil</h4>
                                    <p class="card-category">
                                        Aqui você pode editar suas informações pessoais
                                    </p>
                                </div>
                                <form id="formEditarPerfil" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="avatar avatar-xxl">
                                            <img id="avatar-img-xxl" src="<?php echo $_SESSION['foto_usuario'] ?>" class="avatar-img rounded-circle">
                                        </div>

                                        <div class="avatar avatar-xl">
                                            <img id="avatar-img-xl" src="<?php echo $_SESSION['foto_usuario'] ?>" class="avatar-img rounded-circle">
                                        </div>

                                        <div class="avatar avatar-lg">
                                            <img id="avatar-img-lg" src="<?php echo $_SESSION['foto_usuario'] ?>" class="avatar-img rounded-circle">
                                        </div>

                                        <div class="avatar">
                                            <img id="avatar-img" src="<?php echo $_SESSION['foto_usuario'] ?>" class="avatar-img rounded-circle">
                                        </div>

                                        <div class="avatar avatar-sm">
                                            <img id="avatar-img-sm" src="<?php echo $_SESSION['foto_usuario'] ?>" class="avatar-img rounded-circle">
                                        </div>

                                        <div class="avatar avatar-xs">
                                            <img id="avatar-img-xs" src="<?php echo $_SESSION['foto_usuario'] ?>" class="avatar-img rounded-circle">
                                        </div>

                                        <input type="file"
                                            class="form-control-file"
                                            id="selecionarImagem"
                                            name="foto"
                                            onchange="visualizarImagem()" />
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label>Nome</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="nomePerfil"
                                                        name="nome"
                                                        placeholder="<?php echo $_SESSION['nome_usuario']; ?>" />
                                                </div>
                                                <div class="form-group">
                                                    <label>Nova Senha</label>
                                                    <input
                                                        type="password"
                                                        class="form-control"
                                                        id="senhaPerfil"
                                                        name="senha"
                                                        placeholder="Digite a Senha"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>CRESS</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="cressPerfil"
                                                        name="cress"
                                                        placeholder="<?php echo $_SESSION['cress_usuario']; ?>"/>
                                                </div>
                                                <div class="form-group">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                    <label>Matrícula</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="matriculaPerfil"
                                                        name="matricula"
                                                        placeholder="<?php echo $_SESSION['matricula_usuario']; ?>"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirmar Senha</label>
                                                    <input
                                                        type="password"
                                                        class="form-control"
                                                        id="confirmasenhaPerfil"
                                                        name="confirma_senha"
                                                        placeholder="Digite a Senha"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input
                                                        type="email"
                                                        class="form-control"
                                                        id="emailPerfil"
                                                        name="email"
                                                        placeholder="<?php echo $_SESSION['email_usuario']; ?>" />
                                                    <small class="form-text text-muted">
                                                        Não compartilhamos seu email com nínguem.
                                                    </small>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Salvar Alterações</button>
                                            <button class="btn btn-danger" onclick="confirmarCancelar()">Cancelar</button>
                                        </div>
                                    </div>
                                </form>
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

        <script>
            function visualizarImagem() {
                var fileInput = document.getElementById('selecionarImagem');
                var file = fileInput.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('avatar-img-xxl').src = e.target.result;
                    document.getElementById('avatar-img-xl').src = e.target.result;
                    document.getElementById('avatar-img-lg').src = e.target.result;
                    document.getElementById('avatar-img').src = e.target.result;
                    document.getElementById('avatar-img-sm').src = e.target.result;
                    document.getElementById('avatar-img-xs').src = e.target.result;
                }

                if (file) {
                    reader.readAsDataURL(file);
                }
            }

            function confirmarCancelar() {
                event.preventDefault();
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
                window.location.reload();
            }
                });
            }
        </script>
        <script>
    $(document).ready(function() {
        $('#formEditarPerfil').on('submit', function(e) {
            e.preventDefault();

            var senha = $('#senhaPerfil').val();
            var confirmaSenha = $('#confirmasenhaPerfil').val();

            if (senha !== confirmaSenha) {
                swal({
                    title: 'Erro',
                    text: 'As senhas não conferem. Por favor, verifique novamente.',
                    icon: 'error',
                    button: 'OK',
                });
                return false;
            }
            var formData = new FormData(this);

            $.ajax({
                url: 'editar_perfil.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status === 'success') {
                        swal({
                            title: 'Sucesso!',
                            text: res.message,
                            icon: 'success',
                            button: 'OK',
                        }).then((result) => {
                            if (result) {
                                location.reload();
                            }
                        });
                    } else {
                        swal({
                            title: '',
                            text: res.message,
                            icon: 'info',
                            button: 'OK',
                        });
                    }
                },
                error: function() {
                    swal({
                        title: 'Erro',
                        text: 'Erro ao processar a requisição.',
                        icon: 'error',
                        button: 'OK',
                    });
                }
            });
        });
    });
</script>

</body>

</html>