
<div class="form-group {{ str_slug($permission->label,'-') }}">
    <div class="col-xs-12">
        <label class="css-input switch switch-success">
            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"  @if (isset($user) && $user->can($permission->name) ) checked @endif><span></span> <span title="{{ $permission->label_es }}"> {{ $permission->label }}</span>
        </label>
    </div>
    
</div>