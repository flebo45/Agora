<?php

class VUser{
    
    private $smarty;

    public function __construct(){

        $this->smarty = StartSmarty::configuration();

    }

    /**
     * @throws SmartyException
     */
    public function home($user, $arrayPostInHome, $arrayImagesPosts/*$userimagini*/ /*$colorLabel, $backgroundLabel*/){
        
        $this->smarty->assign('user-logged',"loggato");
        $this->smarty->assign('arrayPostInHome',$arrayPostInHome);
        $this->smarty->assign('arrayImagesPosts',$arrayImagesPosts);
        $this->smarty->assign('user', $user);
        //$this->smarty->assign('colorLabel', $colorLabel);
        //$this->smarty->assign('backgroundLabel', $backgroundLabel);
      
      /*$typeImg = array();
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
        $this->smarty->assign('pic64Img',$pic64Img);*/
        $this->smarty->display('home.tpl');

    }

    /**
     * Funzione che indirizza alla pagina con il form di login.
     * @throws SmartyException
     */
    public function showLoginForm(){
        $this->smarty->assign('siteName', 'Agorà');
        $this->smarty->display('login.tpl');
    }

    /**
     * Funzione che indirizza alla pagina con il form di login.
     * @throws SmartyException
     */
    public function uploadPersonalUserInfo($user, $arrayPostInHome, $arrayImagesPosts){
        /*if(isset($image[0])){
            $this->smarty->assign('type',$image[0]->getType());
            $this->smarty->assign('pic64', base64_decode($image[0]->getimageData()));
        }
        else{
            $data = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Agora/smarty/immagine/1.png');
            $pic64 = base64_encode($data);
            $type = "image/jpg";
            $this->smarty->assign('type',$type);
            $this->smarty->assign('pic64',$pic64);
        }*/
        $this->smarty->assign('user-logged',"loggato");
        $this->smarty->assign('user',$user);
        $this->smarty->assign('postList',$arrayPostInHome);
        $this->smarty->assign('arrayImagesPosts',$arrayImagesPosts);
        /*$typeImg=array();
        $pic64Img=array();
        if(count($arrayImg)!=0) {
            foreach ($arrayImg as $im) {
                if($im!=null) {
                    if(count($im)==1){
                        $typeImg[] = $im[0]->getType();
                        $pic64Img[] =  base64_encode($im[0]->getImageFile());
                    }else{
                        $typeImg[] = $im[0]->getType();
                        $pic64Img[] =  $im[0]->getImageFile();
                    }
                }else{
                    $data = file_get_contents( $_SERVER['DOCUMENT_ROOT'] . '/Agora/Smarty/immagini/1.png');
                    $pic64Img[]= base64_encode($data);
                    $typeImg[] = "image/png";
                }
            }
        }
        else{
            $data = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/Agora/Smarty/immagini/1.png');
            $pic64Img[] = base64_encode($data);
            $typeImg[] = "image/png";
        }
        $this->smarty->assign('typeImg',$typeImg);
        $this->smarty->assign('pic64Img',$pic64Img);*/

        $this->smarty->display('personalProfile.tpl');
    }

    /**
     * Funzione che indirizza alla pagina con il form di login.
     * @throws SmartyException
     */
    public function uploadUserInfo($user,$personalUser,$array_p){
         /*if(isset($image[0])){
            $this->smarty->assign('type',$image[0]->getType());
            $this->smarty->assign('pic64', base64_decode($image[0]->getimageData()));
        }
        else{
            $data = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Agora/smarty/immagine/1.png');
            $pic64 = base64_encode($data);
            $type = "image/jpg";
            $this->smarty->assign('type',$type);
            $this->smarty->assign('pic64',$pic64);
        }*/
        $this->smarty->assign('personalUser',$personalUser);
        $this->smarty->assign('user',$user);
        
        /*$typeImg=array();
        $pic64Img=array();
        if(count($arrayImg)!=0) {
            foreach ($arrayImg as $im) {
                if($im!=null) {
                    if(count($im)==1){
                        $typeImg[] = $im[0]->getType();
                        $pic64Img[] =  base64_encode($im[0]->getImageFile());
                    }else{
                        $typeImg[] = $im[0]->getType();
                        $pic64Img[] =  $im[0]->getImageFile();
                    }
                }else{
                    $data = file_get_contents( $_SERVER['DOCUMENT_ROOT'] . '/Agora/Smarty/immagini/1.png');
                    $pic64Img[]= base64_encode($data);
                    $typeImg[] = "image/png";
                }
            }
        }
        else{
            $data = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/Agora/Smarty/immagini/1.png');
            $pic64Img[] = base64_encode($data);
            $typeImg[] = "image/png";
        }
        $this->smarty->assign('typeImg',$typeImg);
        $this->smarty->assign('pic64Img',$pic64Img);*/
        $this->smarty->assign('postList',$array_p);
        $this->smarty->display('profile.tpl');
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