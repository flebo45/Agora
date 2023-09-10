<?php

class CFrontController{
    
    public function run($path){

        $pm = FPersistentManager::getInstance();

        $result = explode("/", $path);
        array_shift($result);
        array_shift($result);

        $controller = "C" . $result[0];
        $directory = "Controller";
        $scanDir = scandir($directory);

        if(in_array($controller . ".php", $scanDir)){
            if(isset($result[1])){
                $method = $result[1];

                if(method_exists($controller, $method)){
                    $param = array();
                        for ($i = 2; $i < count($result); $i++) {
                            $param[] = $result[$i];
                        }
                        $num = (count($param));
                        if ($num == 0) $controller::$method();
                        else if ($num == 1) $controller::$method($param[0]);
                        else if ($num == 2) $controller::$method($param[0], $param[1]);

                }else{
                    USession::getInstance();
                    if(CUser::isLogged()){
                        header('Location: /Agora/User/home');
                    }else{
                        header('Location: /Agora/User/home');
                    }
                }
            }
            
        }else{
            USession::getInstance();
            if(CUser::isLogged()){
                header('Location: /Agora/User/home');
            }else{
                header('Location: /Agora/User/home');
            }
        }
    }
}