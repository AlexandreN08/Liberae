


<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

        <style>
       

        .navbar {
            background-color: white;
            padding: 10px 0;
            position: static;
        }

        .navbar-brand img {
            max-height: 60px;
        }

        .navbar a {
            color: black;
            font-size: 18px;
            margin: 0 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .navbar a:hover {
            color: #E0F008;
        }

        .navbar-toggler {
            border: none;
            outline: none;
        }

        .navbar-toggler-icon {
            background-color: white;
        }

        .navbar-nav {
            text-align: center;
            margin: 0 auto;
            font-weight: bold;
            
        }
    </style>

   
    
    <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="logo.png" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="tela_inicial.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cadastro.php">Cadastrar</a>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Autorização
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="autorizacao.php">Liberar Funcionários</a></li>
                        <li><a class="dropdown-item" href="retorno.php">Retornos</a></li>
                        <li><a class="dropdown-item" href="atrasos.php">Atrasos</a></li>
                    </ul>
                   
                </li>
              
                
                <li class="nav-item">
                    <a class="nav-link" href="addFerias.php">Férias</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Liberação
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="liberados.php">Liberados</a></li>
                        <li><a class="dropdown-item" href="listaLiberados.php">Lista de Liberados/Retorno</a></li>
                        <li><a class="dropdown-item" href="mostrarLista.php">Baixar Lista de Férias</a></li>
                    </ul>
                </li>
                <li class="nav-item">
    <a class="nav-link" href="logout.php">Sair</a>
</li>

            </ul>
           
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

</head>

<body>
   
</body>

</html>
