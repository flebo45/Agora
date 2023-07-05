<?php 

class FComment extends FDataBase{

    private $table_name = "comment";

    private $table_field = "id";

    # methods

    public static function getTable(){

        return self::$table_name;
    }

    public static function getField(){

        return self::$table_field;
    }

    public static function createCommentInDb(Comment $comment){
        $id = $comment->getId();

        $db = FDataBase::getInstance();

        //perform a query via Fdatabase That check if the post already exist
        $query_result = $db->existInDb(self::getTable(),self::getField(), $id);

        //if exist = true Perform query via Fdatabase to Update the table
        if($query_result) $db->updateRaw($comment);

        //else perform a query via Fdatabse to create post in the table
        else {$db->createRaw($comment);}
    }

    public static function commentList(Post $post){
        $id = $post->getId();
        $field = "post_id";

        $db = FDataBase::getInstance();

        $result = $db->objectList(self::getTable(), $field, $id);

        return $result;
    }
}