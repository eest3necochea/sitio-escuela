<?php

declare(strict_types=1);


final class UserController extends BaseAuthController
{

    public function dashboardAction(\Base $f3): void
    {

        $f3->set('name', 'HELLO HORLD');
        $vista = new View();
        echo $vista->render('./views/dashboardView.php');
    }
}
