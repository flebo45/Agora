<?php

/**
 * classe sql
 */
class FPersistentManager{

    /**
     * Singleton Class
     */

     private static $instance;


     private function __construct(){


     }

     /**
     * Method to create an instance af the PersistentManager
     */
     public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    //------------------------------Directly with EntityManager---------------------------
    /**
     * return an object specifying the class and the id 
     * @param String $class Refers to the Entity class of the object
     * @param int $id Refers to the id o the object
     * @return mixed
     */
    public static function retriveObj($class, $id){
       
        $foundClass = "F" . substr($class, 1);
        $staticMethod = "getObj";

        $result = call_user_func([$foundClass, $staticMethod], $id);

        return $result;
    }

    /**
     * upload any Object in the database
     * @param Object $obj Rfers to the object to store
     * @return mixed
     */
    public static function uploadObj($obj){
        $foundClass = "F" . substr(get_class($obj), 1);
        $staticMethod = "saveObj";

        $result = call_user_func([$foundClass, $staticMethod], $obj);

        return $result;
    }

    //---------------------------------------------------------------------------

    /**
     * return a list of Comments belonged to a post
     * @param $idPost Refers to the id of the post 
     */
    public static function getCommentList($idPost)
    {
        $result = FComment::getCommentListNotBanned($idPost);

        return $result;

    }

    /**
     * return a User findig it not on the id but on it's username
     * @param String $username Refers to the username of the user to get
     */
    public static function retriveUserOnUsername($username)
    {
        $result = FUser::getUserByUsername($username);

        return $result;
    }

    /**
     * return a Moderator finding it not on the id but on it's username
     * @param String $username Refers to the username of the user to get
     */
    public static function retriveModOnUsername($username){

        $result = FModerator::getModByUsername($username);

        return $result;
    }

