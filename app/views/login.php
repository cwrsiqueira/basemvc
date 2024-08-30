<div class="auth-container">
    <div class="auth-box">
        <div class="logo-container text-center mb-4">
            <a href="<?= URL ?>">
                <img src="<?= URL; ?>public/assets/img/logo.webp" alt="Logomarca PalpiteiroFC" width="100">
            </a>
        </div>

        <?php if (!empty($_SESSION['alert']['msg'])) {
            echo $_SESSION['alert']['msg'];
            unset($_SESSION['alert']['msg']);
        } ?>

        <h2 class="auth-title">Login</h2>
        <form method="post" class="auth-form" action="<?= URL ?>login/logar">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email"
                    class="form-control form-control-lg <?php @$_SESSION['alert']['campo'] == 'email' ? 'border-danger' : ''; ?>"
                    id="email" name="email" value="<?= @$_SESSION['alert']['old']['email'] ?? ''; ?>"
                    placeholder="Digite seu email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <div class="input-group">
                    <input type="password"
                        class="form-control form-control-lg <?php @$_SESSION['alert']['campo'] == 'password' ? 'border-danger' : ''; ?>"
                        id="password" name="password" placeholder="Digite sua senha" aria-label="Digite sua senha"
                        aria-describedby="basic-password">
                    <span class="input-group-text" id="basic-password" style="cursor: pointer;"
                        onclick="showPassword();"><i class="fa-regular fa-eye"></i></span>
                </div>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success btn-lg w-100">Entrar</button>
            </div>
            <div class="text-center mt-3">
                <a href="<?= URL ?>login/esqueci-a-senha" class="text-decoration-none">Esqueceu sua senha?</a>
            </div>
        </form>
        <hr>
        <p class="text-center">Não tem uma conta? <a href="<?= URL ?>login/cadastro"
                class="text-decoration-none">Cadastre-se</a></p>
    </div>
</div>

<script>
    function showPassword() {
        let password = document.querySelector('#password');
        let eye = document.querySelector('#basic-password i');
        (password.getAttribute('type') === 'password') ? password.setAttribute('type', 'text'): password.setAttribute('type', 'password');
        changeEye(eye);
    }

    function changeEye(element) {
        console.log(element.classList.contains('fa-eye'))
        if (element.classList.contains('fa-eye')) {
            element.classList.remove('fa-eye');
            element.classList.add('fa-eye-slash');
        } else if (element.classList.contains('fa-eye-slash')) {
            element.classList.add('fa-eye');
            element.classList.remove('fa-eye-slash');
        }
    }
</script>