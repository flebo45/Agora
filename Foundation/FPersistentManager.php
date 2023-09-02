<?php

class FPersistentManager{

    /**
     * Singleton Class
     */

     private static $instance;


     private function __construct(){


     }

     public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function retriveObj($class, $id){
        $fem = FEntityManager::getInstance();

        $result = $fem::retriveObj($class, $id);

        return $result;
    }

    public static function getCommentList($idPost)
    {
        $result = FComment::getCommentListNotBanned($idPost);

        return $result;

    }
    public static function retriveUserOnUsername($username)
    {
        $result = FUser::getUserByUsername($username);

        return $result;
    }

    public static function getLikeNumber($idPost)
    {
        $result = FLike::getLikeNumber($idPost);

        return $result;
    }

    public static function uploadObj($obj){
        $fem = FEntityManager::getInstance();

        $result = $fem::saveObject($obj);

        return $result;
    }

    /**
     *  call to FPost to delete Post in the db (delete post and all comments, image, like and report related to it)
     * @return boolean
     */
    public static function deletePost(EPost $post){

        $result = FPost::deletePostInDb($post);

        return $result;
        
    }

    /**
     * call to FLike to delete like in the db
     * @return boolean
     */
    public static function deleteLike(ELike $like){

        $result = FLike::deleteLikeInDb($like);

        return $result;
    }

    /**
     * call to FImage to save image of a post in db
     * @return boolean
     */
    public static function uploadImagePost(EImage $image, EPost $post){

        $image->setPost($post);
        $post->addImage($image);

        $result = FImage::saveImagePostIndb($image, $post);

        return $result;
    }

    /**
     * call to FImage to delete an image from the db
     * @return boolean
     */
    public static function deleteImage(EImage $image){

        $result = FImage::deleteImageInDb($image);

        return $result;
    }

    /**
     * call to FReport to delete a report from the db
     * @return boolean
     */
    public static function deleteReport(EReport $report){

        $result = FReport::deleteReportInDb($report);

        return $result;
    }
//-------------------------------------HOME-------------------------------------------

    public static function getFollowed($id)
    {
        $result = FUser::getFollowed($id);

        return $result;
    }

    public static function loadHomePage($id)
    {
        $followed = self::getFollowed($id);
        if(count($followed) === 0)
        {
            $posts = array();
        }else{
            $posts = array();
            foreach($followed as $f){
                $posts = FPost::postListNotBanned($f->getFollowed());
            }
            usort($posts, ['FPost', 'comparePostsByCreationTime']);
        }
        return $posts;
    }

    //-------------------VIP------------------------------------------------------------
    public static function loadVipUsers()
    {
        $result = FUser::loadVipUsers();

        return $result;
    }

    public static function topUserFollower()
    {
        $result = FUser::topUserFollower();

        return $result;
    }

    private static function findCommon($array1, $array2){
        $common = [];
        $remainFirst = [];
        $remainSecond = [];

        foreach ($array1 as $num) {
            if (in_array($num, $array2)) {
                $common[] = $num;
            } else {
                $remainFirst[] = $num;
            }
        }

        foreach ($array2 as $num) {
            if (!in_array($num, $common)) {
                $remainSecond[] = $num;
            }
        }

        return ['common'=>$common, 'remainFirst'=>$remainFirst, 'remainSecond'=>$remainSecond];
    }

    public static function loadVip()
    {
        $oldVips = self::loadVipUsers();
        $oldIds = array();

        foreach($oldVips as $o){
            $oldIds[] = $o->getId();
        }

        $newVips = self::topUserFollower();
        $newIds = array();

        foreach($newVips as $n){
            $newIds[] = $n['idFollowed'];
        }

        $arr = self::findCommon($oldIds, $newIds);

        if(count($arr['remainFirst']) > 0){
            foreach($arr['remainFirst'] as $u){
                $user = self::retriveObj(EUser::getEntity(), $u);
                $user->setVip(false);
                self::uploadObj($user);
            }
        }
        
        if(count($arr['remainSecond']) > 0){
            foreach($arr['remainSecond'] as $d){
                $user = self::retriveObj(EUser::getEntity(), $d);
                $user->setVip(true);
                self::uploadObj($user);
            }
        }
        $vipArr = array(); 
        foreach($newIds as $i){
            $vipArr[] = self::retriveObj(EUser::getEntity(), $i);
        }
        
        return $vipArr;
    }

    //---------------------------VERIFY----------------------------------------------

    public static function verifyEmail($email){
        $result = FPerson::verify('email', $email);

        return $result;
    }

    public static function verifyUsername($username){
        $result = FPerson::verify('username', $username);

        return $result;
    }

    //-------------------------USER-PAGE---------------------------------------

    public static function loadUserPage($id)
    {
        $allPosts = FPost::postListNotBanned($id);

        if(count($allPosts) > 0){
            usort($allPosts, ['FPost', 'comparePostsByCreationTime']);
        }

        return $allPosts;
    }

    //-----------------------CATEGORY----------------------------------------------

    public static function loadPostPerCategory($category)
    {
        $result = FPost::postListCategory($category);

        usort($result,  ['FPost', 'comparePostsByCreationTime']);

        return $result;
    }

    //------------------------EXPLORE--------------------------------------------
    
    public static function loadPostInExplore($idUser)
    {
        $result = FPost::postInExplore($idUser);

        return $result;
    }
}