    /**
     * return the number of Like of a Post
     * @param int $idPost Refers to id of the post
     */
    public static function getLikeNumber($idPost)
    {
        $result = FLike::getLikeNumber($idPost);

        return $result;
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
   
//---------------------------------------------------------------------------------------------------------------------------
    //TODO in orig gli passo un post (Da vedere in doctrine come aggiustarlo)
    /**
     *  call to FPost to delete Post in the db (delete post and all comments, image, like and report related to it)
     * @param int $idPost Refers to the post to delete
     * @param int $idUser Refers to the user who create the post
     * 
     */
    public static function deletePost($idPost, $idUser){

        $result = FPost::deletePostInDb($idPost, $idUser);

        return $result;
        
    }

    /**
     * call to FLike to delete like in the db
     * @param int $idLike Referes to the like to delete
     * @param int $idUser Refrers to the user who like the post
     */
    public static function deleteLike($idLike, $idUser){

        $result = FLike::deleteLikeInDb($idLike, $idUser);

        return $result;
    }

    /**
     * Method to delete a report, if $field is nul delete the report on the id, else delete the report referd to a comment or a post so the $field can be idPost or idComment
     * @param int $id Refers to report if $fiedl == null, else refers to a field of report like idPost or idComment
     * @param String | null $field Refers to the field in which we are deleting the report 
     */
    public static function deleteRelatedReports($id, $field = null){

        $result = FReport::deleteReportInDb($id, $field);

        return $result;
    }

    /**
     * Method to delete an Image in the Database
     * @param int $idImage Refers to teh id of the image to delete
     */
    public static function deleteImage($idImage){

        $result = FEntityManagerSQL::getInstance()->deleteObjInDb(FImage::getTable(), FImage::getKey(), $idImage);

        return $result;
    }

    /**
     * Method to delete an UserFoloow obj by giving the follower and the followed
     * @param int $idUser Refers to the id of the user who follow
     * @param int $idFollowed Refers to the id of the user who is followed
     */
    public static function deleteFollow($idUser, $idUserFollowed){

        $result = FUserFollow::deleteUserFollowInDb($idUser, $idUserFollowed);

        return $result;
    }

    /**
     * Method to save an image in the post and store it in the database
     * @param \EImage $image Refres to the image to store 
     * @param \EPost $post Refers to the post
     * @return boolean
     */
    public static function uploadImagePost(EImage $image, EPost $post){

        $image->setPost($post);

        $uploadImage = FImage::saveObj($image);

        if($uploadImage){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Method to return a list of all user who liked a post 
     * @param int $idPost Refres to the post 
     */
    public static function getLikesUserOfAPost($idPost){
        //prende i like, dai like prende gli utenti e ritorna una lista di utenti 
        $likesRow = FEntityManagerSQL::getInstance()->retriveObj(FLike::getTable(), FPost::getKey(), $idPost);
        $result = array();
        if(count($likesRow) > 0){
            for($i = 0; $i < count($likesRow); $i++){
                $user = FUser::getObj($likesRow[$i][FUser::getKey()]);
                $result[] = $user;
            }
        }
        return $result;
    }

    public static function getUsersPofilePic($userArray){
        $usersProfilePic = array();
        if(count($userArray) > 0){
            foreach($userArray as $u){
                $proPic = FImage::getObj($u->getIdImage());
                //associative array (hash table)
                $usersProfilePic[$u->getId()] = $proPic;
            }
        }
        return $usersProfilePic;
    }

    /**
     * Method to return the number of the followed user pf a user
     * @param int $idUser Refrs to the user who follow
     */
    public static function getFollowedNumb($idUser){
        $result = FUserFollow::getFollowedNumb($idUser);

        return $result;
    }

    /** 
     * Method to return the number of the follower user pf a user
     * @param int $idUser Refrs to the user who is followed
    */
    public static function getFollowerNumb($idUser){
        $result = FUserFollow::getFollowerNumb($idUser);

        return $result;
    }

    /**
     * Method to return the list of the followed user pf a user
     * @param int $idUser Refrs to the user who follow
     */
    public static function getFollowedUserList($idUser){
        //prende gli utenti seguti da $idUser, crea una lista di utenti
        $followRow = FEntityManagerSQL::getInstance()->retriveObj(FUserFollow::getTable(), 'idFollower', $idUser);
        $result = array();
        if(count($followRow) > 0){
            for($i = 0; $i < count($followRow); $i++){
                $user = FUser::getObj($followRow[$i]['idFollowed']);
                $result[] = $user; 
            }
        }
        return $result;
    }

    /**
     * Method to return the list of the follower user pf a user
     * @param int $idUser Refrs to the user who follow
     */
    public static function getFollowerUserList($idUser){
        //prende gli utenti che seguono $idUser, crea una lista di utenti
        $followerRow = FEntityManagerSQL::getInstance()->retriveObj(FUserFollow::getTable(), 'idFollowed', $idUser);
        $result = array();
        if(count($followerRow) > 0){
            for($i = 0; $i < count($followerRow); $i++){
                $user = FUser::getObj($followerRow[$i]['idFollower']);
                $result[] = $user; 
            }
        }
        return $result;
    }

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
            $arrayData = array($p, self::retriveObj(FImage::getClass(), $p->getUser()->getIdImage()));
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

    /**
     * Method to return a list of post that are reported
     */
    public static function getReportedPost(){
        $queryResult = FReport::reportedPostList();
        //var_dump($queryResult);
        $posts = FReport::createReportObj($queryResult);

        return $posts;
    }

    /**
     * Method to return reported Comments
     */
    public static function getReportedComment(){
        $queryResult = FReport::reportedCommentList();

        $comment = FReport::createReportObj($queryResult);
        
        return $comment;
    }

//---------------------------------------------HOME-------------------------------------------------------------------

/**
 * Method to return the list of post in the home page of a user
 * @param int $id Referrs to the user who is loading the homepage
 */
public static function loadHomePage($id){
    $followed = self::getFollowedlist($id);
    if(count($followed) == 0){
        $homePagePostsAndUserPropic = array();
    }else{
        $nestedPosts = array();
        foreach($followed as $f){
            $nestedPosts[] = FPost::postListNotBanned($f[0]->getId());
        }
        $homePagePosts = array_merge(...$nestedPosts);

        usort($homePagePosts, ['FPost', 'comparePostsByCreationTime']);

        $homePagePostsAndUserPropic = array();
        foreach($homePagePosts as $p){
            $arrayData = array($p, self::retriveObj(FImage::getClass(), $p->getUser()->getIdImage()));
            $homePagePostsAndUserPropic[] = $arrayData;
        }

        return $homePagePostsAndUserPropic;
    }
}

//---------------------------------------------VIP------------------------------------------------------------------------

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
                $user = FUser::getObj($u);
                $user->setVip(false);
                self::updateUserVip($user);
            }
        }

        if(count($arr['remainSecond']) > 0){
            foreach($arr['remainSecond'] as $d){
                $user = FUser::getObj($d);
                $user->setVip(true);
                self::updateUserVip($user);
            }
        }
        $vipArr = array(); 
        foreach($newIds as $i){
            $vipArr[] = Fuser::getObj($i);
        }
        
        $vipsAndProPic = self::loadUsersAndImage($vipArr);
        //var_dump($vipsAndProPic);

        foreach($vipsAndProPic as &$vp){
            $vp[] = self::getFollowerNumb($vp[0]->getId());
        }
        unset($vp);

        return $vipsAndProPic;
    }

//------------------------------------------------USER UPDATE----------------------------------------------------------------------------
    /**
     * Method to update a User Obj that have changed his info (Biography, Working, StudiedAt, Hobby)
     * @param \EUser $user 
     */
    public static function updateUserInfo($user){
        $field = [['biography', $user->getBio()],['working', $user->getWorking()],['studiedAt', $user->getStudiedAt()],['hobby', $user->getHobby()]];
        $result = FUser::saveObj($user, $field);

        return $result;
    }

