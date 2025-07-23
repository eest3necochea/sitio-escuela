<?php

declare(strict_types=1);


final class HomeController extends BaseController
{

    public function homeAction(\Base $f3): void
    {

        $f3->set('name', 'world');
        $vista = new View();
        echo $vista->render('./views/home.html');
    }

    public function schoolAction(\Base $f3): void
    {

        $f3->set('name', 'EEST3NECOCHEA');
        $vista = new View();
        echo $vista->render('./views/school.html');
    }
}
