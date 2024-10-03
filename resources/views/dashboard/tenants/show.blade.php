@extends('dashboard.layouts.master')

@section('title', 'Show tenant')

@push('style')
@endpush

@section('main')

    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                Show tenant
            </h2>
            <div class="hidden h-full py-1 sm:flex">
                <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
            </div>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li class="flex items-center space-x-2">
                    <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                        href="{{ route('homePage') }}">home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li class="flex items-center space-x-2">
                    <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                        href="{{ route('tenants.index') }}">tenants cards</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li>Show tenant</li>
            </ul>
        </div>
        <div class="grid grid-cols-12 lg:gap-6">
            <div class="col-span-12 pt-6 lg:col-span-12 lg:pb-6">
                <div class="card p-4 lg:p-6">

                    <!-- Blog Post -->
                    {{-- <div class="mt-6 font-inter text-base text-slate-600 dark:text-navy-200">
                        <h1 class="text-xl font-medium text-slate-900 dark:text-navy-50 lg:text-2xl">
                        </h1>
                        <img class="mt-5 h-80 w-100 rounded-lg object-cover object-center"
                            src="{{ $tenants->imageWithFullPath }}" alt="image">
                    </div> --}}



                    <div class="col-xs-12 mb-3">
                        <div class="form-group">
                            <strong>Tenant Name:</strong>
                            <label class="badge badge-secondary text-dark"> {{ $tenants->name }}</label>
                        </div>
                    </div>

                    <div class="col-xs-12 mb-3">
                        <div class="form-group">
                            <strong>Username:</strong>
                            <label class="badge badge-secondary text-dark"> {{ $tenants->user->name }}</label>
                        </div>
                    </div>

                    <div class="col-xs-12 mb-3">
                        <div class="form-group">
                            <strong>Email:</strong>
                            <label class="badge badge-secondary text-dark"> {{ $tenants->user->email }}</label>
                        </div>
                    </div>

                    <div class="col-xs-12 mb-3">
                        <div class="form-group">
                            <strong>Phone:</strong>
                            <label class="badge badge-secondary text-dark"> {{ $tenants->user->phone }}</label>
                        </div>
                    </div>

                    <div class="col-xs-12 mb-3">
                        <div class="form-group">
                            <strong>Photo:</strong>
                            <img class="mt-5 h-80 w-100 rounded-lg object-cover object-center"
                            src="{{ $tenants->user->imageWithFullPath }}" alt="image">
                        </div>
                    </div>


                </div>


            </div>

        </div>
    </main>

@endsection
@push('scripts')
@endpush
