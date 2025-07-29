<?php

declare(strict_types=1);


final class UserController extends BaseController
{

    public function dashboardAction(\Base $f3): void
    {

        $f3->set('name', 'HELLO dashboard');
        $vista = new View();
        http_response_code(200);

        echo $vista->render('./views/dashboardView.php');
    }
}
