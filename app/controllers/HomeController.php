<?php

declare(strict_types=1);


final class HomeController extends BaseController
{

    public function homeAction(\Base $f3): void
    {

        var_dump($this->getMySQLConnect());

        $f3->set('name', 'HELLO HORLD');
        $vista = new View();
        echo $vista->render('./views/home.php');
    }

    public function schoolAction(\Base $f3): void
    {


        var_dump($this->getMySQLConnect());

        $f3->set('name', 'EEST3NECOCHEA');
        $vista = new View();
        echo $vista->render('./views/school.html');
    }
}
