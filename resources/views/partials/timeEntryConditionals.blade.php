<script>
        //script to conditional show/hide fields based on work_type_id

        
        $('#work_type_id').change(function () {
        var val = $(this).val();

            if (val === '1') {
                $('#caseload_row, #population_row').show();
                $('#student_row').show();
                
                //require visible radio fields
                $('input:radio').attr('required', 'required');  

            }
            else {
                //hide options
                $('#population_row, #caseload_row').hide();
                $('#student_row').hide();
                //deselect options on hide
                $("##selectall-student > option").prop("selected","");
                $("#selectall-student").trigger("change");
                //$('#eventNew input:radio').removeAttr('checked');
                
                //unrequire hidden radio fields
                $('input:radio').removeAttr('required');
                
                //select null value on update form when non-caseload/population work_type_id is selected
                $('input[name=caseload][value=' + 0 + ']').prop('checked',true);
                $('input[name=population_type][value=' + 0 + ']').prop('checked',true);  
            }
        }) .change();//manually call change event so that on load it run the change event

    </script>