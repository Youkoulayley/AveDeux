<div class="ui field {{ $errors->has('thumb') ? ' error' : '' }}">
    <div id="dropdownThumb" class="ui fluid selection dropdown">
        <input name="thumb" id="thumb" class="thumb" type="hidden" value="{{ $slot }}">
        <i class="dropdown icon"></i>
        <div class="ui black text default text">Choisissez un type d'avis</div>
        <div class="menu">
            <div class="item" data-value="1">
                <i class="green smile large icon"></i>
                Avis favorable
            </div>
            <div class="item" data-value="2">
                <i class="grey meh large icon"></i>
                Avis neutre
            </div>
            <div class="item" data-value="3">
                <i class="red frown large icon"></i>
                Avis défavorable
            </div>
        </div>
    </div>

    @if ($errors->has('thumb'))
        <div class="ui red message">
            <strong>{{ $errors->first('thumb') }}</strong>
        </div>
    @endif
</div>

@push('scripts')
    {{ Html::script('/js/components/dropdowns/dropdown_thumb.js') }}
@endpush