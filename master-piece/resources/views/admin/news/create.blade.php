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
               <label for="title">عنوان الخبر</label>
               <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
               @error('title')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
           </div>

           <div class="form-group">
               <label for="content">محتوى الخبر</label>
               <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="5" required>{{ old('content') }}</textarea>
               @error('content')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
           </div>

           <div class="form-group">
               <label for="image">صورة الخبر</label>
               <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
               @error('image')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
           </div>

           <div class="form-group">
               <label for="is_active">نشط</label>
               <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
           </div>

           <div class="form-group">
               <label for="published_at">تاريخ النشر</label>
               <input type="datetime-local" name="published_at" id="published_at" class="form-control @error('published_at') is-invalid @enderror" value="{{ old('published_at') }}">
               @error('published_at')
                   <div class="invalid-feedback">{{ $message }}</div>
               @enderror
           </div>

           <button type="submit" class="btn btn-primary">حفظ الخبر</button>
       </form>
   @endsection
