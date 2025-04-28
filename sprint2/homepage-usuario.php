
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADM - Locadora de Veículos</title>

    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Link ícones do bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg primary-bg-color py-4 px-2" id="navbar">
        <div class="container">
            <a class="navbar-brand text-black" href="#navbar">ServHub</a>
            <button class="navbar-toggler text-black" type="button" data-bs-toggle="collapse" data-bs-target="#bottom-navbar"
            aria-controls="bottom-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list"></i>
          </button>
            <div id="navbar-items" class="w-100">
                <div class="container col-sm-10 mx-2" id="formulario">
                    <form class="d-flex" id="search-form">
                    <i class="bi bi-search text-black mt-2"></i>
                    <input class="form-control me-2 bg-transparent text-white" type="search" placeholder="Busque um funcionário..."
                        aria-label="Search">
                    <button class="btn secondary-bg-color text-black" type="submit">Pesquisar</button>
                    </form>
                </div>
                <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                <li class="nav-item disable mx-3">
                    <a class="nav-link text-black" href="#">HOME</a>
                </li>
                <li class="nav-item disable mx-3">
                    <a class="nav-link text-black" href="#">
                        CONTA
                    </a>
                </li>
                <li class="nav-item disable mx-3">
                    <a class="nav-link text-white" href="#" id="logout">
                        LOGOUT
                    </a>
                </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="py-4 mx-2">
        
            <!-- Conteúdo Principal -->
        <div class=" container mt-4">


            <div class="row">
                <!-- Coluna principal -->
                <div class="col-md-8">
                    <div class="card mb-4" id="principal">
                        <div class="card-body d-flex flex-row justify-content-between">
                            <div>
                                <h1 class="card-title">ServHub</h5>
                                <p class="card-text">Conectando talentos e impulsionando oportunidades!</p>
                            </div>
                            <img style="width: 250px;" src="Assets/logo.png" alt="" class="img-fluid">
                        </div>
                    </div>

                    <div class="card mb-4" id="responsivo">
                        <div class="card-body d-flex flex-row justify-content-around">
                            <img style="width: 50px;" src="Assets/usuario.png" alt="" class="img-fluid">
                            <button id="saiba" class="btn btn-success">Editar perfil</button>
                        </div>
                    </div>


                    <!-- Grid de produtos -->
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <div class="card">
                                <img src="Assets/profissional1.png" alt="advogado" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Paulo Mathias</h5>
                                    <p class="card-text">Advogado.</p>
                                    <button id="saiba" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#adv">Saiba mais...</button>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <div class="card">
                                <img src="Assets/profissional2.png" alt="secretária" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Paloma de Oliveira</h5>
                                    <p class="card-text">Secretária.</p>
                                    <button id="saiba" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#adv">Saiba mais...</button>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="col-md-4" id="sidebar">
                    <!-- usuario -->
                    <div class="card mb-4">
                        <div class="card-body d-flex flex-column align-items-center">
                            <img style="width: 200px;" src="Assets/usuario.png" alt="">
                            <h3 class="card-title">Lúcia Andrade</h5>
                            <p style="font-size: 0.8rem;"  class="mt-0">luciaandrade23@gmail.com</p>
                            <p class="mx-4 text-center">Sou Lucia Andrade, contadora com experiência em gestão financeira, planejamento tributário e análise contábil. Meu objetivo é fornecer soluções precisas e eficientes, ajudando empresas a otimizar seus processos, sempre com foco em conformidade e resultados de excelência.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <!-- Grid de produtos -->
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <div class="card">
                                <img src="Assets/profissional3.png" alt="professor" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">João Gomes</h5>
                                    <p class="card-text">Professor.</p>
                                    <button id="saiba" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#prof">Saiba mais...</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <div class="card">
                                <img src="Assets/profissional4.png" alt="emgenheiro civil" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Levi da Silva</h5>
                                    <p class="card-text">Engenheiro civil.</p>
                                    <button id="saiba" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#eng">Saiba mais...</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>


        <!-- Modais profissionais -->
        <div class="modal fade" id="adv">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="d-flex flex-column">
                            <h2>Paulo Mathias</h2>
                            <p>Advogado.</p>
                        </div>
                    </div>
                    <div class="modal-body">
                        <h5>Informações</h5>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur voluptatibus quo quisquam qui saepe quas dolor quidem ipsum delectus labore voluptas esse, excepturi aut sequi libero! Illo sint quo maiores.</p>
                        <form action="post" class="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="sec">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="d-flex flex-column">
                            <h2>Paloma de Oliveira</h2>
                            <p>Secretária.</p>
                        </div>
                    </div>
                    <div class="modal-body">
                        <h5>Informações</h5>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur voluptatibus quo quisquam qui saepe quas dolor quidem ipsum delectus labore voluptas esse, excepturi aut sequi libero! Illo sint quo maiores.</p>
                        <form action="post" class="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="prof">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="d-flex flex-column">
                            <h2>João Gomes</h2>
                            <p>Professor.</p>
                        </div>
                    </div>
                    <div class="modal-body">
                        <h5>Informações</h5>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur voluptatibus quo quisquam qui saepe quas dolor quidem ipsum delectus labore voluptas esse, excepturi aut sequi libero! Illo sint quo maiores.</p>
                        <form action="post" class="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="eng">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="d-flex flex-column">
                            <h2>Levi da Silva</h2>
                            <p>Engenheiro civil.</p>
                        </div>
                    </div>
                    <div class="modal-body">
                        <h5>Informações</h5>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur voluptatibus quo quisquam qui saepe quas dolor quidem ipsum delectus labore voluptas esse, excepturi aut sequi libero! Illo sint quo maiores.</p>
                        <form action="post" class="">

                        </form>
                    </div>
                </div>
            </div>
        </div>

        

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>