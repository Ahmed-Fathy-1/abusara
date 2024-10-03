@extends('dashboard.layouts.master')

@section('title', 'About Us')

@push('style')
@endpush

@section('main')

    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                About Us
            </h2>
            <div class="hidden h-full py-1 sm:flex">
                <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
            </div>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li class="flex items-center space-x-2">
                    <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                       href="{{ route('homePage') }}">Home</a>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li>About Us</li>
            </ul>
        </div>
        <div>
            @include('dashboard.partials._session')
        </div>

        <div class="col-span-12 grid lg:col-span-12">
            <div class="card">
                <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                    <div class="flex items-center space-x-2">
                        <div
                            class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-1 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                            <i class="fa-solid fa-circle-plus"></i>
                        </div>
                        <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                            About Us Information
                        </h4>

                    </div>
                </div>
                <form action="{{ route('aboutUs.update', 1) }}" method="POST" enctype="multipart/form-data" id="about-form">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4 p-4 sm:p-5">
                        <!-- Title -->
                        <label class="block">
                            <span>Title</span>
                            <input name="title"
                                   class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                   placeholder="Enter Company Name" type="text" value="{{ $about->title }}">
                        </label>
                        @error('title')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <!-- Description -->
                        <label class="block">
                            <span>Description</span>
                            <textarea name="description"
                                      class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                      placeholder="Enter Description">{{ $about->description }}</textarea>
                        </label>
                        @error('description')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <!-- Mission -->
                        <label class="block">
                            <span>Mission</span>
                            <textarea name="mission"
                                      class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                      placeholder="Enter Mission">{{ $about->mission }}</textarea>
                        </label>
                        @error('mission')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <!-- Mission Image -->
                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Mission Image</span>
                        </label>
                        <label
                            class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                            <input onchange="previewImage(this, 'mission-image-preview')" tabindex="-1" type="file" name="mission_image"
                                   class="pointer-events-none absolute inset-0 h-full w-full opacity-0" />
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                <span>Choose File</span>
                            </div>
                        </label>
{{--                        <img id="mission-image-preview" src="{{ $about->mission_image ? asset('uploads/'.$about->mission_image) : '' }}" class="mt-2" alt="Mission Image" width="100">--}}

                        @error('mission_image')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <!-- Value -->
                        <label class="block">
                            <span>Value</span>
                            <textarea name="value"
                                      class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                      placeholder="Enter Values">{{ $about->value }}</textarea>
                        </label>
                        @error('value')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <!-- Value Image -->
                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Value Image</span>
                        </label>
                        <label
                            class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                            <input onchange="previewImage(this, 'value-image-preview')" tabindex="-1" type="file" name="value_image"
                                   class="pointer-events-none absolute inset-0 h-full w-full opacity-0" />
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                <span>Choose File</span>
                            </div>
                        </label>
{{--                        <img id="value-image-preview" src="{{ $about->value_image ? asset('uploads/'.$about->value_image) : '' }}" class="mt-2" alt="Value Image" width="100">--}}

                        @error('value_image')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <!-- Vision -->
                        <label class="block">
                            <span>Vision</span>
                            <textarea name="vision"
                                      class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                      placeholder="Enter Vision">{{ $about->vision }}</textarea>
                        </label>
                        @error('vision')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <!-- Vision Image -->
                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Vision Image</span>
                        </label>
                        <label
                            class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                            <input onchange="previewImage(this, 'vision-image-preview')" tabindex="-1" type="file" name="vision_image"
                                   class="pointer-events-none absolute inset-0 h-full w-full opacity-0" />
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                <span>Choose File</span>
                            </div>
                        </label>
{{--                        <img id="vision-image-preview" src="{{ $about->vision_image ? asset('uploads/'.$about->vision_image) : '' }}" class="mt-2" alt="Vision Image" width="100">--}}

                        @error('vision_image')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <!-- Team -->
                        <label class="block">
                            <span>Team</span>
                            <textarea name="team"
                                      class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                      placeholder="Enter Team Information">{{ $about->team }}</textarea>
                        </label>
                        @error('team')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <!-- Team Image -->
                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Team Image</span>
                        </label>
                        <label
                            class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                            <input onchange="previewImage(this, 'team-image-preview')" tabindex="-1" type="file" name="team_image"
                                   class="pointer-events-none absolute inset-0 h-full w-full opacity-0" />
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                <span>Choose File</span>
                            </div>
                        </label>
{{--                        <img id="team-image-preview" src="{{ $about->team_image ? asset('uploads/'.$about->team_image) : '' }}" class="mt-2" alt="Team Image" width="100">--}}

                        @error('team_image')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror

                        <!-- Main Image -->
                        <label class="block pt-4">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Main Image</span>
                        </label>
                        <label
                            class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                            <input onchange="previewImage(this, 'main-image-preview')" tabindex="-1" type="file" name="image"
                                   class="pointer-events-none absolute inset-0 h-full w-full opacity-0" />
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                <span>Choose File</span>
                            </div>
                        </label>
{{--                        <img id="main-image-preview" src="{{ $about->image ? asset('uploads/'.$about->image) : '' }}" class="mt-2" alt="Main Image" width="100">--}}

                        @error('image')
                        <span class="text-tiny+ text-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="border-t border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                        <div class="flex justify-end space-x-2">
                            <button type="submit"
                                    class="btn bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

@endsection

@push('scripts')
    <script>
        function previewImage(input, previewId) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endpush
