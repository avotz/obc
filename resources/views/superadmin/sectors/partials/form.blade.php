
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="name" name="name" value="{{ isset($sector) ? $sector->name : old('name') }}">
                <label for="name" title="Nombre"> Name</label>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong title="{{ validationRequiredES('Nombre') }}">{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
</div>
<div class="form-group{{ $errors->has('name_es') ? ' has-error' : '' }}">
    <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="name_es" name="name_es" value="{{ isset($sector) ? $sector->name_es : old('name_es') }}">
                <label for="name_es" title="Traducción"> Translate</label>
                @if ($errors->has('name_es'))
                    <span class="help-block">
                        <strong title="{{ validationRequiredES('Traducción') }}">{{ $errors->first('name_es') }}</strong>
                    </span>
                @endif
            </div>
        </div>
</div>
<div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
    <div class="col-xs-12">
        <div class="form-material form-material-success">
                
                <select name="parent_id" id="parent_id"  class="js-select2 form-control" style="width:100%;" data-placeholder="Type to search for a sector" title="Escriba para buscar un sector"> 
                    @foreach ($sectors as $sectorItem)
                            <option value=""  title="Raíz">Root</option>
                            <option value="{{ $sectorItem->id }}" {{ isset($sector) && $sector->parent_id == $sectorItem->id ? 'selected' : '' }} title="{{ $sectorItem->name_es }}">{{ $sectorItem->name }}</option>
                        @endforeach
                </select>
            
                <!-- <sector-subsectors :sectors="{{ $sectors }}"></sector-subsectors> -->
                <label for="sectors" title="Sector Padre"> Parent Sector</label>
                @if ($errors->has('parent_id'))
                <span class="help-block">
                    <strong title="{{ validationRequiredES('Sector Padre') }}">{{ $errors->first('parent_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
    
    

   
    
    
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 col-md-5">
            <button class="btn btn-block btn-success" type="submit" title="Guardar">Save</button>
        </div>
    </div>
                   