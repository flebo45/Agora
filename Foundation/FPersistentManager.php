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
     * call to FUser to find User obj in the db and return it
     */
    public static function retriveUser($id){
        $result = FUser::retriveUser($id);

        return $result;
    }

    /**
     * call to FUser to create or update an user in db
     * @return boolean
     */
    public static function uploadUser(User $user){
        $result = FUser::saveUserInDb($user);

        return $result;
    }

    /**
     * call to FPost to find Post obj in the db and return it
     */
    public static function retrivePost($id){
        $result = FPost::retrivePost($id);

        return $result;
    }

    /**
     * call to FPost to update Post table
     * @return boolean
     */

     public static function uploadPost(Post $post, User $user){
        $result = FPost::savePostInDb($post, $user);

        return $result;
    }

    /**
     *  call to FPost to delete Post in the db (delete post and all comments, image, like and report related to it)
     * @return boolean
     */
    public static function deletePost(Post $post){

        $result = FPost::deletePostInDb($post);

        return $result;
        
    }

    /**
     * call to FComment to find Comment obj in the db and return it
     */
    public static function retriveComment($id){
        $result = FComment::retriveComment($id);

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
     * call to FComment to delete comment in the db
     * @return boolean
     */
    public static function deleteComment(Comment $commnet){

        $result = FComment::deleteCommentInDb($commnet);

        return $result;
    }

    /**
     * call to FLike to find ELike obj in the db and return it
     */
    public static function retriveLike($id){

        $result = FLike::retriveLike($id);

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
     * call to FLike to delete like in the db
     * @return boolean
     */
    public static function deleteLike(ELike $like){

        $result = FLike::deleteLikeInDb($like);

        return $result;
    }

    /**
     * call to FImage to find Image obj in the db and return it
     */
    public static function retriveImage($id){

        $result = FImage::retriveImage($id);

        return $result;
    }

    /**
     * call to FImage to save image of a post in db
     * @return boolean
     */
    public static function uploadImagePost(Image $image, Post $post){

        $result = FImage::saveImagePostIndb($image, $post);

        return $result;
    }

    /**
     * call to FImage to save image of a user in db
     * @return boolean
     */
    public static function uploadImageUser(Image $image, User $user){

        $result = FImage::savePicUSerinDb($image, $user);

        return $result;
    }

    /**
     * call to FImage to delete an image from the db
     * @return boolean
     */
    public static function deleteImage(Image $image){

        $result = FImage::deleteImageInDb($image);

        return $result;
    }

    /**
     * call to FReport to find Report object in the db and return it
     */
    public static function retriveReport($id){

        $result = FReport::retriveReport($id);

        return $result;
    }

    /**
     * call to FReport to save a report for a post in db
     * @return boolean
     */
    public static function uploadReportPost(Report $report, User $user, Post $post){

        $result = FReport::saveReportPostInDb($report, $user, $post);

        return $result;
    }

    /**
     * call to FReport to save a report for a comment in db
     * @return boolean
     */
    public static function uploadReportComment(Report $report, User $user, Comment $comment){

        $result = FReport::saveReportCommentInDb($report, $user, $comment);

        return $result;
    }

    /**
     * call to FReport to delete a report from the db
     * @return boolean
     */
    public static function deleteReport(Report $report){

        $result = FReport::deleteReportInDb($report);

        return $result;
    }

    //TODO metodi che possono subire variazioni-------------------------------------------
    /**
     * return a list of all posts belong to an user
     * @return array
     */
    //TODO verificare se va bene User o mettere solo id
    public static function userPostsList(User $user){

        $result = FPost::postList($user);

        return $result;
    }

    /**
     * return a list of posts belong to an user without banned posts
     * @return array
     */
    public static function userPostsListNotBanned(User $user){

        $result = FPost::postListNotBanned($user);

        return $result;
    }

    /**
     * return a list of all comments belong to a post
     * @return array
     */
    public static function postCommentsList(Post $post){

        $result = FComment::commentList($post);

        return $result;
    }

    /**
     * return a list of comments belong to a post, without banned comments
     * @return array 
     */
    public static function postCommentsListNotBanned(Post $post){

        $result = FComment::commentListNotBanned($post);

        return $result;
    }

    /**
     * return a list of all likes of a post
     * @return array
     */
    public static function postLikeList(Post $post){

        $result = FLike::likeList($post);

        return $result;
    }

     /**
     * return a list of all images of a post
     * @return array
     */
    public static function postImageList(Post $post){

        $result = FImage::imageList($post);

        return $result;
    }

    /**
     * return a list of all the report (for moderator page)
     * @return array 
     */
    public static function reportedPostList(){

        $result = FReport::reportPostList();

        return $result;
    }

}