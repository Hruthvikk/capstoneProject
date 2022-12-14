@extends('mainafterlogin')
@section('content')
    <div class="recipeform">
        <h2>Enter a recipe:</h2>
        <form method="POST" action="{{ route('added-recipe') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-md-3">
                @if (Session::has('success1'))
                    <div class="alert alert-success">{{ Session::get('success1') }}</div>
                @endif
                @if (Session::has('fail1'))
                    <div class="alert alert-danger">{{ Session::get('fail1') }}</div>
                @endif
            </div>


            <div class="form-group col-md-3">
                @if (Session::has('loginUserId'))
                    <input type="hidden" name="user_id" value="{{ Session::get('loginUserId') }}">
                @endif
                <label class="form-label">Recipe Name: </label>
                <input type="text" name="recipename" class="form-control" value="{{ old('recipename') }}"
                    placeholder="Recipe Name" />
                <span class="text-danger">
                    @error('recipename')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <br>
            <div class="form-group col-md-3">
                <label class="form-label">Recipe Description: </label>
                <input type="text" name="recipedescription" class="form-control" value="{{ old('recipedescription') }}"
                    placeholder="Recipe Description" />
                <span class="text-danger">
                    @error('recipedescription')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <br>
            <div class="form-group col-md-3">
                <label class="form-label">Preparation Time: </label>
                <input type="text" name="preparationtime" class="form-control" value="{{ old('preparationtime') }}"
                    placeholder="Preparation Time In Minutes" />
                <span class="text-danger">
                    @error('preparationtime')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <br>
            <div class="form-group col-md-3">
                <label class="form-label">Cooking Time: </label>
                <input type="text" name="cookingtime" class="form-control" value="{{ old('cookingtime') }}"
                    placeholder="Cooking Time In Minute" />
                <span class="text-danger">
                    @error('cookingtime')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <br>
            <div class="form-group col-md-3">
                <label class="form-label" for="mealtime">Meal Time: </label>
                <select id="mealtime" name="mealtime">
                    <option hidden disabled selected>Select An Option</option>
                    @foreach ($mealtime as $mt)
                        <option value="{{ $mt->id }}" name="mealtime" selected>{{ $mt->mealTimeName }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="form-group col-md-3">
                <label class="form-label" for="eatingstyle">Eating style: </label>
                <select id="eatingstyle" name="eatingstyle">
                    <option hidden disabled selected>Select An Option</option>
                    @foreach ($eatingstyle as $es)
                        <option value="{{ $es->id }}" name="eatingstyle" selected>{{ $es->editStyleName }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="form-group col-md-3">
                <label class="form-label" for="occasion">Occasion: </label>

                <select id="occasion" name="occasion">
                    <option hidden disabled selected>Select An Option</option>
                    @foreach ($occasions as $occ)
                        <option value="{{ $occ->id }}" name="occasion" selected>{{ $occ->occassionName }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3">
                <label class="form-label">Ingredients: </label> <br>


                <!-- ------------------------------------------------------------------------------->
                <SCRIPT language="javascript">
                    function addRow(tableID) {

                        var table = document.getElementById(tableID);

                        var rowCount = table.rows.length;
                        var row = table.insertRow(rowCount);

                        var colCount = table.rows[0].cells.length;

                        for (var i = 0; i < colCount; i++) {

                            var newcell = row.insertCell(i);

                            newcell.innerHTML = table.rows[0].cells[i].innerHTML;
                            //alert(newcell.childNodes);
                            switch (newcell.childNodes[0].type) {
                                case "text":
                                    newcell.childNodes[0].value = "";
                                    break;
                                case "checkbox":
                                    newcell.childNodes[0].checked = false;
                                    break;
                                case "select-one":
                                    newcell.childNodes[0].selectedIndex = 0;
                                    break;
                            }
                        }
                    }

                    function deleteRow(tableID) {
                        try {
                            var table = document.getElementById(tableID);
                            var rowCount = table.rows.length;

                            for (var i = 0; i < rowCount; i++) {
                                var row = table.rows[i];
                                var chkbox = row.cells[0].childNodes[0];
                                if (null != chkbox && true == chkbox.checked) {
                                    if (rowCount <= 1) {
                                        alert("Cannot delete all the rows.");
                                        break;
                                    }
                                    table.deleteRow(i);
                                    rowCount--;
                                    i--;
                                }


                            }
                        } catch (e) {
                            alert(e);
                        }
                    }
                </SCRIPT>
                <INPUT type="button" class="btn btn-primary" value="Add Row" onclick="addRow('dataTable')" />

                <INPUT type="button" class="btn btn-danger" value="Delete Row" onclick="deleteRow('dataTable')" />

                <TABLE id="dataTable" width="350px" border="1">
                    <TR>
                        <TD><INPUT type="checkbox" name="chk" /></TD>
                        <TD>
                            <label class="form-label" for="measurement">Measurement: </label>
                            <input type="number" step="0.5" name="measurement[]" />
                        </TD>
                        <TD>
                            <label class="form-label" for="unit">Unit: </label>
                            <select id="unit" name="unit[]">
                                @foreach ($unit as $u)
                                    <option value="{{ $u->unitName }}" name="unit[]" selected>{{ $u->unitName }}
                                    </option>
                                @endforeach
                            </select>
                        </TD>
                        <TD>
                            <label class="form-label">Ingredients: </label> <br>
                            <INPUT type="text" name="ingredients[]" />
                        </TD>
                    </TR>
                </TABLE>
                <!-- ----------------------------------------------------------------------------- -->
            </div>
            <br>
            <div class="form-group col-md-3">
                <label class="form-label">Recipe Image: </label>
                <input type="file" class="btn btn-light" name="recipeimage">
            </div>
            <br>


    </div>
    <br>
    <div class="form-group col-md-3">
        <label class="form-label">Steps: </label> <br>
        <textarea name="steps" col="50" style="width: 650px;"></textarea>
    </div>
    <br>
    <input type="submit" class="searbtn" value="ADD RECIPE">
    </form>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-image-upload-resizer.js"></script>
    <script>
        $('#recipeimage').imageUploadResizer({
            max_width: 250, // Defaults 1000
            max_height: 250, // Defaults 1000
            quality: 0.8, // Defaults 1
            do_not_resize: ['gif', 'svg'], // Defaults []
        });
    </script>
    </div>
@endsection
