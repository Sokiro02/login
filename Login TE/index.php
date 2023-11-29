<!DOCTYPE html>
<?php
function getRealIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];

    return $_SERVER['REMOTE_ADDR'];
}

$user_agent = $_SERVER['HTTP_USER_AGENT'];

function getBrowser($user_agent)
{

    if (strpos($user_agent, 'MSIE') !== FALSE)
        return 'Internet Explorer';
    elseif (strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
        return 'Microsoft Edge';
    elseif (strpos($user_agent, 'Trident') !== FALSE) //IE 11
        return 'Internet Explorer';
    elseif (strpos($user_agent, 'Opera Mini') !== FALSE)
        return "Opera Mini";
    elseif (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
        return "Opera";
    elseif (strpos($user_agent, 'Firefox') !== FALSE)
        return 'Mozilla Firefox';
    elseif (strpos($user_agent, 'Chrome') !== FALSE)
        return 'Google Chrome';
    elseif (strpos($user_agent, 'Safari') !== FALSE)
        return "Safari";
    else
        return 'No hemos podido detectar su navegador';
}

function getPlatform($user_agent)
{
    $plataformas = array(
        'Windows 10' => 'Windows NT 10.0+',
        'Windows 8.1' => 'Windows NT 6.3+',
        'Windows 8' => 'Windows NT 6.2+',
        'Windows 7' => 'Windows NT 6.1+',
        'Windows Vista' => 'Windows NT 6.0+',
        'Windows XP' => 'Windows NT 5.1+',
        'Windows 2003' => 'Windows NT 5.2+',
        'Windows' => 'Windows otros',
        'iPhone' => 'iPhone',
        'iPad' => 'iPad',
        'Mac OS X' => '(Mac OS X+)|(CFNetwork+)',
        'Mac otros' => 'Macintosh',
        'Android' => 'Android',
        'BlackBerry' => 'BlackBerry',
        'Linux' => 'Linux',
    );
    foreach ($plataformas as $plataforma => $pattern) {
        if (preg_match('/(?i)' . $pattern . '/', $user_agent))
            return $plataforma;
    }
    return 'Otras';
}

// Validación del IP del visitante
$miip = getRealIP();
// Validación del Navegador
$navegador = getBrowser($user_agent);
// Sistema Operativo
$sistemaoperativo = getPlatform($user_agent);
?>

<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <!-- Design by foolishdeveloper.com -->
    <title>SAECO</title>
    <meta name="description" content="User login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <link rel="stylesheet" href="styles.css">

    <!--/Inicio Alertas-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link href="../assets/css/sweetalert.css" rel="stylesheet">
    <!-- Custom functions file -->
    <script src="../assets/js/functions.js"></script>
    <!-- Sweet Alert Script -->
    <script src="../assets/js/sweetalert.min.js"></script>
    <!--/Fin Alertas-->

    <link rel="apple-touch-icon" sizes="57x57" href="Favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="Favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="Favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="Favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="Favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="Favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="Favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="Favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="Favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="Favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="Favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="Favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Favicon/favicon-16x16.png">
    <link rel="manifest" href="Favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="Favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>

<body>
    <?php
    // Verificar si hay un mensaje de error en el URL
    if (isset($_GET['error'])) {
        $mensajeError = $_GET['error'];
        echo '<div class="error-message">' . htmlspecialchars($mensajeError) . '</div>';
    }
    ?>
    <img id="icono-maquina" src="maquina.png" alt="Icono de Máquina">
	<img id="icono-kp" src="kp.PNG" alt="Icono de Kpisoft">
    <div id="info-saeco">
        <p>Saeco TE</p>
    </div>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <div class="formContainer" id="formContainer">
        <form id="loginForm" class="form" method="post" action="login.php" onsubmit="return validateInputs()">
            <input type="hidden" name="miip" value="<?php echo $miip; ?>">
            <input type="hidden" name="sistemaoperativo" value="<?php echo $sistemaoperativo; ?>">
            <input type="hidden" name="navegador" value="<?php echo $navegador; ?>">

            <h3>Login Saeco</h3>

            <!-- Agrega esta sección al formulario -->
            <div id="generalError" class="error-message"></div>

            <label for="username">Nombre de usuario</label>
            <input type="text" placeholder="Ingrese el usuario" name="txtNombre" id="username" class="input-field" required>
            <div id="usernameError" class="error-message"></div>

            <label for="password">Contraseña</label>
            <input type="password" placeholder="Ingrese la contraseña" name="TxtPass" id="password" class="input-field" required>
            <div id="passwordError" class="error-message"></div>

            <button type="submit">Ingresar</button>
            <br>
            <br>
            <br>
            <p id="forgotLink" onclick="showForgotForm()" class="link">Olvidé mi contraseña</p>
            <a id="manualLink" href="https://transbaruc.com/sofia/Login/manuales/" target="_blank" class="link">Manual de uso</a>
        </form>

        <form id="forgotForm" class="form" method="post" action="login.php" style="display: none;">
            <h3>Recuperar Contraseña</h3>

            <label for="email">Correo Electrónico</label>
            <input type="email" placeholder="Ingrese su correo electrónico" name="email" id="email" class="input-field" required>
            <div id="emailError" class="error-message"></div>

            <div class="button-container">
                <button type="button" onclick="showLoginForm()">Volver</button>
                <button type="button" onclick="validateEmail()">Enviar</button>
            </div>
        </form>
    </div>

    <script>
        function validateEmail() {
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('emailError');
            const invalidChars = /["'=]/;

            // Validación del correo electrónico
            if (invalidChars.test(emailInput.value)) {
                emailError.innerText = 'Correo electrónico inválido.';
                emailInput.style.borderColor = 'red';
            } else {
                emailError.innerText = '';
                emailInput.style.borderColor = '';

                // Envía el formulario después de la validación
                document.getElementById('forgotForm').submit();
            }
        }

        function validateInputs() {
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');
            const usernameError = document.getElementById('usernameError');
            const passwordError = document.getElementById('passwordError');
            const invalidChars = /["'=]/; // Modificado para incluir =, comillas simples y comillas dobles

            // Validación del nombre de usuario
            if (invalidChars.test(usernameInput.value)) {
                usernameError.innerText = 'Nombre de usuario inválido.';
                usernameInput.style.borderColor = 'red';
                return false; // Impide el envío del formulario si hay un error
            } else {
                usernameError.innerText = '';
                usernameInput.style.borderColor = '';
            }

            // Validación de la contraseña
            if (invalidChars.test(passwordInput.value)) {
                passwordError.innerText = 'Contraseña inválida.';
                passwordInput.style.borderColor = 'red';
                return false; // Impide el envío del formulario si hay un error
            } else {
                passwordError.innerText = '';
                passwordInput.style.borderColor = '';
            }

            return true; // Permite el envío del formulario si no hay errores
        }

        function showForgotForm() {
            // Muestra el formulario de olvidar contraseña
            document.getElementById('forgotForm').style.display = 'block';
            document.getElementById('loginForm').style.display = 'none';
        }

        function showLoginForm() {
            // Muestra el formulario de inicio de sesión
            document.getElementById('loginForm').style.display = 'block';
            document.getElementById('forgotForm').style.display = 'none';
        }
    </script>
</body>

</html>