    /**
     * Method to update a User that have changed the vip attribute 
     * @param \EUser $user
     */
    public static function updateUserVip($user){
        $field = [['vip', $user->isVip()]];
        $result = FUser::saveObj($user, $field);

        return $result;
    }

    /**
     * Method to update a User that have changed the ban attribute 
     * @param \EUser $user
     */
    public static function updateUserBan($user){
        $field = [['ban', $user->isBanned()]];
        $result = FUser::saveObj($user, $field);

        return $result;
    }

    /**
     * Method to update a User that have changed the profile image  
     * @param \EUser $user
     */
    public static function updateUserIdImage($user){
        $field = [['idImage', $user->getIdImage()]];
        $result = FUser::saveObj($user, $field);

        return $result;
    }

    /**
     * Method to update a User that have changed the warnings attribute 
     * @param \EUser $user
     */
    public static function updateUserWarnings($user){
        $field = [['warnings', $user->getWarnings()]];
        $result = FUser::saveObj($user, $field);

        return $result;
    }

    /**
     * Method to update a User that have changed the username
     * @param \EUser $user
     */
    public static function updateUserUsername($user){
        $field = [['username', $user->getUsername()]];
        $result = FUser::saveObj($user, $field);

        return $result;
    }

    /**
     * Method to update a User that have changed the password 
     * @param \EUser $user
     */
    public static function updateUserPassword($user){
        $field = [['password', $user->getPassword()]];
        $result = FUser::saveObj($user, $field);

        return $result;
    }

//------------------------------------------------POST UPDATE---------------------------------------------------------------------
    /**
     * Method to update a Post that have changed the ban attribute 
     * @param \EPost $post
     */
    public static function updatePostBan($post){
        $field = [['removed', $post->isBanned()]];
        $result = FPost::saveObj($post, $field);

        return $result;
    }

//--------------------------------------------COMMENT UPDATE-----------------------------

    /**
     * Method to update a Cooment that have changed the ban attribute 
     * @param \EComment $comment
     */
    public static function updateCommentBan($comment){
        $field = [['removed', $comment->isBanned()]];
        $result = FComment::saveObj($comment, $field);

        return $result;

    }


//----------------------------------------------VERIFY-----------------------------------------------------

    /**
     * verify if exist a user with this email (also mod)
     * @param String $email
     */
    public static function verifyUserEmail($email){
        $result = FPerson::verify('email', $email);

        return $result;
    }

    /**
     * verify if exist a user with this username (also mod)
     * @param String $username
     */
    public static function verifyUserUsername($username){
        $result = FPerson::verify('username', $username);

        return $result;
    }

//---------------------------------------------------USER PAGE-----------------------------------------------------------------

/**
     * load all post of a user that are not banned
     * @param int $id Refers to the user id 
     */
    public static function loadUserPage($id)
    {
        $allPosts = FPost::postListNotBanned($id);

        if(count($allPosts) > 0){
            usort($allPosts, ['FPost', 'comparePostsByCreationTime']);
        }
        $result = self::loadPostsAndLikes($allPosts);

        return $result;
    }

//-----------------------CATEGORY PAGE----------------------------------------------

    /**
     * return all post that are not banned finded on a specific category
     * @param String $category Refers to the category serched
     */
    public static function loadPostPerCategory($category)
    {
        $field = 'category';
        $categoryPagePost = FPost::getSearched($field, $category);

        usort($categoryPagePost,  ['FPost', 'comparePostsByCreationTime']);

        $categoryPagePostsAndUserPropic = array();
        foreach($categoryPagePost as $p){
            $arrayData = array($p, self::retriveObj(FImage::getClass(), $p->getUser()->getIdImage()));
            $categoryPagePostsAndUserPropic[] = $arrayData;
        }

        return $categoryPagePostsAndUserPropic;
    }

//------------------------EXPLORE PAGE--------------------------------------------
    
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
                $arrayData = array($p, self::retriveObj(FImage::getClass(), $p->getUser()->getIdImage()));
                $explorePagePostsAndUserPropic[] = $arrayData;
            }
    
            return $explorePagePostsAndUserPropic;
        }
    }

