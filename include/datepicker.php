<<<<<<< HEAD
<script type="text/javascript">
              
          $(document).ready(function(){
         

                $("#datepicker").datepicker({
                    numberOfMonth:1,
                    format: 'yyyy/mm/dd',
                    todayHighlight:true,
                    autoclose:true,
                   // minDate: new Date(2018,30,3);

                });
            
        })
                           
=======
<script type="text/javascript">
               
               $(document).ready(function(){
           
                   var date_input=$('input[name="date"]');
                   
                   var options={
           
                       format: 'dd/mm/yyyy',
                       todayHighlight:true,
                       autoclose:true,
                   };
                   date_input.datepicker(options);
               })
           
                           
>>>>>>> bf7f366cc74f214b10df6489c3becb4bc9694c0c
    </script>