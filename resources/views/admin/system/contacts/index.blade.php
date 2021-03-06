@extends('layouts.admin')

@section('pageTitle', 'Admin - Contacts')

@section('breadcrumbs')
    <a href="{{ route('admin') }}" class="section">
        Administration
    </a>
    <i class="right angle icon divider"></i>
    <a href="{{ route('admin.system') }}" class="section">
        Système
    </a>
    <i class="right angle icon divider"></i>
    <div class="active section">
        Contacts
    </div>
@endsection

@section('content')
    <div>
        <div class="ui grid">
            <div class="ui height wide column">
                <h1 class="ui header" id="adminTitre">
                    Logs
                    <span class="sub header">
                        Liste de toutes les demandes de contact
                    </span>
                </h1>
            </div>
        </div>

        <table id="tableAdmin" class="ui sortable selectable celled table">
            <thead>
            <tr>
                <th>Objet</th>
                <th>Email</th>
                <th>Traité par</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            @foreach($contacts as $contact)
                <tr>
                    <td><a href="{{ route('admin.contacts.view', $contact->id) }}">{{ $contact->objet }}</a></td>
                    <td>{{ $contact->email }}</td>
                    <td>
                        @if(is_null($contact->admin_id))
                            -
                        @else
                            {{ $contact->user['username'] }}
                        @endif
                        </td>
                    <td>{{ $contact->created_at }}</td>
                    <td class="center aligned">
                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="post" >
                            {{ csrf_field() }}

                            <input type="hidden" name="_method" value="DELETE">

                            <button class="circular ui red icon button" value="Supprimer cette demande de contact ?" onclick="return confirm('Voulez-vous vraiment supprimer cette demande de contact ?')">
                                <i class="icon remove"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $('#tableAdmin').DataTable( {
            "order": [[ 4, "desc" ]],
            "language": {
                "lengthMenu": "Afficher _MENU_ enregistrements par page",
                "zeroRecords": "Aucun enregistrement trouvé",
                "info": "Page _PAGE_ sur _PAGES_",
                "infoEmpty": "Aucun enregistrement trouvé",
                "infoFiltered": "(filtré sur _MAX_ enregistrements)",
                "sSearch" : "",
                "oPaginate": {
                    "sFirst":    	"Début",
                    "sPrevious": 	"Précédent",
                    "sNext":     	"Suivant",
                    "sLast":     	"Fin"
                }
            }} );
    </script>
@endpush