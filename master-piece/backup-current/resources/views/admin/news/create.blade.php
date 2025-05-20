   <!-- resources/views/admin/news/create.blade.php -->

   @extends('layouts.app')

   @section('content')
       <h1>إنشاء خبر جديد</h1>

       @if(session('error'))
           <div class="alert alert-danger">{{ session('error') }}</div>
       @endif

       <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
           @csrf
           <div class="form-group">
               <label for="title">العنوان</label>
               <input type="text" name="title" class="form-control" required>
           </div>

           <div class="form-group">
               <label for="content">المحتوى</label>
               <textarea name="content" class="form-control" required></textarea>
           </div>

           <div class="form-group">
               <label for="image">صورة الخبر</label>
               <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
               <small class="form-text text-muted">يفضل أن تكون الصورة بحجم 800×600 بكسل</small>
           </div>

           <div class="form-group">
               <label for="is_active">نشط</label>
               <input type="checkbox" name="is_active" value="1">
           </div>

           <button type="submit" class="btn btn-primary">إضافة الخبر</button>
       </form>
   @endsection