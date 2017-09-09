

         
        <div class="{{ ($sector->parent_id) ? 'col-xs-12' : 'col-xs-12 col-sm-12' }} "  >
            <label class="css-input css-checkbox css-checkbox-success">
                @if($sector->parent_id)<input type="checkbox" name="sectors[]" value="{{ $sector->id }}">@endif<span></span> {{ $sector->name }}
            </label>
            <div>
            @foreach ($sector->subsectors as $subsector)  
                @include('layouts.partials.sector', ['sector' => $subsector])
                
            @endforeach
            </div>
            
        </div>
    
  


       
