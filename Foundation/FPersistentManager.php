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

    /**
     * return an object specifying the class and the id 
     */
    public static function retriveObj($class, $id){
        $fem = FEntityManager::getInstance();

        $result = $fem::retriveObj($class, $id);

        return $result;
    }

    /**
     * return a list of Comments belonged to a post
     */
    public static function getCommentList($idPost)
    {
        $result = FComment::getCommentListNotBanned($idPost);

        return $result;

    }

    /**
     * return a User findig it not on the id but on it's username
     */
    public static function retriveUserOnUsername($username)
    {
        $result = FUser::getUserByUsername($username);

        return $result;
    }

    /**
     * return a MOderator finding it not on id but on it's username
     */
    public static function retriveModOnUsername($username)
    {
        $result = FModerator::getModByUsername($username);

        return $result;
    }

    /**
     * return the number of Like of a Post
     */
    public static function getLikeNumber($idPost)
    {
        $result = FLike::getLikeNumber($idPost);

        return $result;
    }

    /**
     * upload any Object in the database
     */
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

    /**
     * call to the entityManger to delete an UserFollow object
     */
    public static function deleteFollow(EUserFollow $follow)
    {
        $fem = FEntityManager::getInstance();

        $result = $fem::deleteObjInDb($follow);

        return $result;
    }

    /**
     * return a list of Users who liked a Post
     * @return array
     */
    public static function getLikesUserOfAPost($idPost)
    {
        $likes = FLike::getLikeList($idPost);

        $result = array();

        if($likes !== null)
        {
            foreach($likes as $l)
            {
                $user = self::retriveObj(EUser::getEntity(), $l->getIdUser());
                $result[] = $user;
            }
        }

        return $result;
    }


    /**
     * return the number of the Users followed by the user
     */
    public static function getFollowedNumb($idUser)
    {
        $result = FUserFollow::followedNumb($idUser);

        return $result;
    }

    /**
     * return the number of the Users following a user
     */
    public static function getFollowerNumb($idUser)
    {
        $result = FUserFollow::followerNumb($idUser);

        return $result;
    }

    /**
     * return a list of Users who are followed by a user
     * @return array
     */
    public static function getFollowedList($idUser)
    {
        $followList = FUserFollow::followedList($idUser);

        $result = array();

        if($followList !== null)
        {
            foreach($followList as $f)
            {
                $user = self::retriveObj(EUser::getEntity(), $f->getFollowed());
                $result[] = $user;
            }
        }
        return $result;
    }

    /**
     * return a list of Users who follow a user
     * @return array
     */
    public static function getFollowerList($idUser)
    {
        $followList = FUserFollow::followerList($idUser);

        $result = array();

        if($followList !== null)
        {
            foreach($followList as $f)
            {
                $user = self::retriveObj(EUser::getEntity(), $f->getFollower());
                $result[] = $user;
            }
        }
        return $result;

    }

    /**
     * return UserFollow object specifying the follower and the followed
     */
    public static function retriveFollow($idUser, $followedId)
    {
        $result = FUserFollow::getFollow($idUser, $followedId);
    
        return $result;
    }

    /**
     * return Like Object specifying the User and the Post
     */
    public static function retriveLike($idUser, $idPost)
    {
        $result = FLike::getLike($idUser, $idPost);
    
        return $result;
    }

    /**
     * retrun a list of Posts that have the $keyword in their Title
     */
    public static function getSerachedPosts($keyword)
    {
        $result = FPost::getSearched($keyword);

        return $result;
    }

    /**
     * return a list of Users that have the $keyword in their Username
     */
    public static function getSearchedUsers($keyword)
    {
        $result = FUser::getSearched($keyword);

        return $result;
    }

    /**
     * return a list of all Report of Posts
     */
    public static function getReportedPost()
    {
        $result = FReport::reportedPostList();

        return $result;
    }

    /**
     * return a list of all Report of Comments
     */
    public static function getReportedComment()
    {
        $result = FReport::reportedCommentList();

        return $result;
    }

    /**
     * delete all the Report of a related obj(post or comment)
     */
    public static function deleteRelatedReports($param, $id)
    {
        $reports = FReport::listReportsOnParam($param, $id);

        if(count($reports) > 0)
        {
            foreach($reports as $r)
            {
                self::deleteReport($r);
            }
        }
    }
    
//-------------------------------------HOME-------------------------------------------

    /**
     * return a list of Posts belonged to Users that a user is Following
     * @return array
     */
    public static function loadHomePage($id)
    {
        $followed = self::getFollowedList($id);
        if(count($followed) === 0)
        {
            $posts = array();
        }else{
            $nestedPosts = array();
            foreach($followed as $f){
                $nestedPosts[] = FPost::postListNotBanned($f->getId());
            }
            $posts = array_merge(...$nestedPosts);
            
            //sort posts array by creation time desc
            usort($posts, ['FPost', 'comparePostsByCreationTime']);
        }
        return $posts;
    }

    //-------------------VIP------------------------------------------------------------
    /**
     * return a list of all vip (they are max 3)
     */
    public static function loadVipUsers()
    {
        $result = FUser::loadVipUsers();

        return $result;
    }

    /**
     * return a list of the users who have thge highest number of followers
     */
    public static function topUserFollower()
    {
        $result = FUser::topUserFollower();

        return $result;
    }

    /**
     * retrurn an array containing 3 array, 'common' are the user who were vip and now are also vip, 
     * 'remainFirst' are the users who were vip but not now, 
     * 'remainSecond' are the users who weren't vip but now yes
    */
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

    /**
     * from the findCommon() set the vip to the users
     */
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

    /**
     * verify if exist a user with this email (also mod)
     */
    public static function verifyUserEmail($email){
        $result = FPerson::verify('email', $email);

        return $result;
    }

    /**
     * verify if exist a user with this username (also mod)
     */
    public static function verifyUserUsername($username){
        $result = FPerson::verify('username', $username);

        return $result;
    }
    //-------------------------USER-PAGE---------------------------------------

    /**
     * load all post of a user that are not banned
     */
    public static function loadUserPage($id)
    {
        $allPosts = FPost::postListNotBanned($id);

        if(count($allPosts) > 0){
            usort($allPosts, ['FPost', 'comparePostsByCreationTime']);
        }

        return $allPosts;
    }

    //-----------------------CATEGORY----------------------------------------------

    /**
     * return all post that are not banned finded on a specific category
     */
    public static function loadPostPerCategory($category)
    {
        $result = FPost::postListCategory($category);

        usort($result,  ['FPost', 'comparePostsByCreationTime']);

        return $result;
    }

    //------------------------EXPLORE--------------------------------------------
    
    /**
     * load all post not banned that are not belonged to the user
     */
    public static function loadPostInExplore($idUser)
    {
        $result = FPost::postInExplore($idUser);

        return $result;
    }
}