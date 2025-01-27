<?php
session_start();
include_once('conexao.php');

if (!isset($_SESSION['autenticado'])) {
    header('Location: index.html');
    exit;
}

$mensagem = '';
if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];
    unset($_SESSION['mensagem']);
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
        window.onload = function() {
            <?php if (!empty($mensagem)): ?>
                alert('<?php echo addslashes($mensagem); ?>');
            <?php endif; ?>
        };
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
                            <div class="collapse show" id="sidebarLayouts">
                                <ul class="nav nav-collapse">
                                    <?php if ($_SESSION['id_assistente'] == 1): ?>
                                        <li class="active">
                                            <a href="#">
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Cadastrar Assistente</h4>
                                    <button
                                        class="btn btn-primary btn-round ms-auto"
                                        data-bs-toggle="modal"
                                        data-bs-target="#addRowModal">
                                        <i class="fa fa-plus"></i>
                                        Adicionar
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">

                                <!-- Modal -->
                                <div
                                    class="modal fade"
                                    id="addRowModal"
                                    tabindex="-1"
                                    role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold"> Novo</span>
                                                    <span class="fw-light"> Cadastro </span>
                                                </h5>
                                                <button
                                                    type="button"
                                                    class="close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="small">Preencha todos os campos abaixo</p>

                                                <form id="cadastrarA" class="cadastrarA" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-6 pe-0">
                                                            <div class="form-group form-group-default">
                                                                <label>Nome</label>
                                                                <input
                                                                    id="addName"
                                                                    name="nome"
                                                                    type="text"
                                                                    class="form-control"
                                                                    placeholder="Preencha o nome" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Local</label>
                                                                <select id="addOffice" name="local" class="form-control" required>
                                                                    <option value="" selected disabled>Selecione o local</option>
                                                                    <option value="CRAS Sul">CRAS Sul</option>
                                                                    <option value="CRAS Norte">CRAS Norte</option>
                                                                    <option value="CRAS Leste">CRAS Leste</option>
                                                                    <option value="CRAS Extremo Leste">CRAS Extremo Leste</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 pe-0">
                                                            <div class="form-group form-group-default">
                                                                <label>Função</label>
                                                                <select id="addFuncao" name="funcao" class="form-control" required>
                                                                    <option value="" selected disabled>Selecione a função</option>
                                                                    <option value="Assistente social">Assistente Social</option>
                                                                    <option value="Coordenador">Coordenador</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Email</label>
                                                                <input
                                                                    id="addEmail"
                                                                    name="email"
                                                                    type="email"
                                                                    class="form-control"
                                                                    placeholder="Preencha o email" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 pe-0">
                                                            <div class="form-group form-group-default">
                                                                <label>Senha</label>
                                                                <input
                                                                    id="addPassword"
                                                                    name="senha"
                                                                    type="password"
                                                                    class="form-control"
                                                                    placeholder="Preencha a senha" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Confirme a senha</label>
                                                                <input
                                                                    id="confirmPassword"
                                                                    name="confirma_senha"
                                                                    type="password"
                                                                    class="form-control"
                                                                    placeholder="Confirme a senha" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 pe-0">
                                                            <div class="form-group form-group-default">
                                                                <label>CPF</label>
                                                                <input
                                                                    id="addCpf"
                                                                    name="cpf"
                                                                    type="text"
                                                                    class="form-control"
                                                                    placeholder="Preencha o CPF" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>CRESS</label>
                                                                <input
                                                                    id="addCress"
                                                                    name="cress"
                                                                    type="text"
                                                                    class="form-control"
                                                                    placeholder="Preencha o CRESS" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 pe-0">
                                                            <div class="form-group form-group-default">
                                                                <label>Matrícula</label>
                                                                <input
                                                                    id="addMatricula"
                                                                    name="matricula"
                                                                    type="text"
                                                                    class="form-control"
                                                                    placeholder="Preencha a matrícula" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Foto</label>
                                                                <input
                                                                    id="addFoto"
                                                                    name="foto"
                                                                    type="file"
                                                                    class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>

                                            </div>
                                            <div class="modal-footer border-0">
                                                <button
                                                    type="submit"
                                                    id="enviar"
                                                    class="btn btn-primary">
                                                    Cadastrar
                                                </button>
                                                <button
                                                    type="button"
                                                    class="btn btn-danger"
                                                    data-bs-dismiss="modal">
                                                    Fechar
                                                </button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal de Edição -->
                                <div
                                    class="modal fade"
                                    id="ModalEditar"
                                    tabindex="-1"
                                    role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold"> Editar Assistente</span>
                                                </h5>
                                                <button
                                                    type="button"
                                                    class="close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="editar.php" method="POST" enctype="multipart/form-data" id="formEditarAssistente">
                                                    <div class="row">
                                                        <input type="hidden" id="editId" name="id">
                                                        <div class="col-md-6 pe-0">
                                                            <div class="form-group form-group-default">
                                                                <label>Nome</label>
                                                                <input
                                                                    id="editName"
                                                                    name="nome"
                                                                    type="text"
                                                                    class="form-control"
                                                                    placeholder="Preencha o nome" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Local</label>
                                                                <select id="editOffice" name="local" class="form-control" required>
                                                                    <option value="" selected disabled>Selecione o local</option>
                                                                    <option value="CRAS Sul">CRAS Sul</option>
                                                                    <option value="CRAS Norte">CRAS Norte</option>
                                                                    <option value="CRAS Leste">CRAS Leste</option>
                                                                    <option value="CRAS Extremo Leste">CRAS Extremo Leste</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 pe-0">
                                                            <div class="form-group form-group-default">
                                                                <label>Função</label>
                                                                <select id="editFuncao" name="funcao" class="form-control" required>
                                                                    <option value="" selected disabled>Selecione a função</option>
                                                                    <option value="Assistente social">Assistente Social</option>
                                                                    <option value="Coordenador">Coordenador</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Email</label>
                                                                <input
                                                                    id="editEmail"
                                                                    name="email"
                                                                    type="email"
                                                                    class="form-control"
                                                                    placeholder="Preencha o email" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 pe-0">
                                                            <div class="form-group form-group-default">
                                                                <label>Senha</label>
                                                                <input
                                                                    id="editPassword"
                                                                    name="senha"
                                                                    type="password"
                                                                    class="form-control"
                                                                    placeholder="Preencha a senha" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Confirme a senha</label>
                                                                <input
                                                                    id="confirmEditPassword"
                                                                    name="confirma_senha"
                                                                    type="password"
                                                                    class="form-control"
                                                                    placeholder="Confirme a senha" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 pe-0">
                                                            <div class="form-group form-group-default">
                                                                <label>CPF</label>
                                                                <input
                                                                    id="editCpf"
                                                                    name="cpf"
                                                                    type="text"
                                                                    class="form-control"
                                                                    placeholder="Preencha o CPF" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>CRESS</label>
                                                                <input
                                                                    id="editCress"
                                                                    name="cress"
                                                                    type="text"
                                                                    class="form-control"
                                                                    placeholder="Preencha o CRESS" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 pe-0">
                                                            <div class="form-group form-group-default">
                                                                <label>Matrícula</label>
                                                                <input
                                                                    id="editMatricula"
                                                                    name="matricula"
                                                                    type="text"
                                                                    class="form-control"
                                                                    placeholder="Preencha a matrícula" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Foto</label>
                                                                <input disabled
                                                                    id="editFoto"
                                                                    name="foto"
                                                                    type="file"
                                                                    class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>

                                            </div>
                                            <div class="modal-footer border-0">
                                                <button
                                                    type="submit"
                                                    id="editenviar"
                                                    class="btn btn-primary">
                                                    Salvar Alterações
                                                </button>
                                                <button
                                                    type="button"
                                                    class="btn btn-danger"
                                                    data-bs-dismiss="modal">
                                                    Fechar
                                                </button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>




                                <div class="table-responsive">
                                    <table
                                        id="add-row"
                                        class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Local</th>
                                                <th>Função</th>
                                                <th style="width: 10%">Ações</th>
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
        <!--   Core JS Files   -->
        <script src="assets/js/core/jquery-3.7.1.min.js"></script>
        <script src="assets/js/core/popper.min.js"></script>
        <script src="assets/js/core/bootstrap.min.js"></script>

        <!-- jQuery Scrollbar -->
        <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

        <!-- Chart JS -->
        <script src="assets/js/plugin/chart.js/chart.min.js"></script>

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
            $(document).ready(function() {
                $("#add-row").DataTable({
                    ajax: {
                        url: 'dadosassistentes.php',
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
                            data: null,
                            render: function(data, type, row) {
                                return `
                        <div class="form-button-action">
                            <button type="button" data-bs-toggle="tooltip" title="Editar" class="btn btn-link btn-primary btn-lg btn-edit" data-id="${row.id}">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button type="button" data-id="${row.id}" data-bs-toggle="tooltip" title="Remover" class="btn btn-link btn-danger btn-lg btn-remover" >
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    `;
                            }
                        }
                    ],
                    pageLength: 5,
                    bPaginate: false,
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
                        }
                    }
                });

                document.getElementById('enviar').addEventListener('click', function(event) {
                    var password = document.getElementById('addPassword').value;
                    var confirmPassword = document.getElementById('confirmPassword').value;

                    if (password !== confirmPassword) {
                        event.preventDefault();
                        alert('As senhas não coincidem!');
                    }
                });

                document.getElementById('editenviar').addEventListener('click', function(event) {
                    var password = document.getElementById('editPassword').value;
                    var confirmPassword = document.getElementById('confirmEditPassword').value;

                    if (password !== confirmPassword) {
                        event.preventDefault();
                        alert('As senhas não coincidem!');
                    }
                });

                $(document).on('click', '.btn-edit', function() {
                    var assistenteId = $(this).data('id');
                    console.log('ID do assistente:', assistenteId);

                    $.ajax({
                        url: 'obter_assistente.php',
                        type: 'GET',
                        data: {
                            id: assistenteId
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.error) {
                                alert(data.error);
                            } else {
                                $('#editId').val(data.id);
                                $('#editName').val(data.nome);
                                $('#editOffice').val(data.local);
                                $('#editFuncao').val(data.funcao);
                                $('#editEmail').val(data.email);
                                $('#editCpf').val(data.cpf);
                                $('#editCress').val(data.cress);
                                $('#editMatricula').val(data.matricula);
                                $('#editfoto').val(data.foto);
                                $('#editPassword').val("");
                                $('#confirmEditPassword').val("");

                                $('#ModalEditar').modal('show');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('Erro ao buscar os dados do assistente.');
                        }
                    });
                });

                $('#formEditarAssistente').on('submit', function(e) {
                    e.preventDefault();

                    var formData = {
                        id: $('#editId').val(),
                        nome: $('#editName').val(),
                        local: $('#editOffice').val(),
                        funcao: $('#editFuncao').val(),
                        email: $('#editEmail').val(),
                        cpf: $('#editCpf').val(),
                        cress: $('#editCress').val(),
                        matricula: $('#editMatricula').val(),
                        senha: $('#editPassword').val(),
                        confirma_senha: $('#confirmEditPassword').val(),
                    };

                    $.ajax({
                        url: 'editar.php',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                swal({
                                    title: "Atualizado!",
                                    text: "Assistente atualizado com sucesso.",
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            text: "OK",
                                            value: true,
                                            visible: true,
                                            className: "btn btn-success",
                                            closeModal: true
                                        }
                                    }
                                }).then(function() {
                                    $('#ModalEditar').modal('hide');
                                    $('#add-row').DataTable().ajax.reload();
                                });
                            } else {
                                swal({
                                    title: 'Erro!',
                                    text: response.error,
                                    icon: 'error',
                                    button: 'OK',
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            swal({
                                title: 'Erro ao atualizar os dados.',
                                text: response.error,
                                icon: 'error',
                                button: 'OK',
                            });
                        }
                    });


                });
            });

            $(document).on('click', '.btn-remover', function() {
                var assistenteId = $(this).data('id');
                console.log('ID do usuario a ser removido:', assistenteId);

                swal({
                    title: "Tem certeza?",
                    text: "Você não poderá reverter isso!",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            visible: true,
                            text: "Não, cancelar!",
                            className: "btn btn-danger",
                        },
                        confirm: {
                            text: "Sim, remover!",
                            className: "btn btn-success",
                        },
                    },
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: 'remover_assistente.php',
                            type: 'POST',
                            data: {
                                id: assistenteId
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.error) {
                                    swal("Erro!", data.error, "error", {
                                        buttons: {
                                            confirm: {
                                                className: "btn btn-danger",
                                            },
                                        },
                                    });
                                } else {
                                    swal("Removido!", data.success, "success", {
                                        buttons: {
                                            confirm: {
                                                className: "btn btn-success",
                                            },
                                        },
                                    });
                                    $('#add-row').DataTable().ajax.reload();
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                swal("Erro!", "Ocorreu um erro ao remover o usuário.", "error", {
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-danger",
                                        },
                                    },
                                });
                            }
                        });
                    }
                });
            });

            $(document).ready(function() {
                $('#cadastrarA').submit(function(event) {
                    event.preventDefault();
                    var formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: 'cadastrarA.php',
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                swal({
                                    title: "Sucesso!",
                                    text: response.message,
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            text: "OK",
                                            className: "btn btn-success",
                                        },
                                    },
                                }).then((confirm) => {
                                    if (confirm) {
                                        var myModalEl = document.getElementById('addRowModal');
                                        var modal = bootstrap.Modal.getInstance(myModalEl);
                                        modal.hide();

                                        $('#cadastrarA')[0].reset();

                                        $('#add-row').DataTable().ajax.reload(null, false);
                                    }
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