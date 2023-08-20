<?php
;
/*class CManagePost{

    //constructor
    public function __construct(){

    }

    //methods
    public static function showForm(){
        //verify if User is logged 
        if(CUser::isLogged()){
            
            //call to a view that show the form page
        }
        else{
            //show the homepage of non registered user
        }

    }

    public function newSketch(){
        //verify if the user is logged
      
        $userID = $_SESSION['userID'];

        //other value are taken by a viewClass 

        //test data
        $title = 'Title';
        $body = 'Body';
        $category = 'Category';
        $creationDate = date("Y/m/d");
        $creationTime = date("h:i:sa");
        $postID = 'postId';

        //data will be stored in the session 
        //and we call the view to show the sketch

        //$post = new Epost($postID, $title, $body, $category, 0, $userID, null, $creationDate, $creationTime);

        //return $post;

        }

    public function loadPost(){
            //check if the user is logged
        //take the data from the _SESSION[] and create EPost obj

        //test data
        $userID = $_SESSION['userID'];
        $title = 'Title';
        $body = 'Body';
        $category = 'Category';
        $creationDate = date("Y/m/d");
        $creationTime = date("h:i:sa");
        $postID = 'postId';

        $post = new Epost($postID, $title, $body, $category, 0, $userID, null, $creationDate, $creationTime);

        //the post will be stored in the db

        //call to PM
        $pm = FPersistentManager::getInstance();

        //PM call FPost to compute data and give the result
        $pm->loadPost($post);

            //else header('')
    }

    //tasto annulla
    public function undoSketch(){
        //check if the user is logged 
        //call to the view that show the form 
        // fill the form with the __SESSION data 
    }

    public function modifyPost($postID){
        //check if the user is logged
        //call to PM
        $pm = FPersistentManager::getInstance();

        //PM call to FPost tho perform query and return Post info
        $post = $pm->selectPost($postID);
        //probably we need to serialize and unserialize

        //save the data in the __SESSION
        //call to the view that show the form that will fill the form
    }

    public function deletePost($postID){
        //check if the user is logged
        //call to PM
        $pm = FPersistentManager::getInstance();

        $pm->deletePost($postID);
    }

}*/



class CManagePost{

    public static function comparePostsByCreationTime($post1, $post2) {
        $time1 = $post1->getTime();
        $time2 = $post2->getTime();

        if ($time1 == $time2) {
            return 0;
        }

        return ($time1 > $time2) ? -1 : 1;
    }
 

   /* public static function creaPost(){
        if (CUser::isLogged()){
            //crea un nuovo oggetto in VManagePost
            $view = new VManagePost();
            //richiamo il metodo della view sull'oggetto appena creato in VManagePost
            $view->creation_post(true, null);
        }
        else{
           // header('Location: /logBook/User/profile');
        }

    }

    // classe che permette il salvataggio di nuovo post o di una modifica a un post già esistente
    public static function savePost($postID){
        //verifica se l'utente è loggato o meno
        if(CUser::isLogged()){
            //ottenimento dell'istanza di USession
            USession::getInstance();
            //ottenimento dell'istanza di FPersistentManager
            $pm = FPersistentManager::getInstance();
            //recupero dell'utentedella sessione
            $user = unserialize(USession::getSessionElement('user'));
            //salvataggio nuovo post 
            if($postID == null){
                //controllo dei dati: se ci sono dei dati fondamentali forniti dall'HTML
                //se i dati sono stati forniti correttamente: recupero dati dal modulo
                //creazione di un oggetto EPost che viene salvato nel db tramite il FPersistentManager
                //qualcosa se non sono stati inseriti abbastanza dati
            }
            //salvataggio di una modifica a un post esistente
            else{
                //controllo se i dati essenziali non sono nulli (come titolo,...), se uno dei campi è vuoto chiamiamo il metodo annullaModifiche??
                //recupero dati dal modulo
                //recupero del post esistente dal db e aggiornamento del post
                //gestione delle immagini con metodo upload
            }

        }
        //se l'utente non è loggato viene rimandato alla pagina di login/profilo
        else{
             // header('Location: /logBook/User/profile');
        }
    }

    public static function deletePost($postID){
        //verifica se l'utente è loggato o meno
        if(CUser::isLogged()){
            USession::getInstance();
            $pm = FPersistentManager::getInstance();
            //controllo l'esistenza del post con l'ID specificato
            $exist = $pm->exist("IDpost", $postID, 'FPost');
            //viene recuperato l'identificativo di 'user' e la sua rappresentazione serializzata viene convertito in un oggetto php
            //$user contiene un oggetto che rappresenta l'utente
            $user = unserialize(USession::getSessionElement('user'));
            //condizione che verifica se il post preso esiste
            if($exist){
                //verifica se l'ID dell'utente corrente corrisponde con l'ID dell'autore del post
                if($user->getUserID() == $pm->getUserByPost($postID)){
                    //caricamento del post dal sistema e memorizzato nella variabile $post
                    $post = $pm->load('IDpost', $postID, 'FPost');
                    //rimozione delle segnalazioni del post
                    //rimozione delle reazioni/like??
                    //rimozione dei commenti associati al post
                    $pm->delete('IDpost', $postID, 'FComment');
                    //rimozione delle immagini associate al post
                    $pm->delete('IDpost', $post->getPostID(), 'FImage');
                    //eliminazione del post
                    $pm->delete('IDpost', $postID, 'FPost');

                    //reindirizzamento al profilo dell'utente
                    //header('Location: ')
                }
                //se l'utente non è l'autore del post reindirizzamento alla homepage
                else{
                    //header('Location: /logBook/User/home');
                }
            }
            //se il post non esiste reindirizzamento alla homepage
            else{
                //header('Location: /logBook/User/home');
            }
        }
        //se l'utente non è loggato viene rimandato alla pagina di login
        else{
            //header('Location: /logBook/User/login');
        }
    }

    public static function deleteExistingImage($ID, $postID){

    }

    static function writeComment(?){
        //verifica se l'utente è loggato
        if(CUser::isLogged()){
            //si ottiene un'istanza della classe FPersistentManager
            $pm = FPersistentManager::getInstance();
            //verifica se esiste un oggetto di tipo FPost con l'attributo IDpost corrispondente al valore passato come argomento $IDpost
            $exist = $pm->exist(?, 'FPost');
            //se FPost corrispondente esiste
            if($exist){
                //ottenimento istanza di USession
                USession::getInstance();
                $user = unserialize(USession::getSessionElement('user'));
                //ottenimento del commento 
                //$content = $_POST['comment'];??
                if($? != null){
                    $comment = new EComment(?);
                    //memorizza l'oggetto commento
                    $pm->store($comment);
                }
            } 
            //
            //header('Location: /logBook/Research/postDetail/' . $IDpost);
        }
        else{
            //header('Location: /logBook/User/login');
        }

    }

    static function like()
    */


}
?>


