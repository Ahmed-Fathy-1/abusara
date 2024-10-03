@extends('dashboard.layouts.master')
@section('main')

<style>
    #img-prv {
    transition: transform 0.2s; /* إضافة تأثير انتقال */
}

#img-prv:hover {
    transform: scale(1.05); /* تكبير الصورة عند المرور عليها */
}

    </style>
<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center space-x-4 py-5 lg:py-6">
        <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
           packages
        </h2>
        <div class="hidden h-full py-1 sm:flex">
            <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
        </div>
        <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
            <li class="flex items-center space-x-2">
                <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="#">Forms</a>
                <svg x-ignore="" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </li>
            <li>packages</li>
        </ul>
    </div>

    <form action="{{ route('packages.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6 ">
            <div class="col-span-12 sm:col-span-8">
                <div class="card p-4 sm:p-5">
                    <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                        Payment Method
                    </p>
                    <div class="mt-4 space-y-4">

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <label class="block">
                                <span>title Arabic</span>
                                <span class="relative mt-1.5 flex">
                                    <input name="title_ar" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Your Name" type="text">
                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                        <i class="far fa-user text-base"></i>
                                    </span>
                                </span>
                                @error('title_ar')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="block">
                                <span>title English</span>
                                <span class="relative mt-1.5 flex">
                                    <input name="title_en" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Your Name" type="text">
                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                        <i class="far fa-user text-base"></i>
                                    </span>
                                </span>
                                @error('title_en')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <label class="block">
                                <span>subtitle Arabic</span>
                                <span class="relative mt-1.5 flex">
                                    <input name="subtitle_ar" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Your Name" type="text">
                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                        <i class="far fa-user text-base"></i>
                                    </span>
                                </span>
                                @error('subtitle_ar')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="block">
                                <span>subtitle English</span>
                                <span class="relative mt-1.5 flex">
                                    <input name="subtitle_en" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Your Name" type="text">
                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                        <i class="far fa-user text-base"></i>
                                    </span>
                                </span>
                                @error('subtitle_en')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>


                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <label class="block">
                                <span>description Arabic</span>
                                <span class="relative mt-1.5 flex">
                                    <input name="description_ar" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Your Name" type="text">
                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                        <i class="far fa-user text-base"></i>
                                    </span>
                                </span>
                                @error('description_ar')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="block">
                                <span>description English</span>
                                <span class="relative mt-1.5 flex">
                                    <input name="description_en" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Your Name" type="text">
                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                        <i class="far fa-user text-base"></i>
                                    </span>
                                </span>
                                @error('description_en')
                                <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>









                        <div class="mt-5">
                            <label class="block">
                              <span>status</span>
                              <select name="status" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                <option disabled selected>Choose status...</option>
                                <option value="1">Active</option>
                                <option value="0">Unactive</option>
                              </select>
                              @error('status')
                              <span style="color: red;">{{ $message }}</span>
                              @enderror
                            </label>
                          </div>


                          @foreach($items as $item)
                          <label class="inline-flex items-center space-x-2">
                            <input multiple
                                name="item_id[]" value="{{ $item->id }}"
                              class="form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:bg-slate-500 checked:border-slate-500 hover:border-slate-500 focus:border-slate-500 dark:border-navy-400 dark:checked:bg-navy-400"
                              type="checkbox"
                            />
                            <p>{{ $item->key_en }}</p>
                          </label>
                          @endforeach





                        <div class="flex justify-end space-x-2">
                            <button type="submit" class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                <span>Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>

@endsection
