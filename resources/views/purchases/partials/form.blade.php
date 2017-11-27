    
    <div class="form-group{{ $errors->has('purchase_file') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            @if(!isset($purchase) || (isset($purchase) && $purchase->isPending()))
            <div class="form-material form-material-success">
                <input class="form-control" type="file" id="purchase_file" name="purchase_file">
                <label for="purchase_file" title="Archivo de orden de compra">Purchase Order file</label>
                @if ($errors->has('purchase_file'))
                    <span class="help-block">
                        <strong>{{ $errors->first('purchase_file') }}</strong>
                    </span>
                @endif
            </div>
            @endif
            @if(isset($purchase) && $purchase->file)
              
                <delete-file :transaction-id="{{ $purchase->id }}" url-file="{{ getFilePurchase($purchase) }}" filename="{{ $purchase->file }}" :read="{{ $purchase->isPending() ? 'false' : 'true' }}">Delete Current File</delete-file>
              
            @endif
        </div>
    </div>
    
    <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
        <div class="col-xs-12">
            <div class="form-material form-material-success">
                <input class="form-control" type="text" id="comments" name="comments" value="{{ isset($purchase) ? $purchase->comments : ''  }}" {{ (isset($purchase) && !$purchase->isPending()) ? 'readonly' : '' }}>
                 <textarea class="form-control" name="comments" id="comments" cols="30" rows="3" {{ (isset($purchase) && !$purchase->isPending()) ? 'readonly' : '' }}>{{ isset($purchase) ? $purchase->comments : ''  }}</textarea>
                <label for="comments" title="Comentarios adicionales">Additional comment</label>
                @if ($errors->has('comments'))
                    <span class="help-block">
                        <strong>{{ $errors->first('comments') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    
    
    
    
    <div class="form-group">
        <div class="col-xs-12 col-sm-6 col-md-5">
        @if(isset($purchase) && $purchase->isPending() || !isset($purchase))
            <button class="btn btn-success" type="submit" title="Guardar">Save</button>
        @endif
            <a class="btn btn-default" href="/requests/{{ $quotation->request->id }}/quotations" title="Atras">Back</a>
        </div>
    </div>

    
    
