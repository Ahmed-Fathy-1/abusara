@extends('dashboard.layouts.master')
@section('main')

<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center space-x-4 py-5 lg:py-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-navy-50 lg:text-2xl">
            Item Details
        </h2>
        <div class="hidden h-full py-1 sm:flex">
            <div class="h-full w-px bg-gray-300 dark:bg-navy-600"></div>
        </div>
        <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
            <li class="flex items-center space-x-2">
                <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="#">Forms</a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </li>
            <li> Item </li>
        </ul>
    </div>

    <div class="grid grid-cols-12 gap-6 sm:gap-8 lg:gap-10">
        <div class="col-span-12 sm:col-span-8">
            <div class="card p-5 shadow-md">
                <h3 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                    Item Information
                </h3>
                <div class="mt-4 space-y-5">

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <label class="block">
                            <h4 class="text-sm font-semibold">Key (Arabic):</h4>
                            <span class="block text-gray-600 dark:text-navy-200">{{ $Item->key_ar }}</span>
                        </label>

                        <label class="block">
                            <h4 class="text-sm font-semibold">Key (English):</h4>
                            <span class="block text-gray-600 dark:text-navy-200">{{ $Item->key_en }}</span>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <label class="block">
                            <h4 class="text-sm font-semibold">Value:</h4>
                            <span class="block text-gray-600 dark:text-navy-200">{{  $Item->value }}</span>
                        </label>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

@endsection
