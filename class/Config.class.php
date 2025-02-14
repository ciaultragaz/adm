
<?php
class Config {
    private static $instance = null;
    private $config = [];
    
    private function __construct() {
        $this->loadConfig();
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function loadConfig() {
        $host = $_SERVER['HTTP_HOST'];
        
        $this->config = [
            'db' => [
                'host' => '165.227.91.84',
                'user' => 'root',
                'password' => 'A@UltraLeste',
                'database' => 'base',
                'port' => '3306'
            ],
            'app' => [
                'domain' => 'https://' . $host . '/',
                'timezone' => 'America/Sao_Paulo',
                'locale' => 'portuguese'
            ]
        ];
    }
    
    public function get($key) {
        return $this->config[$key] ?? null;
    }
}
