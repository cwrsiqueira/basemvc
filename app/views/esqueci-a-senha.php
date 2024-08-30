<div class="auth-container">
    <div class="auth-box">
        <div class="logo-container text-center mb-4">
            <a href="<?= URL ?>">
                <img src="<?= URL; ?>public/assets/img/logo.webp" alt="Logomarca PalpiteiroFC" width="100">
            </a>
        </div>

        <h2 class="auth-title">Esqueci a Senha</h2>
        <form method="post" class="auth-form">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control form-control-lg" id="email" placeholder="Digite seu email"
                    required>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success btn-lg w-100">Recuperar Senha</button>
            </div>
            <div class="text-center mt-3">
                <a href="<?= URL ?>login" class="text-decoration-none">Lembrou a senha? Faça login</a>
            </div>
        </form>
    </div>
</div>