@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        @if($news->image)
            <img src="{{ asset($news->image) }}" alt="{{ $news->title }}" class="card-img-top img-fluid" style="max-height: 400px; object-fit: cover;">
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $news->title }}</h5>
            <p class="text-muted">
                <i class="fas fa-calendar-alt me-2"></i>
                {{ $news->created_at->locale('ar')->isoFormat('dddd DD MMMM YYYY') }}
                <i class="fas fa-clock ms-3 me-2"></i>
                {{ $news->created_at->locale('ar')->isoFormat('h:mm a') }}
            </p>
            <div class="card-text">
                {!! nl2br(e($news->content)) !!}
            </div>
            <div class="mt-4 text-center">
                <a href="{{ route('news.index') }}" class="btn btn-secondary">العودة إلى الأخبار</a>
            </div>
        </div>
    </div>
</div>
@endsection
