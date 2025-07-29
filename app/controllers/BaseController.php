<?php


declare(strict_types=1);



abstract class BaseController
{

    public $dbMySQL = null;


    public function __construct()
    {
        $this->dbMySQL = new \DB\SQL(
            'mysql:host=' . Config::DB_MYSQL_HOST . ';port=' . Config::DB_MYSQL_PORT . ';dbname=' . Config::DB_MYSQL_NAME . '',
            Config::DB_MYSQL_USERNAME,
            Config::DB_MYSQL_PASSWORD
        );
    }

    public function getMySQLConnect(): \DB\SQL
    {
        return $this->dbMySQL;
    }

    /**
     * This method is called before the route is executed.
     * It can be used to perform actions such as authentication, logging, etc.
     * @param \Base $f3 The Fat-Free Framework instance
     * @param array $routes The routes that are being matched
     */
    public function beforeRoute(\Base $f3, array $routes): void
    {
        // verficar si la ruta es publica o privada
        // Si es privada, verificar si el usuario está autenticado
        // Si no está autenticado, redirigir a la página de inicio de sesión o devolver un error 401
        if ($this->isPrivateRoute($f3, $routes)) {
            if (!$f3->get('SESSION.user')) {
                $this->outputErrorResponse('Unauthorized', 401);
                exit;
            }
        }
    }

    /**
     * This method is called after the route is executed.
     * It can be used to perform actions such as logging, cleanup, etc.
     * @param \Base $f3 The Fat-Free Framework instance
     * @return bool 
     */
    public function afterRoute(\Base $f3): void
    {
        // This method can be overridden in child classes to perform actions after the route is executed
    }


    protected function outputJsonResponse(array $data): void
    {
        http_response_code(200);
        header('Content-Type: application/json');
        header('charset: UTF-8');
        header('status: success');
        header('Access-Control-Allow-Origin: *'); // Allow CORS for all origins
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
        header('Access-Control-Max-Age: 86400'); // Cache preflight response for 24 hours
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
        echo json_encode($data);
    }

    protected function outputErrorResponse(string $message, int $code): void
    {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode(['error' => $message]);
    }

    protected function outputHtmlResponse(string $html): void
    {
        http_response_code(200);
        echo $html;
    }

    protected function authorize(\Base $f3): bool
    {
        if (!$f3->get('SESSION.user')) {
            $this->outputErrorResponse('Unauthorized', 401);
            return false;
        }
        return true;
    }

    protected function isPrivateRoute(\Base $f3, array $routes): bool
    {
        foreach ($f3->get('routing') as $scope => $routing) {
            foreach ($routing as $method => $route) {
                foreach ($route as $name => $path) {
                    if ($routes[0] === $path && $scope === 'private') {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}
