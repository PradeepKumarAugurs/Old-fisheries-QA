    <!-- jQuery 2.1.3 -->
    <!-- <script src="{{ URL::asset('admin/plugins/jQuery/jquery-2.1.3.min.js') }}"></script> -->
    <script src="{{ URL::asset('admin/plugins/jQueryUI/jquery-1.12.4.js') }}" type="text/javascript"></script>
    <!-- Tree table -->
   <script type="text/javascript" src="{{ URL::asset('admin/tree/dist/jquery-simple-tree-table.js') }}"></script>
     
    <!-- jQuery UI 1.11.2 -->
    <script src="{{ URL::asset('admin/plugins/jQueryUI/jquery-ui.js') }}" type="text/javascript"></script>  
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
   
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ URL::asset('admin/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>  
    
    <!--  This Use  For Dashboard Graph Only -->

    <!-- Morris.js charts -->
    <!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> -->
    <script src="{{ URL::asset('admin/plugins/ajax/libs/raphael/raphael-min.js') }}"></script>
    <script src="{{ URL::asset('admin/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="{{ URL::asset('admin/plugins/sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="{{ URL::asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ URL::asset('admin/plugins/knob/jquery.knob.js') }}" type="text/javascript"></script>

    <!--  This Use  For Dashboard Graph Only -->
    <script src="https://maps.googleapis.com/maps/api/js?key=&libraries=places"></script>
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
<!--AIzaSyBuCIAfY1ODCoVTvJyBtkZe-irKy0ljPXY    AIzaSyD7OIFvK1-udIFDgZwvY7FVTFHMHipNy6Y -->
    <!--   Dropzone Js -->
    <script type="text/javascript" src="{{ URL::asset('admin/plugins/dropzone/js/dropzone.js')}}"></script>

   <!-- InputMask -->
   <script src="{{ URL::asset('admin/plugins/input-mask/jquery.inputmask.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('admin/plugins/input-mask/jquery.inputmask.extensions.js')}}" type="text/javascript"></script>


    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ URL::asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="{{ URL::asset('admin/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="{{ URL::asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="{{ URL::asset('admin/plugins/fastclick/fastclick.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('admin/dist/js/app.min.js') }}" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ URL::asset('admin/dist/js/pages/dashboard.js') }}" type="text/javascript"></script>
     <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script> -->
     <script src="{{ URL::asset('admin/plugins/ajax/libs/moment/moment.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ URL::asset('admin/dist/js/demo.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('admin/plugins/daterangepicker/jquery.comiseo.daterangepicker.js') }}" type="text/javascript"></script>
    
   
    <script src="{{ URL::asset('admin/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('admin/dist/js/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
    

    <!-- DATA TABES SCRIPT -->
    <script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('admin/plugins/datatables/dataTables.bootstrap.js')}}" type="text/javascript"></script>

    <script src="{{ URL::asset('admin/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
   
   
   <!-- daterangepicker -->
    <script src="{{ URL::asset('admin/plugins/timepicker/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('admin/dist/js/custom.js') }}" type="text/javascript"></script>


   <script>
       
   var person = {fishing:0,unloading:1,storageAtReception:2,iceSupply:3,gradding:4,wrProcessing:5,cuttingReverting:6, cuttingSize:7,freezingBatch:8,freezingCountinous:9,storage:10,transportation:11,storage:10,catchs:0, hatches:0, reading:0, histamine:0, scientific:0, organoleptic:0, chemical_creteria:0, heavy_metal:0, microbiological:0};

   $('.add-new-column').click(function(){
            if(confirm("are you sure want to create a new column ?")){
                var gettable =  $(this).attr("data-table");
                $('.modal-title').html('Add New Column For '+gettable.charAt(0).toUpperCase()+gettable.slice(1));
                $('#tableName').val(gettable); 
                $('#AddColumn_Modal').modal('toggle');
            }
        });
        $('#type').change(function(){
            var getSelectedValue =  $(this).val(); 
            console.log($(this).val())
            if(getSelectedValue=='4'){
                $('.item_list_column').html(`<label for="item_list">Item List </label> <small> ( with comma seprated value )</small>
                            <input type="text" name="item_list" id="item_list" placeholder="Item List" class="form-control">`); 
            }
            else{
                $('.item_list_column').html(""); 
            }
        }); 
        $('#addColumnModalForm').submit(function(e){
            e.preventDefault();
            if($("#addColumnModalForm #name").val()){
                $('.newcolumnError').html("");
                $("#addColumnModalForm #name").removeClass('is-invalid');
                if($("#type").val()){
                    $('.newcolumnError').html("");
                    $("#type").removeClass('is-invalid'); 
                    if($("#type").val()=='4'){
                        if($('#item_list').val()){
                            $('.newcolumnError').html("");
                            $('#item_list').removeClass('is-invalid'); 
                            createNewColumn($("#tableName").val(),$("#addColumnModalForm #name").val(),$("#type").val(),$("#item_list").val());
                        }
                        else{
                            $('.newcolumnError').html('<span class="text-danger">Item List is required </span>');
                            $('#item_list').addClass('is-invalid'); 
                        }
                    }
                    else if($("#type").val()!="4"){
                        $('.newcolumnError').html("");
                        createNewColumn($("#tableName").val(),$("#addColumnModalForm #name").val(),$("#type").val(),"");
                    }
                }
                else{
                    $('.newcolumnError').html('<span class="text-danger">Column Type fields is required </span>'); 
                    $("#type").addClass('is-invalid'); 
                }
            }  
            else{
                $('.newcolumnError').html('<span class="text-danger">Column Name fields is required </span>'); 
                $("#addColumnModalForm #name").addClass('is-invalid'); 
            }
        }); 
        $('.add-new-row').click(function(){
            console.log('#'+$(this).attr("data-table")+'-table tbody')
            $('#'+$(this).attr("data-table")+'-table tbody').append(`<tr>${$('#'+$(this).attr("data-table")+'-table tr').eq(1).html()}</tr>`);
        });


      

   /** 
  * Create A new fields  for  table  data 
 */
 function createNewColumn(tableName,name,type,item_list){
    console.log(typeof tableName)
    item_list = item_list?item_list:"";
    var sectionNumber =  person[tableName]; 
    console.log(sectionNumber);
    var rowcount = document.getElementById(tableName+'-table').rows[0].cells.length;
    var columnNumber = rowcount; 
    if(5 > 3 ){
        $('#'+tableName+'-table tr').each(function(e,p){
            if(e == '0')
            {  
                $(this).append('<th><input type="text" name="sections['+sectionNumber+'][custom_fields][name][]" value="'+name+'"  class="form-control @error("sections.'+sectionNumber+'.custom_fields.name.0") is-invalid @enderror">\
                <input type="hidden" name="sections['+sectionNumber+'][custom_fields][type][]" value="'+type+'"  class="form-control">\
                <input type="hidden" name="sections['+sectionNumber+'][custom_fields][item_list][]" value="'+item_list+'" class="form-control"></th>');
            }
            else{
                $(this).append(`<td><input type="text" name="sections[`+sectionNumber+`][custom_rows][customdata][`+columnNumber+`][value][]" class="form-control" ></td>`);
            }
        });
        $('#AddColumn_Modal').modal('toggle');
    }
    else{
        $('.newcolumnError').html('<span class="text-danger">Somthing  went wrong ! </span>'); 
    }
}
</script> 
   
    

    