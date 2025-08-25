<link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
{{-- <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
<link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
{{-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> --}}
<link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
@stack('css-plugins')
<style>
    footer.sticky-footer {
        padding: 1rem 0;
    }

    .error {
        color: #e74a3b;
        font-size: 80%;
        position: relative;
        line-height: 1.5;
        width: 100%;
        font-weight: bolder;
        margin-top: .25rem;
    }

    .bg-login-image {
        background: url("{{ asset('img/login-bg.jpg') }}");
        background-position: center;
        background-size: cover;
    }

    .table>tbody>tr>td,
    .table>tfoot>tr>td,
    .table>thead>tr>td {
        padding: 0.75rem;
    }

    table.table {
        border: 1px solid #dee2e6;
        margin-bottom: 1rem !important;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
    }

    .dataTables_scroll {
        margin-bottom: 1rem;
    }

    .dataTables_scrollBody {
        padding-bottom: .5rem;
    }

    @media (min-width: 768px) {

        .sidebar .nav-item .nav-link span {
            font-size: 1rem;
            display: inline;
        }
    }
</style>
{{-- CSS Select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stack('styles')
