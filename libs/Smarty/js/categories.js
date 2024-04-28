
//CATEGORIES
const categories = document.querySelector('.categories');
const category = categories.querySelectorAll('.category');
const categorySearch = document.querySelector('#category-search');


// CATEGORY SEARCH
const searchCategory = () => {
    const val = categorySearch.value.toLowerCase();
    console.log(val);
    category.forEach(type => {
        let name = type.querySelector('h5').textContent.toLowerCase();
        if (name.indexOf(val) !== -1) {
            type.style.display = 'flex';
        } else {
            type.style.display = 'none';
        }
    })
}

categorySearch.addEventListener('keyup' , searchCategory );

