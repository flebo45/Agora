const likeButtons = document.querySelectorAll('.like-button');

likeButtons.forEach(function (button){
    button.addEventListener('click', function(){
        const postId = button.getAttribute('data-id');


        const xhr = new XMLHttpRequest();
        xhr.open("POST", "url_del_tuo_server.php", true);
        xhr.setRequestHeader("Content-Type", "application/json");

        const data = {
            action: "like", // Puoi utilizzare questo campo per identificare l'azione
            postId: postId, // Cambia questo con l'ID del post che l'utente sta "Mi Piaceando"
        };

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // La richiesta è stata completata con successo
                // Puoi gestire la risposta qui se il server invia una conferma
                alert("Hai messo Mi Piace a questo post!");
            }
        };

// Invia la richiesta con i dati JSON
        xhr.send(JSON.stringify(data));


        likePost(postId);
    });
});

function likePost(postId){

    //richiesta like su php

    const likeButton = document.querySelector('.like-button');
    likeButton.style.color = 'red';
    likeButton.disabled = true;
}
