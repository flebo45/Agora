<?php

class VUser{
    
    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();

    }

    /**
     * @throws SmartyException
     */
    public function home($image, $result){
      if(CUser::isLogged()){
        $pm = FPersistentManager::getInstance();
        $this->smarty->assign('userlogged',"loggato");
        $userId = USession::getSessionElement('user');
        $user = $pm::retriveUser($userId);
        $this->smarty->assign('username',$user->getUsername());
      }
      else{
          $this->smarty->assign('userlogged','nouser');
      }
      $typeImg = array();
      $pic64Img = array();
      foreach ($image as $im){
          if($im!=null){
              if(count($im)==1){
                  $typeImg[] = $im[0]->getType();
                  $pic64Img[] =  base64_encode($im[0]->getImageFile());
              }
              else {
                  $typeImg[] = $im[0]->getType();
                  $pic64Img[] = $im[0]->getImageFile();
              }
          }
          else{
              $data = file_get_contents( $_SERVER['DOCUMENT_ROOT'] . '/Agora/Smarty/immagini/1.png');
              $pic64Img[]= base64_encode($data);
              $typeImg[] = "image/png";
          }
      }
        $this->smarty->assign('typeImg',$typeImg);
        $this->smarty->assign('pic64Img',$pic64Img);
        $this->smarty->assign('array_post_home',$result);
        $this->smarty->display('index.tpl');

    }

    /**
     * Funzione che indirizza alla pagina con il form di login.
     * @throws SmartyException
     */
    public function showFormLogin(){
        $this->smarty->display('login.tpl');
    }


    public function profile($image,$user,$bio,$working,$arrayPost,$arrayImg){
        if(isset($image[0])){
            $this->smarty->assign('type',$image[0]->getType());
            $this->smarty->assign('pic64', base64_decode($image[0]->getimageData()));
        }
        else{
            $data = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Agora/smarty/immagine/1.png');
            $pic64 = base64_encode($data);
            $type = "image/jpg";
            $this->smarty->assign('type',$type);
            $this->smarty->assign('pic64',$pic64);
        }
        $this->smarty->assign('user',$user);
        $this->smarty->assign('email',$user->getEmail());
        if(!is_array($arrayPost)){
            $array_p = array();
            $array_p[]= $arrayPost;
        }
        else $array_p = $arrayPost;
        $typeImg=array();
        $pic64Img=array();
        if(count($array_image)!=0) {
            foreach ($array_image as $im) {
                if($im!=null) {
                    if(count($im)==1){
                        $typeImg[] = $im[0]->getType();
                        $pic64Img[] =  base64_encode($im[0]->getImageFile());
                    }else{
                        $typeImg[] = $im[0]->getType();
                        $pic64Img[] =  $im[0]->getImageFile();
                    }
                }
            }
        }
    }

    /**
     * Funzione che si occupa di gestire la visualizzazione degli errori in fase login
     * @throws SmartyException
     */
    public function loginError() {
        $this->smarty->assign('error',"errore");
        $this->smarty->display('login.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function loginBan() {
        $this->smarty->assign('ban',"true");
        $this->smarty->display('login.tpl');
    }

}