const report = document.querySelector("#report");
const reportModal1 = document.querySelector(".report");
const openReportModal = () => {
  reportModal1.style.display = "grid";
};

const closeReportModal = (e) => {
  if (e.target.classList.contains("report")) {
    themeModal1.style.display = "none";
  }
};
//CLOSE MODAL
reportModal1.addEventListener("click", closeReportModal);
report.addEventListener("click", openReportModal);
