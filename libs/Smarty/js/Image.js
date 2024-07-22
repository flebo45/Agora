function handleImageUpload() {
  const $imageInput = $("#imageInput");
  const $imagePreview = $("#imagePreview");

  const selectedFiles = $imageInput[0].files; // Array of selected files

  for (let i = 0; i < selectedFiles.length; i++) {
    const file = selectedFiles[i];

    // Create an <img> element for image preview
    const imgElement = $("<img>");
    imgElement.attr("src", URL.createObjectURL(file));
    imgElement.attr("alt", "Image " + (i + 1));
    imgElement.addClass("uploaded-image");

    // Add image preview to the imagePreview element
    $imagePreview.append(imgElement);
  }
}

$("#imageInput").on("change", handleImageUpload);
