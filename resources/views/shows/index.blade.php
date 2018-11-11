@extends('layouts.app')

@section('pageTitle', 'Séries TV')
@section('pageDescription', 'Webzine communautaire des séries TV - Critiques et actualité des séries tv, notez et laissez vos avis sur les derniers épisodes, créez votre planning ...')

@section('content')
    <div class="row ui stackable grid ficheContainer">
        <div id="LeftBlock" class="eleven wide column">
            <div class="ui segment">
                <h1>Liste des séries</h1>

                <div class="row">
                    <div class="ui four special cards">
                    @foreach($shows as $show)
                        @include('shows.index_cards')
                    @endforeach
                    </div>
                </div>

                <div class="PaginateRow row">
                    <div class="column center aligned">
                        {{ $shows->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div id="RightBlock" class="four wide column">
            <div class="ui segment">
                <h1>Filtres</h1>

                <div class="ui form">
                    <div class="field">
                        <label>Chaine(s)</label>
                        <div class="ui fluid search multiple selection dropdown channels">
                            <input name="channels" type="hidden">
                            <i class="dropdown icon"></i>
                            <div class="default text">Chaine(s)</div>
                            <div class="menu">
                            </div>
                        </div>

                        <div class="ui red hidden message"></div>
                    </div>

                    <div class="field">
                        <label>Nationalité(s)</label>
                        <div class="ui fluid search multiple selection dropdown nationalities">
                            <input name="channels" type="hidden">
                            <i class="dropdown icon"></i>
                            <div class="default text">Nationalité(s)</div>
                            <div class="menu">
                            </div>
                        </div>
                        <div class="ui red hidden message"></div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.special.cards .image').dimmer({
            on: 'hover'
        });

        $(document).ready(function() {
            $('.ui.fluid.search.selection.dropdown.channels')
                .dropdown({
                    apiSettings: {
                        url: '/api/channels/list?name-lk=*{query}*'
                    },
                    fields: {
                        remoteValues: "data",
                        value: "name"
                    },
                    onChange: function($q) {

                    }
                })
            ;

            $('.ui.fluid.search.selection.dropdown.nationalities')
                .dropdown({
                    apiSettings: {
                        url: '/api/nationalities/list?name-lk=*{query}*'
                    },
                    fields: {
                        remoteValues: "data",
                        value: "name"
                    }
                })
            ;
        });
    </script>
@endpush
