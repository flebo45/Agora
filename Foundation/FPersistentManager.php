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

    public static function selectUser($id){
        $result = FUser::retriveUser($id);
        return $result;

    }

    /**
     * call to FPost to update Post table
     * @return boolean
     */

    public static function createPost(Post $post, User $user){
        $result = FPost::savePostInDb($post, $user);

        return $result;
    }

    /**
     *  call to FPost to delete obj in the db
     * @return boolean
     */
    public static function deletePost(Post $post){

        $result = FPost::deletePostInDb($post);

        return $result;
        
    }

    /**
     * call to FUser to create or update an user in db
     * @return boolean
     */
    public static function createOrUpdateUser(User $user){

        $result = FUser::saveUserInDb($user);

        return $result;
    }

    /**
     * call to FComment to create comment in db
     * @return boolean
     */
    public static function createComment(Comment $comment, Post $post, User $user){

        $result = FComment::saveCommentInDb($comment, $post, $user);

        return $result;
    }

    /**
     * call to FLike to save like in db
     * @return boolean
     */
    public static function createLike(ELike $like, Post $post, User $user){

        $result = FLike::saveLikeInDb($like, $post, $user);

        return $result;
    }

    /**
     * call to FComment to delete comment in the db
     * @return boolean
     */
    public static function deleteComment(Comment $commnet){

        $result = FComment::deleteCommentInDb($commnet);

        return $result;
    }

    /**
     * call to FLike to delete like from db
     * @return boolean
     */
    public static function deleteLike(ELike $like){

        $result = FLike::deleteLikeInDb($like);

        return $result;
    }

    /**
     * return a list of all the post created by the user
     * @return array || null
     */
    public static function userPostList(User $user){

        $result = FPost::postList($user);

        return $result;
    }

    /**
     * create the Image in the db 
     * @return boolean
     */
    public static function updateUserProPic(Image $image, User $user){

        $result = FImage::saveUserPic($image, $user);

        return $result;
    }

    /**
     * return a list of all comments related by a post
     * @return array || null
     */
    public static function postCommentList(Post $post){

        $result = FComment::commentList($post);

        return $result;
    }

    /**
     * retun an array off the like of a post
     * @return array || null
     */
    public static function postLikeList(Post $post){

        $result = FLike::likeList($post);

        return $result;
    }

//change
    public function selectPost($postID){
        //perform query and return all data
    }


    public function search($keyword){
        //perform query via FUser and FPost and take result
        // result is am array of item
    }

    public function selessctUser($userID){
        //perform query via FUser and take result
    }

    public function loadReport($reportID){
        //call to FReport that update report table
    }

    public function reportTable(){
        //perform a query via FReport 
    }

    public function unsetReport(){
        //update Report Table via FReport
    }

    

}