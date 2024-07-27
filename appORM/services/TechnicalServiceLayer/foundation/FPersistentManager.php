<?php

class FPersistentManager{

    /**
     * Singleton Class
     */

     private static $instance;


     private function __construct(){


     }

     public static function getInstance(){
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * return an object specifying the class and the id 
     */
    public static function retriveObj($Eclass, $id){
        $result = FEntityManager::getInstance()->retriveObj($Eclass, $id);

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
     * return a Moderator findig it not on the id but on it's username
     */
    public static function retriveModOnUsername($username)
    {
        $result = FModerator::getModByUsername($username);

        return $result;
    }

    /**
     * Method to return a UserFollow obj giving the followed and the follwer users 
     * @param int $idUser Refers to the id of the user who follow
     * @param int $idFollowed Refers to the id of the user who is followed
     */
    public static function retriveFollow($idUser, $idFollowed){
        $follow = FUserFollow::retriveUserFollow($idUser, $idFollowed);
        if(!$follow){
            return false;
        }else{
            return true;
        }
    }

    /**
     * Method to return a Like obj giving the post and user
     * @param int $idUser Refers to the id of the user who liked the post
     * @param int $idPost Refers to the id of the post 
     */
    public static function retriveLike($idUser, $idPost){
        $like = FLike::getLikeOnUser($idUser, $idPost);

        return $like;
    }

    /**
     * upload any Object in the database
     */
    public static function uploadObj($obj){

        $result = FEntityManager::getInstance()->saveObject($obj);

        return $result;
    }

    /**
     * Method to return the list of the followed user pf a user
     * @param int $idUser Refrs to the user who follow
     */
    public static function getFollowedUserList($idUser){
        $followList = FUserFollow::followedList($idUser);

        $result = array();

        if(count($followList) > 0)
        {
            foreach($followList as $f)
            {
                $user = self::retriveObj(EUser::getEntity(), $f->getFollowed());
                $result[] = $user;
            }
        }
        return $result;
    }

    public static function getFollowerUserList($idUser){
        $followList = FUserFollow::followerList($idUser);

        $result = array();

        if(count($followList) > 0)
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
     * $userinput can be an array of user or an user id,, in this case retrive the user
     * Method to load Users and their Profile Image
     * @param array | int $userInput 
     */
    public static function loadUsersAndImage($userInput){
        $result = array();
        if(is_array($userInput)){
            foreach($userInput as $u){
                $arrayData = array($u, self::retriveObj(EImage::getEntity(), $u->getIdImage()));
                $result[] = $arrayData;
            }
        }else{
            $user = self::retriveObj(EUser::getEntity(), $userInput);
            $arrayData = array($user, self::retriveObj(EImage::getEntity(), $user->getIdImage()));
            $result[] = $arrayData;
        }
        return $result;
    }

    /**
     * Method to return COmments and their user Propic
     * @param int $idPost
     */
    public static function loadCommentsAndUsersPic(EPost $post){
        $comments = $post->getComments();
        $result = array();

        foreach($comments as $c){
            $arrayData = array($c, self::retriveObj(EImage::getEntity(), $c->getUser()->getIdImage()));
            $result[] = $arrayData;
        }
        return $result;
    }

    /**
     * Method to load in an array the number of like, number of follower and number of followed
     * @param \EPost $post 
     */
    public static function loadFollLikeNumb($post){
        $likeNumb = count($post->getLikes());
        $followerNumb = self::getFollowerNumb($post->getUser()->getId());
        $followedNumb = self::getFollowedNumb($post->getUser()->getId());

        $result = array($likeNumb, $followerNumb, $followedNumb);

        return $result;
    }
//-----------------------------------HOME-----------------------------------------------------

    /**
    * Method to return the list of post in the home page of a user
    * @param int $id Referrs to the user who is loading the homepage
    */
    public static function loadHomePage($id){
        $followed = self::getFollowedUserList($id);
        if(count($followed) == 0){
            $homePagePostsAndUserPropic = array();
        }else{
            $nestedPosts = array();
            foreach($followed as $f){
                $nestedPosts[] = FPost::postListNotBanned($f->getId());
            }
            $homePagePosts = array_merge(...$nestedPosts);

            usort($homePagePosts, ['FPost', 'comparePostsByCreationTime']);

            $homePagePostsAndUserPropic = array();
            foreach($homePagePosts as $p){
                $arrayData = array($p, self::retriveObj(EImage::getEntity(), $p->getUser()->getIdImage()));
                $homePagePostsAndUserPropic[] = $arrayData;
            }

            return $homePagePostsAndUserPropic;
        }
    }

    //-------------------------------------VERIFY---------------------------------------
    
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

    //------------------------FOLLOWERS PAGE-------------------------------------------

    /**
     * Method to return the Followed User List and their profile pic
     * @param int $idUser 
     */
    public static function getFollowedList($idUser){
        $userList = self::getFollowedUserList($idUser);

        $userAndPropicArr = self::loadUsersAndImage($userList);

        return $userAndPropicArr;
    }

    //------------------------FOLLOWED PAGE -------------------------------------------------

    /**
     * Method to return the Follower User List and their profile pic
     * @param int $idUser 
     */
    public static function getFollowerList($idUser){
        $userList = self::getFollowerUserList($idUser);

        $userAndPropicArr = self::loadUsersAndImage($userList);

        return $userAndPropicArr;
    }

    //-------------------------LIKE PAGE-----------------------------------------------------
    /**
     * Method to load likes of a Post and their users Propic
     * @param int $idPost
     */
    public static function getLikesPage(EPost $post){
        $likes = $post->getLikes();

        $result = array();
        foreach($likes as $l){
            $arrayData = array($l->getUser(), self::retriveObj(EImage::getEntity(), $l->getUser()->getIdImage()));
            $result[] = $arrayData;
        }
        return $result;
    }

    //--------------------------VIP----------------------------------------------------

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
     * Method to return a list of VIP user and their profile pic. This method check if there are new vip and delete the old ones 
     */
    public static function loadVip(){
        $oldVips = FUser::loadVipUsers();
        $oldIds = array();

        foreach($oldVips as $o){
            $oldIds[] = $o->getId();
        }

        $newVips = FUserFollow::getTopUserFollower();
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
                $user = self::retriveObj(EUser::getEntity(), $u);
                $user->setVip(true);
                self::uploadObj($user);
            }
        }
        $vipArr = array(); 
        foreach($newIds as $i){
            $vipArr[] = self::retriveObj(EUser::getEntity(), $i);
        }
        
        $vipsAndProPic = self::loadUsersAndImage($vipArr);
        //var_dump($vipsAndProPic);

        foreach($vipsAndProPic as &$vp){
            $vp[] = self::getFollowerNumb($vp[0]->getId());
        }
        unset($vp);

        return $vipsAndProPic;
    }

//-------------------------------USER PAGE-------------------------------------------

    public static function loadUserPage(EUser $user){
        $postNotOrdered = array();
        if(count($user->getPosts()) > 0){
            foreach($user->getPosts() as $p){
                if(!$p->isBanned()){
                    $postNotOrdered[] = $p;
                }
            }
            usort($postNotOrdered, ['FPost', 'comparePostsByCreationTime']);
        }
        $result = array();
        foreach($postNotOrdered as $post){
            $arrayData = array($post, count($post->getLikes()));
            $result[] = $arrayData;
        }
        
        return $result;
    }

    // /**
    //  * load all post of a user that are not banned
    //  * @param int $id Refers to the user id 
    //  */
    // public static function loadUserPage($id){
    //     $allPosts = FPost::postListNotBanned($id);

    //     if(count($allPosts) > 0){
    //         usort($allPosts, ['FPost', 'comparePostsByCreationTime']);
    //     }
    //     return $allPosts;
    // }

//-------------------------------IMAGES----------------------------------------------------

    public static function manageImageProfile($uploadedImage, EUser $user){
        $checkUploadImage = self::uploadImage($uploadedImage);
        if($checkUploadImage == 'UPLOAD_ERROR_OK' || $checkUploadImage == 'TYPE_ERROR' || $checkUploadImage == 'SIZE_ERROR'){
            return false;
        }else{
            //persist the image in the db
            self::uploadObj($checkUploadImage);
            //check if the user have a pro pic or it's default pro pic
            if($user->getIdImage() != 1){
                self::deleteImage($user->getIdImage());
            }
            $user->setIdImage($checkUploadImage->getId());
            self::uploadObj($user);
            return true;
        }
    }

    public static function manageImagesPost($uploadedImages, $post){
        foreach($uploadedImages['tmp_name'] as $index => $tmpName){
            $file = [
            'name' => $uploadedImages['name'][$index],
            'type' => $uploadedImages['type'][$index],
            'size' => $uploadedImages['size'][$index],
            'tmp_name' => $tmpName,
            'error' => $uploadedImages['error'][$index]
        ];
    
            //check if the uploaded image is ok 
            $checkUploadImage = self::uploadImage($file);
            if($checkUploadImage == 'UPLOAD_ERROR_OK' || $checkUploadImage == 'TYPE_ERROR' || $checkUploadImage == 'SIZE_ERROR'){
                FEntityManager::getInstance()->deleteObj($post);
                break;
            }else{
                $checkUploadImage = self::uploadImagePost($checkUploadImage, $post);
            }
        }
        return $checkUploadImage;
    }

    /**
     * Method to save an image in the post and store it in the database
     * @param \EImage $image Refres to the image to store 
     * @param \EPost $post Refers to the post
     * @return boolean
     */
    public static function uploadImagePost(EImage $image, EPost $post){

        $post->addImage($image);

        $upload = self::uploadObj($post);

        return $upload;
    }

    /**
    * check if the uploaded image is ok and then create an Image Obj and save it in the database
    */
    public static function uploadImage($file){
        $check = self::validateImage($file);
        if($check[0]){
        
            //create new Image Obj ad perist it
            $image = new EImage($file['name'], $file['size'], $file['type'], file_get_contents($file['tmp_name']));
            return $image;
        }else{
            return $check[1];
        }
    }

    /**
    * check if the image is ok and in case return the error
    */
    public static function validateImage($file){
        if($file['error'] !== UPLOAD_ERR_OK){
            $error = 'UPLOAD_ERROR_OK';

            return [false, $error];
        }

        if(!in_array($file['type'], ALLOWED_IMAGE_TYPE)){
            $error = 'TYPE_ERROR';

            return [false, $error];
        }

        if($file['size'] > MAX_IMAGE_SIZE){
            $error = 'SIZE_ERROR';

            return [false, $error];
        }

        return [true, null];
    }

//----------------------------------DELETE----------------------------------------------------

    public static function deleteImage($idImage){
        $image = self::retriveObj(EImage::getEntity(), $idImage);
        $result = FEntityManager::getInstance()->deleteObj($image);
        return $result;
    }

    public static function deleteFollow($userId, $followedId){
        $follow = FUserFollow::retriveUserFollow($userId, $followedId);
        $result = FEntityManager::getInstance()->deleteObj($follow);
        return $result;
    }

    public static function deleteRelatedReports($id, $field = null){
        $result = FReport::deleteReports($id, $field);
        return $result;
    }

    public static function deleteObj($obj){
        $result = FEntityManager::getInstance()->deleteObj($obj);
        return $result;
    }

//----------------------------------CATEGORY PAGE----------------------------------------------

    /**
     * return all post that are not banned finded on a specific category
     * @param String $category Refers to the category serched
     */
    public static function loadPostPerCategory($category){
        $field = 'category';
        $categoryPagePost = FPost::getSearched($field, $category);

        usort($categoryPagePost,  ['FPost', 'comparePostsByCreationTime']);

        $categoryPagePostsAndUserPropic = array();
        foreach($categoryPagePost as $p){
            $arrayData = array($p, self::retriveObj(EImage::getEntity(), $p->getUser()->getIdImage()));
            $categoryPagePostsAndUserPropic[] = $arrayData;
        }

        return $categoryPagePostsAndUserPropic;
    }

//---------------------------------------EXPLORE PAGE--------------------------------------------

    /**
     * load all post not banned that are not belonged to the user
     * @param int $idUser Refers to the user 
     */
    public static function loadPostInExplore($idUser)
    {
        $explorePagePost = FPost::postInExplore($idUser);

        $explorePagePostsAndUserPropic = array();
        if(empty($explorePagePost) || $explorePagePost === null){
            return $explorePagePostsAndUserPropic = array();
        }else{
            foreach($explorePagePost as $p){
                $arrayData = array($p, self::retriveObj(EImage::getEntity(), $p->getUser()->getIdImage()));
                $explorePagePostsAndUserPropic[] = $arrayData;
            }
    
            return $explorePagePostsAndUserPropic;
        }
    }

//--------------------------------SEARCH PAGE----------------------------------------------------------------------------------------

    /**
     * Method to return alist of post serached with the title using $keyword
     * @param String $keyword 
     */
    public static function getSearchedPost($keyword){
        //ritorna una lista di post con settati gli utenti
        $field = 'title';

        $posts = FPost::getSearched($field, $keyword);

        $postsAndUserPic = array();
        foreach($posts as $p){
            $arrayData = array($p, self::retriveObj(EImage::getEntity(), $p->getUser()->getIdImage()));
            $postsAndUserPic[] = $arrayData;
        }

        return $postsAndUserPic;
    }

    /**
     * return a list of Users that have the $keyword in their Username
     * @param String $keyword
     */
    public static function getSearchedUsers($keyword)
    {
        $userList = FUser::getSearched($keyword);

        $userAndPropicArr = self::loadUsersAndImage($userList);

        return $userAndPropicArr;

    }

    //--------------------------------------AJAX-----------------------------------------------------------------


    /**
     * method to process data to send at the ajax request
     * take all the posts, comments and users from the database
     * create three arrays: 1. post array: 1st value is a date of the post creation, 2nd value is the number of the post in that date
     *                      2. comment array: 1st value is a date of the comments creation, 2nd value is the number of the commnets in that date
     *                      3. user array: 1st value is the number of user of the same age, 2nd value is the age
     * @return array
     */
    public static function retriveAjaxData(){
        $posts = FEntityManager::getInstance()->selectAll(EPost::getEntity());
        $comments = FEntityManager::getInstance()->selectAll(EComment::getEntity());
        $users = FEntityManager::getInstance()->selectAll(EUser::getEntity());

        $postData = [];
        $commentData = [];
        $userData = [];

        if(!empty($posts)){
            $postCountsByDate = [];
            foreach ($posts as $post) {
                // Extract the date part (Y:m:d) from the creation_time attribute
                $dateOnly = date('Y:m:d', strtotime($post->getTimeStr()));

                if(isset($postCountsByDate[$dateOnly])){
                    $postCountsByDate[$dateOnly]++;
                }else{
                    $postCountsByDate[$dateOnly] = 1;
                }
            }
            foreach($postCountsByDate as $date => $count){
                $postData[] = [$date, $count];
            }
        }

        if(!empty($comments)){
            $commentContsByDate = [];
            foreach($comments as $comment){
                // Extract the date part (Y:m:d) from the creation_time attribute
                $dateOnly = date('Y:m:d', strtotime($comment->getTimeStr()));

                if(isset($commentContsByDate[$dateOnly])){
                    $commentContsByDate[$dateOnly]++;
                }else{
                    $commentContsByDate[$dateOnly] = 1;
                }
            }
            foreach($commentContsByDate as $date => $count){
                $commentData[] = [$date, $count];
            }
        }

        if(!empty($users)){
            $userCountsByAge = [];
            foreach($users as $user){

                $age = $user->getyear();
                
                if(isset($userCountsByAge[$age])){
                    $userCountsByAge[$age]++;
                }
                else {
                    $userCountsByAge[$age] = 1;
                }
            }
            foreach($userCountsByAge as $age => $count){
                $userData[] = [$count, $age];
            }
        }

        return [$postData, $commentData, $userData];

    }

}