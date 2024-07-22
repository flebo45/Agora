const $deleteButton = $("#delete");
const $deleteModal = $(".delete");

const openDeleteModal = () => {
  $deleteModal.css("display", "grid");
};

const closeDeleteModal = (e) => {
  if ($(e.target).hasClass("delete")) {
    $deleteModal.css("display", "none");
  }
};

// Event bindings
$deleteModal.on("click", closeDeleteModal);
$deleteButton.on("click", openDeleteModal);
