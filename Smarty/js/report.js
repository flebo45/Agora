// MODAL FOR THEME

const report = document.querySelector('#report');
const reportModal1 = document.querySelector('.report')

const openReportModal =() => {
    reportModal1.style.display = 'grid'
}

const closeReportModal=(e)=>{
    if(e.target.classList.contains('report')){
        themeModal1.style.display =  'none';
    }
}
//CLOSE MODAL
reportModal1.addEventListener('click', closeReportModal)
report.addEventListener('click', openReportModal)
//FONTS


//MODAL FOR EDIT

const edit = document.querySelector('#edit');
const editModal1 = document.querySelector('.edit')

const openEditModal =() => {
    editModal1.style.display = 'grid'
}

const closeEditModal=(e)=>{
    if(e.target.classList.contains('edit')){
        editModal1.style.display =  'none';
    }
}
//CLOSE MODAL
editModal1.addEventListener('click', closeEditModal)
edit.addEventListener('click', openEditModal)
//FONTS



//MODAL FOR DELETE

const delete1 = document.querySelector('#delete');
const deleteModal1 = document.querySelector('.delete')

const openDeleteModal =() => {
    deleteModal1.style.display = 'grid'
}

const closeDeleteModal=(e)=>{
    if(e.target.classList.contains('delete')){
        deleteModal1.style.display =  'none';
    }
}
//CLOSE MODAL
deleteModal1.addEventListener('click', closeDeleteModal)
delete1.addEventListener('click', openDeleteModal)
//FONTS


