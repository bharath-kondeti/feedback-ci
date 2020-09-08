 $(document).ready(function(){ 
$("#dash-daterange").flatpickr({
    altInput: !0,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    defaultDate: "today"
});

 $("#basicwizard").bootstrapWizard(), $("#progressbarwizard").bootstrapWizard({
        onTabShow: function(t, r, a) {
            var o = (a + 1) / r.find("li").length * 100;
            $("#progressbarwizard").find(".bar").css({
                width: o + "%"
            })
        }
    });

 }); 