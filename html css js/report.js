

const report=document.querySelector('#report');
const reportModal=document.querySelector('.report');

const openReportModal =() => {
    reportModal.style.display = 'grid'
}

const closeReportModal=(e)=>{
    if(e.target.classList.contains('report')){
        reportModal.style.display =  'none';
    }
}
//CLOSE MODAL
reportModal.addEventListener('click', closeReportModal)
report.addEventListener('click', openReportModal)
