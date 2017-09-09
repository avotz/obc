
           
            @if($sector->children->count())  
                <optgroup label="{{ $sector->name }}">
                    @foreach ($sector->children as $subsector)
                       
                           
                                @include('layouts.partials.sector-select', ['sector' => $subsector])
                           
                       
                    @endforeach
                </optgroup>
            @else 
                <option value="{{ $sector->id }}" @if(isset($company) && $company->hasSector($sector->id)) selected="selected" @endif>{{ $sector->name }}</option>
            @endif
           
    
  


       
