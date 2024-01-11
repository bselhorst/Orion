@props(['title', 'name', 'description', 'type', 'required' => false, 'class' => 'mb-3', 'mask' => '', 'data_reverse' => false, 'data' => ''])
<div class="{{$class}}">
    <label class="form-label" for="{{$name}}">{{ $title }}</label>
    <input 
    type="{{$type}}" 
    class="form-control" 
    id="{{$name}}"
    name="{{$name}}" 
    placeholder="{{$description}}" 
    value="{{ @$data->$name }}" 
    {{ ($mask)?'data-toggle=input-mask':'' }}
    {{ ($mask)?'data-mask-format='.$mask:'' }} 
    {{ ($data_reverse)?'data-reverse=true':'' }}
    {{ ($required)?'required':'' }}>
    <div class="invalid-feedback">
        Campo obrigatório.
    </div>
</div>
