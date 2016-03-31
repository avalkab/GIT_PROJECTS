<?php
    function __autoload($class) {
        echo $class;
    }

    include('helpers/Patterns/Singleton/Singleton.php');
    include('cores/App/core/AppFactory.php');
    include('cores/App/App.php');

    $app = Era\Core\App\App::instance();
    $companent = $app->factory->buildCompanent();

    class DrumSet extends ACompanentAdapter implements ICompanent {
        public $version = '1.1.21';
    }

    $companent->bind('drumSet', new DrumSet);
    echo $companent->drumset->getVersion();


    echo '<pre>';
    print_r($app);
    print_r($companent);
    echo '</pre>';