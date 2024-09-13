@extends('layouts.admin')
@section('title', 'Articles')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable-jquery.css') }}">
@endpush

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Article</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="card">
                <div class="card-header">
                <a href="{{ route('admin.articles.create') }}"><button class="btn btn-primary">Create</button></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table data-table" id="article_table">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Publication Date</th>
                                    <th>Thumbnail</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
    $(document).ready(function() {
        showArticles();
    })

    const showArticles = () => {
        const columns = [
            {
                data: 'category',
                name: 'category'
            },
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'author',
                name: 'author'
            },
            {
                data: 'publication_date',
                name: 'publication_date'
            },
            {
                data: 'thumbnail',
                name: 'thumbnail'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ];

        var article_table = $('#article_table').DataTable({
            processing: true,
            serverSide: true,
            paging: true,
            searching: false,
            destroy: true,
            lengthChange: false,
            ajax: {
                url: route('admin.articles.datatables'),
                data: {
                    // name: $('#form-filter #name').val()
                }
            },
            columnDefs: [
                {
                    targets: '_all',
                    sortable: false,
                    className: 'align-middle'
                },
            ],
            columns: columns,
        });
    }

    const filter = () => {
        showArticles()
    }
</script>
@endpush