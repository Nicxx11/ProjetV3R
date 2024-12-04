@extends('layouts.app')

@section('titre', 'Ajouter un service')

@section('contenu')
    <form method="POST" action="{{ route('service.store') }}">
        @csrf
        <div class="form-group">
            <label for="services">Select Services</label>
            <select id="services" name="services[]" multiple="multiple" class="form-control">
                <!-- Options will be loaded dynamically via AJAX -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <!-- Include jQuery and Select2 JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <script>
        $(document).ready(function() {
            // Initialize Select2 with AJAX for lazy loading
            $('#services').select2({
                placeholder: 'Select services',
                allowClear: true,
                ajax: {
                    url: '{{ route("service.fetchServices") }}',  // URL to the controller method
                    dataType: 'json',
                    delay: 250,  // Delay before the request is sent (to prevent too many requests)
                    data: function (params) {
                        return {
                            q: params.term // Search term entered by the user
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.results  // The results from the controller
                        };
                    },
                    cache: true  // Cache the results to improve performance
                }
            });
        });
    </script>
@endsection
