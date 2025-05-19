@extends('layouts.admin')

@section('content')
<a href="{{ route('admin.subscribers.edit', $subscriber) }}" class="btn btn-warning btn-sm">
<a href="{{ route('admin.subscribers.index') }}" class="btn btn-secondary btn-sm">
@endsection 