const likeButtons = document.querySelectorAll('.like-button');

likeButtons.forEach(function (button){
    button.addEventListener('click', function(){
        const likeButton = document.querySelector('.like-button');
        likeButton.style.color = 'red';
        likeButton.disabled = true;
    });
});