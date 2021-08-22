<div class="box-body">
     <div class='form-group{{ $errors->has("$lang.title") ? ' has-error' : '' }}'>
        {!! Form::label("{$lang}[nama]", trans('mahasiswa::mahasiswas.form.nama')) !!}
        {!! Form::text("{$lang}[nama]", old("$lang.nama"), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('mahasiswa::mahasiswas.form.nama')]) !!}
        {!! $errors->first("$lang.nama", '<span class="help-block">:message</span>') !!}
    </div>
</div>
