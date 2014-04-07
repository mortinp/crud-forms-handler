$(document).ready(function() {
    $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        language: 'es',
        //startDate: "2012-01-01",
        //endDate: "2015-01-01",
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true
    });
});