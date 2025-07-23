<?php


declare(strict_types=1);



abstract class BaseController
{

    /**
     * This method is called before the route is executed.
     * It can be used to perform actions such as authentication, logging, etc.
     * @param \Base $f3 The Fat-Free Framework instance
     * @return bool
     */
    public function beforeRoute(\Base $f3, array $routes): void {}


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

    protected function outputErrorResponse(\Base $f3, string $message, int $code = 400): void
    {
        http_response_code($code);
        header('Content-Type: application/json');
        header('charset: UTF-8');
        header('status: error');
        echo json_encode(['error' => $message]);
    }

    protected function outputHtmlResponse(string $html): void
    {
        http_response_code(200);
        echo $html;
    }

    protected function authorize(\Base $f3): bool
    {
        // Implement authorization logic here
        // For example, check if the user is logged in
        if (!$f3->get('SESSION.user')) {
            $this->outputErrorResponse($f3, 'Unauthorized', 401);
            return false;
        }
        return true;
    }

    protected function isPublicRoute(\Base $f3): void
    {
        // Check if the current route is public
        var_dump($f3);
    }
}
