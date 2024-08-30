<?php

namespace App\Controllers;

if (!defined('ACCESS_ALLOWED')) {
    die('Acesso direto não permitido');
}

use App\Core\Controller;
use App\Models\ContaCredito;
use App\Models\Usuario;

class Login extends Controller
{
    private ?array $data = ['pagina' => 'Login'];

    public function index(): void
    {
        $this->loadTemplate('login', $this->data);
    }

    public function logar()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);

        if (!$email) {
            $_SESSION['alert'] = [
                'campo' => 'email',
                'msg' => "<div class='alert alert-danger' role='alert'>O campo Email é obrigatório.</div>",
                'old' => [
                    'email' => $email,
                ],
            ];
            header("Location: " . URL . "login");
            exit;
        }

        if (!$password) {
            $_SESSION['alert'] = [
                'campo' => 'password',
                'msg' => "<div class='alert alert-danger' role='alert'>O campo Senha é obrigatório.</div>",
                'old' => [
                    'email' => $email,
                ],
            ];
            header("Location: " . URL . "login");
            exit;
        }

        $usuario = new Usuario();

        if (!$usuario = $usuario->login($email, $password)) {
            header("Location: " . URL . "login");
            exit;
        }

        $_SESSION['loggedUser'] = $usuario;

        header("Location: " . URL);
    }

    public function cadastro(): void
    {
        $this->loadTemplate('cadastro', $this->data);
    }

    public function cadastrar(): void
    {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
        $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_DEFAULT);

        if (!$username) {
            $_SESSION['alert'] = [
                'campo' => 'username',
                'msg' => "<div class='alert alert-danger' role='alert'>O campo Nome de Usuário é obrigatório.</div>",
                'old' => [
                    'username' => $username,
                    'email' => $email,
                ],
            ];
            header("Location: " . URL . "login/cadastro");
            exit;
        }

        if (!$email) {
            $_SESSION['alert'] = [
                'campo' => 'email',
                'msg' => "<div class='alert alert-danger' role='alert'>O campo Email é obrigatório.</div>",
                'old' => [
                    'username' => $username,
                    'email' => $email,
                ],
            ];
            header("Location: " . URL . "login/cadastro");
            exit;
        }

        if (!$password) {
            $_SESSION['alert'] = [
                'campo' => 'password',
                'msg' => "<div class='alert alert-danger' role='alert'>O campo Senha é obrigatório.</div>",
                'old' => [
                    'username' => $username,
                    'email' => $email,
                ],
            ];
            header("Location: " . URL . "login/cadastro");
            exit;
        }

        if (!$confirm_password) {
            $_SESSION['alert'] = [
                'campo' => 'confirm_password',
                'msg' => "<div class='alert alert-danger' role='alert'>O campo Confime sua senha é obrigatório.</div>",
                'old' => [
                    'username' => $username,
                    'email' => $email,
                ],
            ];
            header("Location: " . URL . "login/cadastro");
            exit;
        }

        if ($password !== $confirm_password) {
            $_SESSION['alert'] = [
                'campo' => 'confirm_password',
                'msg' => "<div class='alert alert-danger' role='alert'>Os campos Senha e Confirme sua senha devem ser iguais.</div>",
                'old' => [
                    'username' => $username,
                    'email' => $email,
                ],
            ];
            header("Location: " . URL . "login/cadastro");
            exit;
        }

        if (strlen($password) < 6) {
            $_SESSION['alert'] = [
                'campo' => 'password',
                'msg' => "<div class='alert alert-danger' role='alert'>A senha deve ter pelo menos 6 caracteres. As senhas mais seguras são as aleatórias.</div>",
                'old' => [
                    'username' => $username,
                    'email' => $email,
                ],
            ];
            header("Location: " . URL . "login/cadastro");
            exit;
        }

        $usuario = new Usuario();
        if ($usuario->exists($email)) {
            $_SESSION['alert'] = [
                'campo' => '',
                'msg' => "<div class='alert alert-danger' role='alert'>Usuário já cadastrado. Faça o <a href='" . URL . "login' class='alert-link'>LOGIN</a>.</div>",
                'old' => [],
            ];
            header("Location: " . URL . "login/cadastro");
            exit;
        }

        if (!$usuario = $usuario->cadastrar(['nome' => $username, 'email' => $email, 'senha' => $password])) {
            $_SESSION['alert'] = [
                'campo' => '',
                'msg' => "<div class='alert alert-danger' role='alert'>Algo deu errado! Tente novamente.</div>",
                'old' => [],
            ];
            header("Location: " . URL . "login/cadastro");
            exit;
        }

        $_SESSION['loggedUser'] = $usuario;

        header("Location: " . URL);
    }

    public function confirmarEmail(string $token): void
    {
        echo '<pre>';
        var_dump($token);
        echo '</pre>';
        exit;
    }

    public function esqueciASenha(): void
    {
        $this->loadTemplate('esqueci-a-senha', $this->data);
    }

    public function recuperarSenha(string $email)
    {
        echo '<pre>';
        var_dump($email);
        echo '</pre>';
        exit;
    }

    public function alterarSenha(string $token)
    {
        echo '<pre>';
        var_dump($token);
        echo '</pre>';
        exit;
    }

    public function deslogar()
    {
        unset($_SESSION['loggedUser']);
        header("Location: " . URL);
    }
}
