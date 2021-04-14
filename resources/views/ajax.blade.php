@if($mode)
@switch($mode)
    @case('getCitiesByCountryId')
            <option value="">-- Select City--</option>
          @if(isset($getAllCities) && count($getAllCities))
             @foreach($getAllCities as $row)
             <option  value="{{$row->id}}">{{ucfirst($row->name)}}</option>
             @endforeach
          @endif
    @break
    @case('getWrFishDescripancies')
           
          @if(isset($discrepancies) && count($discrepancies))
                   <h4>Wr Fish Online QC</h4>
                    <table  class="table table-border table-striped">
                        <thead>
                        <tr class="info">
                            <th style="width: 250px;">Discrepancies</th>
                            <th>Rejection Value Master Value <span class="text-red">offset</span></th>
                            <th>Border Value Master Value <span class="text-red">offset</span></th>
                        </tr>
                        </thead>
                        <tbody>
            @foreach($discrepancies as $value)
                
                        <tr>
                            <td><input type="checkbox" name="discrepancies[is_checked][]" class="minimal" @if($value->is_checked=='1') checked @endif value="1">
                            <label for="company">{{$value->discrepancies}}</label>
                            <input type="hidden" name="discrepancies[discrepancy_id][]" value="{{$value->discrepancy_id}}">
                            <input type="hidden" name="discrepancies[discrepancies][]" value="{{$value->discrepancies}}">
                            <input type="hidden" name="discrepancies[discrepancy_key][]" value="{{$value->discrepancy_key}}">
                            <input type="hidden" name="discrepancies[unit][]" value="{{$value->unit}}">
                            <input type="hidden" name="discrepancies[type][]" value="{{$value->type}}">
                            </td>
                            <td> 
                            <div class="row"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-btn"> <!-- btn-group-vertical-->
                                                <button type="button" class="btn btn-default btn-minus"><span class="glyphicon glyphicon-minus"></span></button>
                                                <input type="hidden" class="offset-input-value" name="discrepancies[rejection_offset_value][]"  value="{{$value->rejection_offset_value?$value->rejection_offset_value:0}}"/>
                                                <input type="hidden" class="input-value" name="discrepancies[rejection_value][]" value="{{$value->rejection_value?$value->rejection_value:0}}"/>
                                                <button type="button" class="btn btn-default text-red offset-label rejection_offset_value" >{{$value->rejection_offset_value?$value->rejection_offset_value:0}} %</button>
                                                <button type="button" class="btn btn-default value-label rejection_value" >{{$value->rejection_value?$value->rejection_value:0}}</button>
                                                <button type="button" class="btn btn-default btn-plus"><span class="glyphicon glyphicon-plus"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </td>
                            <td>
                            <div class="row"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-btn"> <!-- btn-group-vertical-->
                                                <button type="button" class="btn btn-default btn-minus"><span class="glyphicon glyphicon-minus"></span></button>
                                                <input type="hidden" class="offset-input-value" name="discrepancies[border_offset_value][]" value="{{$value->border_offset_value?$value->border_offset_value:0}}"/>
                                                <input type="hidden" class="input-value" name="discrepancies[border_value][]" value="{{$value->border_value?$value->border_value:0}}" />
                                                <button type="button" class="btn btn-default text-red offset-label border_offset_value" >{{$value->border_offset_value?$value->border_offset_value:0}} %</button>
                                                <button type="button" class="btn btn-default value-label rejection_value" >{{$value->border_value?$value->border_value:0}}</button>
                                                <button type="button" class="btn btn-default btn-plus"><span class="glyphicon glyphicon-plus"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </td>
                      </tr>
            @endforeach
              </tbody>
                </table>
                <script>
                  //Flat red color scheme for iCheck
                  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                  });

                  //iCheck for checkbox and radio inputs
                  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass: 'iradio_minimal-blue'
                  });

                  $('.btn-minus').click(function(e){
                      var $parent = $(this).parent();
                      // console.log($parent.parents('tr').find('td input[type=checkbox]:checked').val())
                      if($parent.parents('tr').find('td input[type=checkbox]:checked').val()!=undefined){
                          var offsetlabel = $.trim($parent.find('.offset-label').text().split(' ')[0]);
                          var valuelabel  = $parent.find('.value-label').text();
                          offsetlabel = (parseFloat(offsetlabel)-0.1).toFixed(1);
                          valuelabel     = (parseFloat(valuelabel)-0.1).toFixed(1);
                          $parent.find('.offset-label').text(offsetlabel+' %');
                          $parent.find('.value-label').text(valuelabel);
                          $parent.find('.offset-input-value').val(offsetlabel);
                          $parent.find('.input-value').val(valuelabel);
                      }
                  });

                  $('.btn-plus').click(function(e){
                      var $parent = $(this).parent();
                      // console.log($parent.parents('tr').find('td input[type=checkbox]:checked').val())
                      if($parent.parents('tr').find('td input[type=checkbox]:checked').val()!=undefined){
                          var offsetlabel = $.trim($parent.find('.offset-label').text().split(' ')[0]);
                          var valuelabel  = $parent.find('.value-label').text();
                          offsetlabel = (parseFloat(offsetlabel)+0.1).toFixed(1);
                          valuelabel     = (parseFloat(valuelabel)+0.1).toFixed(1);
                          $parent.find('.offset-label').text(offsetlabel+' %');
                          $parent.find('.value-label').text(valuelabel);
                          $parent.find('.offset-input-value').val(offsetlabel);
                          $parent.find('.input-value').val(valuelabel);
                      }
                  });

                  $('input[type=checkbox][name=wr_fish_online_qc]').on('ifChanged',function(){
                        var selectdata = document.getElementsByName('row_id');
                        if(selectdata.length){
                            var producerId = selectdata[0].value;
                            if(producerId){
                              
                                $(this).on('ifChecked', function(event){
                                  getWrFishDescripancies(producerId);
                                });
                                $(this).on('ifUnchecked', function(event){
                                  $('.WrFishDescripancies').html("");
                                });
                                
                            }
                        }
                   });
                   $('input[type=checkbox][name=cut_fish_online_qc]').on('ifChanged',function(){
                        var selectdata = document.getElementsByName('row_id');
                        if(selectdata.length){
                            var producerId = selectdata[0].value;
                            if(producerId){
                               $(this).on('ifChecked', function(event){
                                getCutFishDescripancies(producerId);
                                });
                                $(this).on('ifUnchecked', function(event){
                                  $('.CutFishDescripancies').html("");
                                });
                            }
                        }
                   });

                </script>
          @endif 
    @break
    @case('getCutFishDescripancies')
        @if(isset($discrepancies) && count($discrepancies))
        <h4>Cut Fish Online QC</h4>
                                <table  class="table table-border table-striped">
                                    <thead>
                                    <tr class="info">
                                        <th style="width: 250px;">Discrepancies</th>
                                        <th>Rejection Value Master Value <span class="text-red">offset</span></th>
                                        <th>Border Value Master Value <span class="text-red">offset</span></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                          @foreach($discrepancies as $value)
                          <tr>
                                <td><input type="checkbox" name="discrepancies[is_checked][]" class="minimal" @if($value->is_checked=='1') checked @endif value="1">
                                <label for="company">{{$value->discrepancies}}</label>
                                <input type="hidden" name="discrepancies[discrepancy_id][]" value="{{$value->discrepancy_id}}">
                                <input type="hidden" name="discrepancies[discrepancies][]" value="{{$value->discrepancies}}">
                                <input type="hidden" name="discrepancies[discrepancy_key][]" value="{{$value->discrepancy_key}}">
                                <input type="hidden" name="discrepancies[unit][]" value="{{$value->unit}}">
                                <input type="hidden" name="discrepancies[type][]" value="{{$value->type}}">
                                </td>
                                <td> 
                                <div class="row"> 
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-btn"> <!-- btn-group-vertical-->
                                                    <button type="button" class="btn btn-default btn-minus"><span class="glyphicon glyphicon-minus"></span></button>
                                                    <input type="hidden" class="offset-input-value" name="discrepancies[rejection_offset_value][]"  value="{{$value->rejection_offset_value?$value->rejection_offset_value:0}}"/>
                                                    <input type="hidden" class="input-value" name="discrepancies[rejection_value][]" value="{{$value->rejection_value?$value->rejection_value:0}}"/>
                                                    <button type="button" class="btn btn-default text-red offset-label rejection_offset_value" >{{$value->rejection_offset_value?$value->rejection_offset_value:0}} %</button>
                                                    <button type="button" class="btn btn-default value-label rejection_value" >{{$value->rejection_value?$value->rejection_value:0}}</button>
                                                    <button type="button" class="btn btn-default btn-plus"><span class="glyphicon glyphicon-plus"></span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </td>
                                <td>
                                <div class="row"> 
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-btn"> <!-- btn-group-vertical-->
                                                    <button type="button" class="btn btn-default btn-minus"><span class="glyphicon glyphicon-minus"></span></button>
                                                    <input type="hidden" class="offset-input-value" name="discrepancies[border_offset_value][]" value="{{$value->border_offset_value?$value->border_offset_value:0}}"/>
                                                    <input type="hidden" class="input-value" class="input-value" name="discrepancies[border_value][]" value="{{$value->border_value?$value->border_value:0}}" />
                                                    <button type="button" class="btn btn-default text-red offset-label border_offset_value" >{{$value->border_offset_value?$value->border_offset_value:0}} %</button>
                                                    <button type="button" class="btn btn-default value-label rejection_value" >{{$value->border_value?$value->border_value:0}}</button>
                                                    <button type="button" class="btn btn-default btn-plus"><span class="glyphicon glyphicon-plus"></span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </td>
                          </tr>
                                  @endforeach
                                    </tbody>
                                </table>
                  <script>
                    //Flat red color scheme for iCheck
                    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                      checkboxClass: 'icheckbox_flat-green',
                      radioClass: 'iradio_flat-green'
                    });

                    //iCheck for checkbox and radio inputs
                    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                      checkboxClass: 'icheckbox_minimal-blue',
                      radioClass: 'iradio_minimal-blue'
                    });
                    $('.btn-minus').click(function(e){
                        var $parent = $(this).parent();
                        // console.log($parent.parents('tr').find('td input[type=checkbox]:checked').val())
                        if($parent.parents('tr').find('td input[type=checkbox]:checked').val()!=undefined){
                            var offsetlabel = $.trim($parent.find('.offset-label').text().split(' ')[0]);
                            var valuelabel  = $parent.find('.value-label').text();
                            offsetlabel = (parseFloat(offsetlabel)-0.1).toFixed(1);
                            valuelabel     = (parseFloat(valuelabel)-0.1).toFixed(1);

                            $parent.find('.offset-label').text(offsetlabel+' %');
                            $parent.find('.value-label').text(valuelabel);
                            $parent.find('.offset-input-value').val(offsetlabel);
                            $parent.find('.input-value').val(valuelabel);
                        }
                    });

                    $('.btn-plus').click(function(e){
                        var $parent = $(this).parent();
                        // console.log($parent.parents('tr').find('td input[type=checkbox]:checked').val())
                        if($parent.parents('tr').find('td input[type=checkbox]:checked').val()!=undefined){
                            var offsetlabel = $.trim($parent.find('.offset-label').text().split(' ')[0]);
                            var valuelabel  = $parent.find('.value-label').text();
                            offsetlabel = (parseFloat(offsetlabel)+0.1).toFixed(1);
                            valuelabel     = (parseFloat(valuelabel)+0.1).toFixed(1);
                            $parent.find('.offset-label').text(offsetlabel+' %');
                            $parent.find('.value-label').text(valuelabel);
                            $parent.find('.offset-input-value').val(offsetlabel);
                            $parent.find('.input-value').val(valuelabel);
                        }
                    });

                    $('input[type=checkbox][name=wr_fish_online_qc]').on('ifChanged',function(){
                        var selectdata = document.getElementsByName('row_id');
                        if(selectdata.length){
                            var producerId = selectdata[0].value;
                            if(producerId){
                              
                                $(this).on('ifChecked', function(event){
                                  getWrFishDescripancies(producerId);
                                });
                                $(this).on('ifUnchecked', function(event){
                                  $('.WrFishDescripancies').html("");
                                });
                                
                            }
                        }
                   });
                   $('input[type=checkbox][name=cut_fish_online_qc]').on('ifChanged',function(){
                        var selectdata = document.getElementsByName('row_id');
                        if(selectdata.length){
                            var producerId = selectdata[0].value;
                            if(producerId){
                               $(this).on('ifChecked', function(event){
                                getCutFishDescripancies(producerId);
                                });
                                $(this).on('ifUnchecked', function(event){
                                  $('.CutFishDescripancies').html("");
                                });
                            }
                        }
                   });

                  </script>
        @endif
    @break
    @case('getLengthWidthSpecies')
    
        @if(isset($allUserSpec) && count($allUserSpec))
            <table class="table table-border table-striped">
            <thead>
                <tr class="info">
                    <th style="width: 250px;">Cut Type</th>
                    <th>Letter</th>
                    <th colspan="2" class="text-center">Cut Length (cm)</th>
                    <th colspan="2" class="text-center" >Cut Weight (g)</th>
                </tr>
                <tr class="info">
                    <th style="width: 250px;"></th>
                    <th></th>
                    <th class="text-center">min</th>
                    <th class="text-center">max</th>
                    <th class="text-center">min</th>
                    <th class="text-center">max</th>
                </tr>
            </thead>
            <tbody>
            @foreach($allUserSpec as $key=>$row)
           
            <tr>
            <td><input type="checkbox" name="length_width_specification[{{$specCount}}][species][is_checked][]" @if($row->is_checked){{'checked'}}@endif class="minimal" value="1" />
            <label for="company">{{$row->cut_type}}</label>
            <input type="hidden" name="length_width_specification[{{$specCount}}][species][spec_type][]" value="@if($row->spec_type){{$row->spec_type}}@else{{$specTypeId}}@endif">
            <input type="hidden" name="length_width_specification[{{$specCount}}][species][spec_id][]" value="@if($row->spec_id){{$row->spec_id}}@else{{'NULL'}}@endif">
            <input type="hidden" name="length_width_specification[{{$specCount}}][species][id][]" value="@if($row->id){{$row->id}}@else{{'NULL'}}@endif">
        
            </td>
            <td>{{$row->letter}}</td>
            <td> 
            <div class="row"> 
                <div class="col-md-6"> 
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-btn"> <!-- btn-group-vertical-->
                                <button type="button" class="btn btn-default length-width-btn-minus"><span class="glyphicon glyphicon-minus"></span></button>
                                <input type="hidden" class="length-width-offset-value" name="length_width_specification[{{$specCount}}][species][min_cut_length_offset][]" value="@if($row->min_cut_length_offset){{$row->min_cut_length_offset}}@else{{'0'}}@endif">
                                <button type="button" class="btn btn-default text-red length-width-offset-label">@if($row->min_cut_length_offset){{$row->min_cut_length_offset}}@else{{'0.0'}}@endif</button>
                                <button type="button" class="btn btn-default">@if($row->min_cut_length){{$row->min_cut_length}}@else{{'100'}}@endif</button>
                                <button type="button" class="btn btn-default length-width-btn-plus"><span class="glyphicon glyphicon-plus"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </td>
            <td> 
            <div class="row"> 
                <div class="col-md-6"> 
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-btn"> <!-- btn-group-vertical-->
                                <button type="button" class="btn btn-default length-width-btn-minus"><span class="glyphicon glyphicon-minus"></span></button>
                                <input type="hidden" class="length-width-offset-value" name="length_width_specification[{{$specCount}}][species][max_cut_length_offset][]" value="@if($row->max_cut_length_offset){{$row->max_cut_length_offset}}@else{{'0'}}@endif">
                                <button type="button" class="btn btn-default text-red length-width-offset-label">@if($row->max_cut_length_offset){{$row->max_cut_length_offset}}@else{{'0.0'}}@endif</button>
                                <button type="button" class="btn btn-default">@if($row->max_cut_length){{$row->max_cut_length}}@else{{'100'}}@endif</button>
                                <button type="button" class="btn btn-default length-width-btn-plus"><span class="glyphicon glyphicon-plus"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </td>
            <td> 
            <div class="row"> 
                <div class="col-md-6"> 
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-btn"> <!-- btn-group-vertical-->
                                <button type="button" class="btn btn-default length-width-btn-minus"><span class="glyphicon glyphicon-minus"></span></button>
                                <input type="hidden" class="length-width-offset-value" name="length_width_specification[{{$specCount}}][species][min_cut_weight_offset][]" value="@if($row->min_cut_weight_offset){{$row->min_cut_weight_offset}}@else{{'0'}}@endif">
                                <button type="button" class="btn btn-default text-red length-width-offset-label">@if($row->min_cut_weight_offset){{$row->min_cut_weight_offset}}@else{{'0.0'}}@endif</button>
                                <button type="button" class="btn btn-default">@if($row->min_cut_weight){{$row->min_cut_weight}}@else{{'100'}}@endif</button>
                                <button type="button" class="btn btn-default length-width-btn-plus"><span class="glyphicon glyphicon-plus"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </td>
            <td>
            <div class="row"> 
                <div class="col-md-6"> 
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-btn"> <!-- btn-group-vertical-->
                                <button type="button" class="btn btn-default length-width-btn-minus"><span class="glyphicon glyphicon-minus"></span></button>
                                <input type="hidden" class="length-width-offset-value" name="length_width_specification[{{$specCount}}][species][max_cut_weight_offset][]" value="@if($row->max_cut_weight_offset){{$row->max_cut_weight_offset}}@else{{'0'}}@endif">
                                <button type="button" class="btn btn-default text-red length-width-offset-label">@if($row->max_cut_weight_offset){{$row->max_cut_weight_offset}}@else{{'0.0'}}@endif</button>
                                <button type="button" class="btn btn-default">@if($row->max_cut_weight){{$row->max_cut_weight}}@else{{'100'}}@endif</button>
                                <button type="button" class="btn btn-default length-width-btn-plus"><span class="glyphicon glyphicon-plus"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </td>
    </tr>
            @endforeach
            </tbody>
            </table>

            <script>
                    //Flat red color scheme for iCheck
                    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                      checkboxClass: 'icheckbox_flat-green',
                      radioClass: 'iradio_flat-green'
                    });

                    //iCheck for checkbox and radio inputs
                    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                      checkboxClass: 'icheckbox_minimal-blue',
                      radioClass: 'iradio_minimal-blue'
                    });
                   

                  

                    

                  </script>

        @endif 
    @break
    
    
    
    @default
    <span>Something went wrong, please try again</span>
@endswitch
@endif 