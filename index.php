<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlowCare - Login</title>
    <link rel="stylesheet" href="style.css">
    </head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1>Bem-vindo ao FlowCare</h1>
            <p>Faça login para acessar sua conta.</p>

            <form id="loginForm" action="login.php" method="POST">

                <div class="input-group">
                    <label for="username">E-mail</label>
                    <input type="text" id="username" name="email_usuario" placeholder="Seu e-mail" required>
                </div>

                <div class="input-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="senha_usuario" placeholder="Sua senha" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility()">👁️</span> </div>

                <div class="options-group">
                    <div class="remember-me">
                        <input type="checkbox" id="rememberMe" name="rememberMe">
                        <label for="rememberMe">Lembrar-me</label>
                    </div>
                    <a href="#" class="forgot-password">Esqueceu a senha?</a>
                </div>

                <button type="submit" class="btn-login">Entrar</button>

                <div class="social-login">
                    <p>Ou entre com:</p>
                    <div class="social-buttons">
                        <button type="button" class="btn-social google">Google</button>
                        <button type="button" class="btn-social facebook">Facebook</button>
                    </div>
                </div>

                <p class="signup-link">Não tem uma conta? <a href="cadastro.html">Cadastre-se</a></p>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
    <script>
        // Função para mostrar/ocultar senha (pode ser movida para script.js)
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const toggleBtn = document.querySelector('.toggle-password');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleBtn.textContent = '🔒'; // Ícone de cadeado fechado
            } else {
                passwordField.type = 'password';
                toggleBtn.textContent = '👁️'; // Ícone de olho
            }
        }

        // Exemplo de validação básica (pode ser expandida em script.js)
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            if (username.trim() === '' || password.trim() === '') {
                alert('Por favor, preencha todos os campos.');
                event.preventDefault(); // Impede o envio do formulário
            }
            // Adicionar validação mais complexa aqui (e-mail, senha forte, etc.)
        });
    </script>
</body>
</html>
