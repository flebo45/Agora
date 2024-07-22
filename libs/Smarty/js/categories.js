// CATEGORIES
const $categories = $(".categories");
const $category = $categories.find(".category");
const $categorySearch = $("#category-search");

// CATEGORY SEARCH
const searchCategory = () => {
  const val = $categorySearch.val().toLowerCase();
  console.log(val);
  $category.each(function () {
    let name = $(this).find("h5").text().toLowerCase();
    if (name.indexOf(val) !== -1) {
      $(this).css("display", "flex");
    } else {
      $(this).css("display", "none");
    }
  });
};

$categorySearch.on("keyup", searchCategory);
