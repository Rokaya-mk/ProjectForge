 <div class="row">
     <div class="col-md-6">
         <div class="form-group">
             <label for="name">Name</label>
             <input type="text" class="form-control" name="name"
                 value ="{{ old('name', $department->name ?? null) }}">
         </div>
     </div>
     {{-- <div class="col-md-6">
         <div class="form-group">
             <label for="director_id">Director</label>
             <select name="director_id" class="form-control" id="">
                 <option>Select a person</option>
                 <option value="1"
                     @if (!empty($department)) @selected($department->director_id == 1)    
                    @else
                        @selected(old('director_id') == 1) @endif>
                     IT Director
                 </option>
                 <option value="2"
                     @if (!empty($department)) @selected($department->director_id == 2)    
                    @else
                        @selected(old('director_id') == 2) @endif>
                     HR Director
                 </option>
             </select>
         </div>
     </div> --}}
 </div>
 {{--  start show errors --}}
 @if ($errors->any())
     <ul>
         @foreach ($errors->all() as $error)
             <li> {{ $error }} </li>
         @endforeach
     </ul>
 @endif
 {{--  End show errors --}}
