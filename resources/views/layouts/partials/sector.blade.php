

         
        <div class="{{ ($sector->parent_id) ? 'col-xs-12' : 'col-xs-12 col-sm-12' }} "  >
            <label class="css-input css-checkbox css-checkbox-success">
                @if($sector->parent_id)<input type="checkbox" name="sectors[]" value="{{ $sector->id }}" @if(isset($company) && $company->hasSector($sector->id)) checked @endif>@endif<span></span> <span title="{{ $sector->name_es }}">{{ $sector->name }}</span>
            </label>
            <div>
            @foreach ($sector->children as $subsector)  
                @include('layouts.partials.sector', ['sector' => $subsector])
                
            @endforeach
            </div>
            
        </div>
    
  


       
