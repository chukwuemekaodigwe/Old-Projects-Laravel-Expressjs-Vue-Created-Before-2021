@if(!empty($item))

<div class="form-group row">
    <label for="{{ $item }}"
        class="col-md-2 col-form-label text-md-right">{{ __(ucwords(str_replace('_', ' ', ($item)))) }}</label>

    <div class="col-md-10">

        <input id="{{ $item }}" type="{{ isset($type) ? $type : 'text' }}" class="form-control @error($item) is-invalid @enderror"
            name="{{ $item }}" value="{{ old($item) }}" required autocomplete="{{ $item }}"  >

        @error($item)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@endif

@if(!empty($radio))
<div class="form-group row">
<div class="switch-wrap d-flex justify-content-between">
    <div class="primary-radio">
        <input type="{{!empty($type2) ? $type2 : 'radio'}}" id="primary-radio" class="@error($item) is-invalid @enderror" name="{{ $radio }}"
            value="1" required>
        <label for="primary-radio" class="col-form-label">
            {{ __(ucfirst(str_replace('_', ' ', ($text)))) }}
        </label>
    </div>

    @error($radio)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
</div>
@endif

@if(!empty($big))

<div class="form-group row">
    <label for="{{ $big }}"
        class="col-md-2 col-form-label text-md-right">{{ __(ucwords(str_replace('_', ' ', ($big)))) }}</label>
    <div class="col-md-10">

        <textarea id="{{ $id }}" style="min-height:200px!important"
            class="form-control @error($big) is-invalid @enderror" name="{{ $big }}" value="{{ old($big) }}"
            autocomplete="{{ $big }}"></textarea>


        @error($big)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@endif

@if(!empty($button))
<div class="form-group row mb-0">
    <div class="">
        <button type="submit" class="btn btn-{{ $class }}" style="">
            {{ __(ucwords($button)) }}
        </button>
    </div>

</div>





@endif

