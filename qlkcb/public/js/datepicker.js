jQuery(document).ready(function($) {
    'use strict';
    var dd=new Date();
    if($('#datetimepickerfilter').length){
        $('#datetimepickerfilter').datetimepicker({
            icons: {
                    date: "fa fa-calendar-alt",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },

            allowInputToggle: true,
            defaultDate:dd,
            format: "DD/MM/YYYY"
        });

    }

    if($('#datetimepickerfilter1').length){
        $('#datetimepickerfilter1').datetimepicker({
            icons: {
                    date: "fa fa-calendar-alt",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },

            allowInputToggle: true,
            defaultDate:dd,
            format: "DD/MM/YYYY"
        });

    }

    if($('#datetimepickerfilter2').length){
        $('#datetimepickerfilter2').datetimepicker({
            icons: {
                    date: "fa fa-calendar-alt",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },

            allowInputToggle: true,
            defaultDate:dd,
            format: "DD/MM/YYYY"
        });

    }

});