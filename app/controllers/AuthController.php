<?php

declare(strict_types=1);


final class AuthController extends BaseController
{
    public function loginAction(\Base $f3): void
    {
        // Implement login logic 
        $f3->set('SESSION.user', 'exampleUser'); // Example user session
        // redirige a la ruta privada después de iniciar sesión
        $f3->reroute(Config::URL_BASE . '/user/dashboard'); // Redirect to user dashboard after login

    }

    public function logoutAction(\Base $f3): void
    {
        // Implement logout logic here

        $f3->clear('SESSION.user'); // Clear the user session
        $f3->clear('SESSION'); // Clear the entire session
        $f3->reroute(Config::URL_BASE);
    }


    public function registerAction(): void
    {
        $this->outputJsonResponse([
            'message' => 'Register action not DARDO yet.',
        ]);
    }
}
