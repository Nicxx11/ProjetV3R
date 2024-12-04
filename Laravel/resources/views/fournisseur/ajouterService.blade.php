@extends('layouts.app')

@section('titre', 'Ajouter un service')

@section('contenu')
    <form method="POST" action="{{ route('service.store') }}">
        @csrf
        <div class="form-group">
            <label for="services">Select Services</label>
            <input type="hidden" name="idFournisseur" value="{{$id}}">
            <select id="services" name="services[]" multiple="multiple" class="form-control">
                <!-- Options will be loaded dynamically via AJAX -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <script>
        $(document).ready(function() {
            $('#services').select2({
                placeholder: 'Select services',
                allowClear: true,
                ajax: {
                    url: '{{ route("service.fetchServices") }}', 
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.results 
                        };
                    },
                    cache: true 
                }
            });
        });
    </script>
@endsection
