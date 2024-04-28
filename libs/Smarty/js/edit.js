
//MODAL FOR DELETE

const delete1 = document.querySelector('#delete');
const deleteModal1 = document.querySelector('.delete');

const openDeleteModal =() => {
    deleteModal1.style.display = 'grid'
}

const closeDeleteModal=(e)=>{
    if(e.target.classList.contains('delete')){
        deleteModal1.style.display =  'none';
    }
}
//CLOSE MODAL
deleteModal1.addEventListener('click', closeDeleteModal);
delete1.addEventListener('click', openDeleteModal);