//----------------------------VISITED POST PAGE-------------------------------------

    /**
     * Method to load the post of a visited user
     * @param int $idPost Refers to the visited User
     */
    public static function loadPostInVisited($idPost){
        $result = FPost::postInVisited($idPost);

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
    
//----------------------------FOLLOWED PAGE--------------------------------------------

    /**
     * Method to return the Follower User List and their profile pic
     * @param int $idUser
     */
    public static function getFollowerList($idUser){
        $userList = self::getFollowerUserList($idUser);

        $userAndPropicArr = self::loadUsersAndImage($userList);

        return $userAndPropicArr;
    }

//------------------------------------------------------------------------------------

    /**
     * $userinput can be an array of user or an user id,, in this case retrive the user
     * Method to load Users and their Profile Image
     * @param array | int $userInput 
     */
    public static function loadUsersAndImage($userInput){
        $result = array();
        if(is_array($userInput)){
            foreach($userInput as $u){
                $arrayData = array($u, self::retriveObj(FImage::getClass(), $u->getIdImage()));
                $result[] = $arrayData;
            }
        }else{
            $user = self::retriveObj(FUser::getClass(), $userInput);
            $arrayData = array($user, self::retriveObj(FImage::getClass(), $user->getIdImage()));
            $result[] = $arrayData;
        }
        return $result;
    }
    
    /**
     * Method to load Posts and their like number
     * @param array $postArray Refers to an array of Posts
     */
    public static function loadPostsAndLikes($postArray){   
        $result = array();
            foreach($postArray as $p){
                $arrayData = array($p, self::getLikeNumber($p->getId()));
                $result[] = $arrayData;
            }
        return $result;
    }

    /**
     * Method to load in an array the number of like, number of follower and number of followed
     * @param \EPost $post 
     */
    public static function loadFollLikeNumb($post){
        $likeNumb = self::getLikeNumber($post->getId());
        $followerNumb = self::getFollowerNumb($post->getUser()->getId());
        $followedNumb = self::getFollowedNumb($post->getUser()->getId());

        $result = array($likeNumb, $followerNumb, $followedNumb);

        return $result;
    }

    /**
     * Method to return COmments and their user Propic
     * @param int $idPost
     */
    public static function loadCommentsAndUsersPic($idPost){
        $comments = self::getCommentList($idPost);
        $result = array();

        foreach($comments as $c){
            $arrayData = array($c, self::retriveObj(FImage::getClass(), $c->getUser()->getIdImage()));
            $result[] = $arrayData;
        }
        return $result;
    }

    /**
     * Method to load likes of a Post and their users Propic
     * @param int $idPost
     */
    public static function getLikesPage($idPost){
        $user = self::getLikesUserOfAPost($idPost);
        return self::loadUsersAndImage($user);
    }

    /**
     * Method to return a Post(Proxy) with the User setted
     * @param int $idPost
     */
    public static function getPostAndUser($idPost){

        $queryResult = FEntityManagerSQL::getInstance()->retriveObj(FPost::getTable(), FPost::getKey(), $idPost);

        $post = FPost::getPostWithUser($queryResult);

        return $post;

    }

//----------------------------------------------------IMAGE VALIDATION------------------------------------------------------------------------


public static function manageImages($uploadedImages, $post, $idUser){
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
            self::deletePost($post->getId(), $idUser);
            break;
        }else{
            $checkUploadImage = self::uploadImagePost($checkUploadImage, $post);
        }
    }
    return $checkUploadImage;
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

//----------------------------------------AJAX------------------------------------------------------------------------
    /**
     * method to process data to send at the ajax request
     * take all the posts, comments and users from the database
     * create three arrays: 1. post array: 1st value is a date of the post creation, 2nd value is the number of the post in that date
     *                      2. comment array: 1st value is a date of the comments creation, 2nd value is the number of the commnets in that date
     *                      3. user array: 1st value is the number of user of the same age, 2nd value is the age
     * @return array
     */
    public static function retriveAjaxData(){
        $posts = FEntityManagerSQL::getInstance()->selectAll(FPost::getTable());
        $comments = FEntityManagerSQL::getInstance()->selectAll(FComment::getTable());
        $users = FEntityManagerSQL::getInstance()->retriveObj(FPerson::getTable(), 'discr', 'user');

        $postData = [];
        $commentData = [];
        $userData = [];

        if(!empty($posts)){
            $postCountsByDate = [];
            foreach ($posts as $post) {
                // Extract the date part (Y:m:d) from the creation_time attribute
                $dateOnly = date('Y:m:d', strtotime($post['creation_time']));

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
                $dateOnly = date('Y:m:d', strtotime($comment['creation_time']));

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

                $age = $user['year'];
                
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