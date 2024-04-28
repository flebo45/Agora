function handleImageUpload() {
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    const selectedFiles = imageInput.files; // Array di file selezionati

    for (let i = 0; i < selectedFiles.length; i++) {
        const file = selectedFiles[i];

        // Creare un elemento <img> per l'anteprima dell'immagine
        const imgElement = document.createElement('img');
        imgElement.src = URL.createObjectURL(file);
        imgElement.alt = 'Image ' + (i + 1);
        imgElement.classList.add('uploaded-image');

        // Aggiungere l'anteprima dell'immagine all'elemento imagePreview
        imagePreview.appendChild(imgElement);
    }
}
