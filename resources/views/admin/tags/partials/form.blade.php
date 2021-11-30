<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'ingrese el nombre de la etiqueta']) !!}

    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'ingrese el slug de la etiqueta', 'readonly']) !!}

    @error('slug')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('color', 'Color:') !!}
    {!! Form::select('color', $colors, null, ['class' => 'form-control']) !!}

    @error('color')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
{{-- <div class="form-group">
    <label for="">Color</label>
    <select name="color" id="" class="form-control">
        <option value="danger">Color Rojo</option>
        <option value="success">Color Verde</option>
        <option value="secondary">Color Azul</option>
    </select>
</div> --}}