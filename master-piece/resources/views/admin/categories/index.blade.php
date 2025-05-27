@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">التصنيفات</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> إضافة تصنيف جديد
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="categoriesTable">
                    <thead>
                        <tr>
                            <th style="width: 50px">#</th>
                            <th>الاسم</th>
                            <th>الوصف</th>
                            <th>الحالة</th>
                            <th>مميز</th>
                            <th style="width: 200px">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ Str::limit($category->description, 50) }}</td>
                                <td>
                                    <span class="badge badge-{{ $category->is_active ? 'success' : 'danger' }}">
                                        {{ $category->is_active ? 'مفعل' : 'غير مفعل' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $category->is_featured ? 'primary' : 'secondary' }}">
                                        {{ $category->is_featured ? 'مميز' : 'عادي' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذا التصنيف؟')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#categoriesTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Arabic.json"
            }
        });
    });
</script>
@endpush
@endsection
