$("#stadate").datepicker({

}); 
$("#enddate").datepicker({
    onSelect: function () {
        myfunc();
    }
}); 

function myfunc(){
    var start= $("#stadate").datepicker("getDate");
    var end= $("#enddate").datepicker("getDate");
    days = (end- start) / (1000 * 60 * 60 * 24);
    alert(Math.round(days));
}