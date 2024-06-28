<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <link rel="stylesheet" href="{{ asset('assets/datatables/dataTables.tailwindcss.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/choices/choices.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/choices/custom.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-white">
    <div class="min-h-screen bg-gray-100">
        <!-- Page Content -->
        <main>
            @include('layouts.navigation')
            {{ $slot }}
        </main>
    </div>
    @session('success')
    @php
    flash()->flash('success', session()->get('success'));
    session()->forget('success');
    @endphp
    @endsession

    @stack('modals')
    <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/dataTables.tailwindcss.js') }}"></script>
    <script src="{{ asset('assets/choices/choices.min.js') }}"></script>
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dataTable = $('#dataTable').DataTable({
                "pagingType": "simple",
                "language": {
                    "emptyTable": "No data available in table",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "Showing 0 to 0 of 0 entries",
                    "infoFiltered": "(filtered from _MAX_ total entries)",
                    "lengthMenu": "Show _MENU_ entries",
                    "search": "Search:",
                    "zeroRecords": "No matching records found",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    }
                }
            });

        });

    function confirmDelete(url) {
        if (confirm('Are you sure you want to delete this brand?')) {
            handleDeleteAction(url);
        }
    }

    function handleDeleteAction(url) {
        var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                "_token": token,
                "_method": 'DELETE',
            },
            success: function() {
                alert('Data deleted successfully.');
                window.location.reload();
            },
            error: function(xhr) {
                console.error('Error:', xhr);
                alert('An error occurred while deleting data.');
            }
        });
    }
    </script>

</body>

</html>
