
           
            @if($sector->children->count())  
                <optgroup label="{{ $sector->name }}" title="{{ $sector->name_es }}">
                    @foreach ($sector->children as $subsector)
                       
                           
                                @include('layouts.partials.sector-select', ['sector' => $subsector])
                           
                       
                    @endforeach
                </optgroup>
            @else 
                <option value="{{ $sector->id }}" @if(isset($element) && $element->hasSector($sector->id)) selected="selected" @endif title="{{ $sector->name_es }}">{{ $sector->name }}</option>
            @endif
           
    
  


       
