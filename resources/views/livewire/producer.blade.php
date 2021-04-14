<div>
    @livewireStyles
    <form action="" method="">
    <table id="example1" class="table table-bordered table-striped">
      
        <thead>
        <tr>
            <th></th>
            <th>Type</th>
            <th>Capacity</th>
            <th># Of Grades</th>
        </tr>
        </thead>
        <tbody>
            @foreach($orderProduct as $key => $value)
        <tr>
            <td><label for="catch">Gradding</label></td>   
            <td> <select class="form-control">
                <option value="1">Roller Gradder1</option>
                <option value="2">Roller Gradder2</option>
                </select>
            </td>
            <td><input type="text" name="granding" id="granding" class="form-control" placeholder="Enter granding"> </td>
            <td><input type="text" name="granding" id="granding" class="form-control" placeholder="Enter granding"> </td>
        </tr>
        <tr>
            <td><label for="catch">Gradding</label></td>   
            <td> <select class="form-control">
                <option value="1">Roller Gradder1</option>
                <option value="2">Roller Gradder2</option>
                </select>
            </td>
            <td><input type="text" name="granding2" id="granding2" class="form-control" placeholder="Enter granding"> </td>
            <td><input type="text" name="granding2" id="granding2" class="form-control" placeholder="Enter granding"> </td>
        </tr>
        <tr>
            <td><label for="catch">Total</label></td>   
            <td><input type="text" name="total1" id="total1" class="form-control" placeholder="Enter total"> </td>
            <td><input type="text" name="total1" id="total1" class="form-control" placeholder="Enter total"> </td>
            <td><input type="text" name="total1" id="total1" class="form-control" placeholder="Enter total"> </td>
        </tr>
         
        @endforeach

        </tbody>
    </table>
    <button>Submit</button>
</form>
@livewireScripts
</div>
