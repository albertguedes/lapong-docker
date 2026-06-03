@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="text-xl font-bold text-indigo-600">Laravel</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <span class="mr-4 text-sm text-gray-700">{{ auth()->user()->name }}</span>
                    <form action="/laravel/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-sm text-gray-500 hover:text-gray-700">
                            Sign out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Dashboard</h1>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Welcome, {{ auth()->user()->name }}!
                    </h3>
                    <div class="mt-2 max-w-xl text-sm text-gray-500">
                        <p>You are logged in to the Laravel application.</p>
                    </div>
                    <div class="mt-4">
                        <a href="/"
                            class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                            ← Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection