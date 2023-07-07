<?php 

class FComment extends FEntityManager{

    private $table_name = "comment";

    private $table_field = "id";

    private $entity_class = Comment::class;

    # methods

    public static function getTable(){

        return self::$table_name;
    }

    public static function getField(){

        return self::$table_field;
    }

    public static function getEntityClass(){

        return self::$entity_class;
    }

    public static function saveCommentInDb(Comment $comment, Post $post, User $user){
        $fem = FEntityManager::getInstance();

        $objects = [$comment, $post, $user];

        $result = $fem->saveObjects($objects);

        return $result;
    }

    public static function deleteCommentInDb(Comment $comment){
        $id = $comment->getId();
        
        $fem = FEntityManager::getInstance();

        $result = $fem->deleteObjInDb(self::getEntityClass(), $id);

        return $result;
    }

    public static function commentList(Post $post){
        $id = $post->getId();
        $field = "post_id";

        $fem = FEntityManager::getInstance();

        $result = $fem->objectList(self::getTable(), $field, $id);

        return $result;
    }

   
}