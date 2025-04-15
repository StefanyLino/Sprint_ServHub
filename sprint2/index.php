<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>ServHub</title>
</head>


<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    *{
        font-family: "Poppins", sans-serif;
        font-weight: bold;
        margin: 0;
        padding: 0;
        border: 0;
        list-style: none;
    }
    body{
        width: 100%;
        height: 90.3vh;
    }
    #background {
        background: url(Assets/Servhub.png);
        background-size:cover;
        margin: 0;
        width: 100%;
        height: 100%;
    }
    #Nav {
        background-color: #BEBAD9;
        height: 80px;
    }
    .link-custom {
        text-decoration: none;
        text-align: center;
        font-size: 1.2rem;
    }
    ul{
        width: 150px;
        justify-content: space-around;
        align-items: center;
        margin: 0;
    }

    main{
        justify-content: center;
        align-items: center;
    }

    #login {
        padding: 8px 16px;
        border-radius: 10px;
        background-color: #320A59;
        color: white;
        box-shadow: 3px 3px 2px black;
        margin-right: 20px;
    }

    #principal{
        height: 85vh;
    } 

    .botão {
        margin-top: 270px;
        padding: 15px 18px;
        color: white;
        text-decoration: none;
        font-size: 2rem;
        background-color: #320A59;
        border-radius: 10px;
        box-shadow: 3px 3px 3px black;
    }

    .brand-custom{
        margin-left: 15px;
        font-size: 1.6rem;
    }
    @media (min-width: 427px) and (max-width: 768px){
        #background{
            background-image: url(Assets/ServHub-tablet.png);
        }
        .botão{
            margin-top: 130px;
        }
    }
    @media screen and (max-width: 320px){
        #background{
            background-image: url(Assets/ServHub-cel.png);
        }
        .botão{
            margin-top: 150px;
            padding: 10px 13px;
            font-size: 1.4rem;
        }
        #login {
            padding: 8px 16px;
            font-size: 1rem;
            margin-right: 0;
        }
    }
    @media (min-width: 321px) and (max-width: 376px){
        #background{
            background-image: url(Assets/ServHub-426.png);
        }
        .botão{
            margin-top: 150px;
            padding: 10px 13px;
            font-size: 1.4rem;
        }
    }
    @media (min-width: 377px) and (max-width: 426px){
        #background{
            background-image: url(Assets/ServHub-426.png);
        }
        .botão{
            margin-top: 220px;
            padding: 10px 13px;
            font-size: 1.4rem;
        }
    }

</style>


<body id="background">
    <nav class="navbar" id="Nav">
        <div class="container-fluid">
            <a href="#" class="brand-custom navbar-brand">ServHub</a>
            <ul class="d-flex">
                <li ><a href="Login.php" class="link-custom" id="login">Login</a></li>
            </ul>
        </div>
    </nav>
    <main class="d-flex container" id="principal">
        <a href="cadastro.php" class="botão">Comece já</a>
    </main>
</body>
</html>