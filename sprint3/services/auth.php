<?php
// define espaços para organização do código
namespace Services;

class Auth{ 
    private array $usuario = [];

    // Método cronstuctor

    public function __construct()
    {
        $this ->carregarUsuarios();
    }

    // Método para carregar os usuários do arquivo JSON
    private function carregarUsuarios(): void
    {
        // Verifica se o arquivo existe e carrega os usuários
        if (file_exists(ARQUIVO_USUARIOS)) {
            // Lê o conteúdo do arquivo JSON e decodifica para um array
            $conteudo = json_decode(file_get_contents(ARQUIVO_USUARIOS), true);

            $this->usuario = is_array($conteudo) ? $conteudo : [];
        } else {
            // Se o arquivo não existir, cria usuarios padrão
            $this->usuario = [

                [
                'username' => 'admin',
                'password' => password_hash('admin123,', PASSWORD_DEFAULT),
                'perfil' => 'admin',
                ],
                [
                'username' => 'usuario',
                'password' => password_hash('user123', PASSWORD_DEFAULT),
                'perfil' => 'usuario',
                ],
                [
                'username' => 'Gabriel',
                'password' => password_hash('user123', PASSWORD_DEFAULT),
                'perfil' => 'admin',
                ]
            ];
            $this->salvarUsuarios();
        }
    }

    // Método para salvar os usuários no arquivo JSON
    private function salvarUsuarios(): void
    {
        $dir = dirname(ARQUIVO_USUARIOS);
        // Verifica se o diretório existe, caso contrário cria
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        // Salva os usuários no arquivo JSON
        file_put_contents(ARQUIVO_USUARIOS, json_encode($this->usuario, JSON_PRETTY_PRINT));
    }

    // Método para login
    public function login(string $username, string $password): bool
    {
        // Verifica se o usuário existe e a senha está correta
        foreach ($this->usuario as $usuario) {
            if ($usuario['username'] === $username && password_verify($password, $usuario['password'])) {
                
                $_SESSION['auth'] = [
                    'logado' => true,
                    'username' => $username,
                    'perfil' => $usuario['perfil'],
                ];
                return true; // Login bem-sucedido
            }
        }
        return false;// Login falhou
    }

    public function logout(): void
    {
        session_destroy();
    }

    // verifica se o usuário está logado
    public static function verificarLogin(): bool {
        return isset($_SESSION['auth']) && $_SESSION['auth']['logado'] === true;
    }

    public static function isPerfil(string $perfil): bool
    {
        return isset($_SESSION['auth']) && $_SESSION['auth']['perfil'] === $perfil;
    }

    public static function isAdmin(): bool
    {
        return self::isPerfil('admin');
    }

    public static function getUsuario(): ?array
    {
        // retorna os dados da sessao ou nulo se nao existir
        return $_SESSION['auth'] ?? null;
    }

}

?>