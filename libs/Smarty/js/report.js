const $report = $("#report");
const $reportModal = $(".report");

const openReportModal = () => {
  $reportModal.css("display", "grid");
};

const closeReportModal = (e) => {
  if ($(e.target).hasClass("report")) {
    $reportModal.css("display", "none");
  }
};

// Event bindings
$reportModal.on("click", closeReportModal);
$report.on("click", openReportModal);
