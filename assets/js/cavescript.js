jQuery(document).ready(function ($) {
        tab = $('.tabs h3 a');

        tab.on('click', function (event) {
            event.preventDefault();
            tab.removeClass('active');
            $(this).addClass('active');

            tab_content = $(this).attr('href');
            $('div[id$="tab-content"]').removeClass('active');
            $(tab_content).addClass('active');
        });
        
        
    
    
    
        
        
        
        
        
    });
    
    
    //For First DropDown
//        $("#add_patron").click(function () {
//            console.log("reaching click!");
//            $("#patron_entry").show();
//            $("#patron_entry").removeAttr("hidden");
//            $("#add_patron").hide();
//            $("#confirm_add").show();
//        });
//
//        $("#confirm_add").click(function () {
//            $("#patron_entry").hide();
//            $("#add_patron").show();
//            $("#confirm_add").hide();
//            $("#patron_dropdown").append('<option>' + $("#patron_value").val() + '</option>');
//        });
        
        //For Cave Patron
        function addPatron(){
            $("#patron_entry").show();
            $("#patron_entry").removeAttr("hidden");
            $("#add_patron").hide();
            $("#confirm_patron").show();
        }
        
        function confirmPatron(){
            $("#patron_entry").hide();
            $("#add_patron").show();
            $("#confirm_patron").hide();
            $("#patron_dropdown").append('<option>' + $("#patron_value").val() + '</option>');
        }
        
        //For Cave Period
        function addPeriod(){
            $("#period_entry").show();
            $("#period_entry").removeAttr("hidden");
            $("#add_period").hide();
            $("#confirm_period").show();
        }
        
        function confirmPeriod(){
            $("#period_entry").hide();
            $("#add_period").show();
            $("#confirm_period").hide();
            $("#period_dropdown").append('<option>' + $("#period_value").val() + '</option>');
        }
        
        
        //For Cave Type
        function addType(){
            $("#type_entry").show();
            $("#type_entry").removeAttr("hidden");
            $("#add_type").hide();
            $("#confirm_type").show();
        }
        
        function confirmType(){
            $("#type_entry").hide();
            $("#add_type").show();
            $("#confirm_type").hide();
            $("#type_dropdown").append('<option>' + $("#type_value").val() + '</option>');
        }
        
        
        
//        function myfunc1() {
//        $('#submit_button').show();
//        $("#submit_button").removeAttr("hidden");
//        $('#confirm_button').hide();
//    }
    
    


