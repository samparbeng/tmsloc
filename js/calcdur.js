$(document).ready(function () {
    $('#enddate').on('blur', function () {
        var startDate = $("#stadate").val();
        var endDate = $("#enddate").val();
        var start = new Date(startDate);
        var end = new Date(endDate);
        var diffDate = (end - start) / (1000 * 60 * 60 * 24);
        var dur = Math.round(diffDate) + 1;
        $('#txtDur').val(dur);
        alert(dur);
    });
});