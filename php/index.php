<?php
require_once("conexao.php");

// Variável para armazenar mensagens de erro
$error_message = "";
$success_message = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processa os dados do formulário
    $email_telefone = $_POST["email_telefone"];
    $nome_usuario = $_POST["nome_usuario"];
    $senha = $_POST["senha"]; // A senha em texto plano fornecida pelo usuário
    $confirmacao_senha = $_POST["confirmacao_senha"];

    // Verifica se a senha e a confirmação de senha coincidem
    if ($senha !== $confirmacao_senha) {
        $error_message = "A senha e a confirmação de senha não coincidem.";
    } else {
        // Verifica se o e-mail já está cadastrado
        $sql_check_email = "SELECT COUNT(*) AS total FROM usuarios WHERE email_telefone = :email";
        $stmt_check_email = $conn->prepare($sql_check_email);
        $stmt_check_email->bindParam(":email", $email_telefone);
        $stmt_check_email->execute();
        $result_check_email = $stmt_check_email->fetch(PDO::FETCH_ASSOC);

        if ($result_check_email['total'] > 0) {
            // E-mail já cadastrado, exibe o alerta de erro
            $error_message = "Este e-mail já está cadastrado.";
        } else {
            // Hash das senhas
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            // Insere os dados na tabela de usuários
            $sql = "INSERT INTO usuarios (email_telefone, nome_usuario, senha) VALUES (:email_telefone, :nome_usuario, :senha)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":email_telefone", $email_telefone);
            $stmt->bindParam(":nome_usuario", $nome_usuario);
            $stmt->bindParam(":senha", $senha_hash); // Inserindo a senha hash no banco de dados

            // Tente executar a consulta
            try {
                $stmt->execute();
                // Verifica se a inserção foi bem-sucedida
                if ($stmt->rowCount() > 0) {
                    // Usuário cadastrado com sucesso
                    $success_message = "Usuário cadastrado com sucesso! Faça Login!";
                } else {
                    $error_message = "Erro ao cadastrar usuário.";
                }
            } catch (PDOException $e) {
                // Em caso de erro, exibe a mensagem de erro
                $error_message = "Erro ao executar a consulta: " . $e->getMessage();
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./slider.css">
  

    <title>Sun Place</title>
</head>

<body>
    <header>
        <div class="interface">
            <div class="logo">
                <a href="#">
                    <img src="./img/Logo-Sun_Place-Market.png" alt="">
                </a>
            </div><!--fecha a tag Logo -->

            <nav class="menu-desktop">
                <ul>
                    <li><a href="#home"><i class="fa-solid fa-circle-h"></i>Home</a></li>
                    <li><a href="#sobre"><i class="fa-solid fa-magnifying-glass-chart"></i></i>Sobre</a></li>
                    <li><a href="#cadastrar-se"><i class="fa-solid fa-users-line"></i></i> Cadastrar-se</a></li>


                    <button><a href="https://www.instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i></a></button>
                    <button><a href="https://www.facebook.com" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></button>
                    <button><a href="https://www.youtube.com" target="_blank"><i class="fa-brands fa-youtube"></i></a></button>




                </ul>
            </nav>
            <div class="login">
                <form method="post" action="catalogo.html">
                    <label for="usuario">Usuário</label>
                    <input type="text" name="email_telefone" placeholder="Usuário" required>
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Senha" required>
                    <button type="submit" name="login" class="botao-cadastrar custom-button">Entrar</button>
                </form>
            </div>
        </div>
        </div><!--fecha a tag interface-->
    </header>


    </header>

    <section class="slider">
        <div class="slider-content">
            <input type="radio" name="radio-btn" id="radio1">
            <input type="radio" name="radio-btn" id="radio2">
            <input type="radio" name="radio-btn" id="radio3">

            <div class="slide-box primeiro">
                <img class="img-desktop" src="img/energia-solar-fotovoltaica-1.jpg" alt="slide 1">
            </div>

            <div class="slide-box">
                <img class="img-desktop" src="img/casa-solar-03.png" alt="slide 3">
            </div>

            <div class="slide-box">
                <img class="img-desktop" src="img/taxa-energia-solar.jpg" alt="slide 3">
            </div>

            <div class="auto-btn1"></div>
            <div class="auto-btn2"></div>
            <div class="auto-btn3"></div>
        </div>
    </section>

    <section id="home">
        <div class="container1">
            <h2>Home</h2>
            <p>Bem-vindo ao SUN PLACE, seu destino único para tudo relacionado à energia renovável! Aqui, no SUN PLACE,
                estamos empenhados em oferecer a você uma experiência de compra excepcionalmente brilhante e
                sustentável. Navegue por nossa ampla seleção de produtos de energia renovável, desde kits solares até
                acessórios e muito mais.

                Nossa missão é capacitar você a abraçar um estilo de vida mais verde e consciente, fornecendo soluções
                inovadoras e acessíveis para suas necessidades energéticas.
                Com o SUN PLACE, você pode contar não apenas com produtos de alta qualidade, mas também com o
                conhecimento e suporte necessários para embarcar em sua jornada de energia renovável com confiança.

                Junte-se a nós e faça parte da revolução da energia limpa. Seja o sol em seu próprio mundo com o SUN
                PLACE!</p>

            <div class="banner"><img src="./img/ecolumi-banner-energia-solar.jpg" alt=""></div>
        </div>
    </section>

    <section id="sobre">
        <div class="container1">
            <h2>Sobre</h2>
            <p>No SUN PLACE, acreditamos firmemente no poder transformador da energia renovável. Fundado com a visão de
                criar um mundo mais sustentável e próspero, o SUN PLACE é mais do que apenas um mercado de produtos de
                energia limpa - é um catalisador para a mudança positiva.

                Desde o início, nos dedicamos a oferecer uma plataforma abrangente e acessível para aqueles que desejam
                adotar um estilo de vida mais ecológico e independente energeticamente. Nossa equipe apaixonada e
                experiente está aqui para orientá-lo em cada passo do caminho, desde a seleção dos melhores produtos até
                a implementação eficiente de soluções energéticas renováveis.

                Com o SUN PLACE, você não está apenas comprando produtos - você está investindo em um futuro mais
                brilhante para o nosso planeta e para as gerações futuras. Junte-se a nós nesta jornada rumo a um mundo
                mais sustentável e deixe sua marca positiva com cada escolha que faz.

                Seja parte da mudança. Seja parte do SUN PLACE.</p>

            <div class="banner-sobre"><img src="./img/sobre-banner-2.png" alt=""></div>
        </div>
    </section>

    <section id="cadastrar-se">
        <div class="container2">
            <h2>Cadastrar-se</h2>
            <form id="registration-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                <!-- Exibir mensagem de erro aqui -->
                <?php if (!empty($error_message)) : ?>
                    <p class="error-message"><?php echo $error_message; ?></p>
                <?php endif; ?>

                <label for="Email">Informe seu e-mail ou telefone</label>
                <input type="text" name="email_telefone" placeholder="email ou telefone" required>

                <label for="Nome-usuário">Nome de Usuário</label>
                <input type="text" name="nome_usuario" placeholder="Login" required>

                <label for="Password">informe sua senha</label>
                <input type="password" name="senha" placeholder="senha" required>

                <label for="Confirme-password">Confirme sua senha</label>
                <input type="password" name="confirmacao_senha" placeholder="Digite novamente a senha" required>

                <!--Botão criar usuário-->
                <button type="submit" class="botao-cadastrar custom-button">Criar usuário</button>

            </form>

            <button id="btnVoltarTopo" onclick="voltarAoTopo()"><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i></button>


        </div>
    </section>


    <script src="https://kit.fontawesome.com/6dda5f6271.js" crossorigin="anonymous"></script>
    <script src="slider.js" defer></script>

    <!-- Exibir mensagem de sucesso aqui -->
    <?php if (!empty($_GET['success']) && $_GET['success'] == 'true') : ?>
        <script>
            alert("Usuário cadastrado com sucesso! Faça Login!");
        </script>
    <?php endif; ?>


</body>

</html>