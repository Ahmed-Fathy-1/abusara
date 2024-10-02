@extends('dashboard.layouts.master')

@section('title', 'Home')

@push('style')

@endpush

@section('main')
  <main class="main-content w-full pb-8">
    <div class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
      <div class="card col-span-12 sm:col-span-12">
        <div class="my-3 flex items-center justify-between px-4 sm:px-5">
          <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
            Home
          </h2>
        </div>

        <div class="grid grid-cols-1 gap-4 px-4 sm:gap-5 sm:px-5 lg:grid-cols-2">


          <div class="rounded-lg border border-slate-150 p-4 dark:border-navy-600">
            <div class="flex justify-between">
              <div>
                <span class="text-2xl font-medium text-slate-700 dark:text-navy-100"></span>
                <span class="text-xs"></span>
              </div>
              <p class="text-xs+">Products</p>
            </div>

            <div class="progress mt-3 h-1.5 bg-slate-150 dark:bg-navy-500">
              <div class="is-active relative w-8/12 overflow-hidden rounded-full bg-success"></div>
            </div>
            <div class="mt-2 flex justify-between text-xs text-slate-400 dark:text-navy-300">
              <p>Monthly target</p>
              <p>50%</p>
            </div>
          </div>



          <div class="rounded-lg border border-slate-150 p-4 dark:border-navy-600">
            <div class="flex justify-between">
              <div>
                <span class="text-2xl font-medium text-slate-700 dark:text-navy-100"></span>
                <span class="text-xs"></span>
              </div>
              <p class="text-xs+">Services</p>
            </div>

            <div class="progress mt-3 h-1.5 bg-slate-150 dark:bg-navy-500">
              <div class="relative w-8/12 overflow-hidden rounded-full bg-warning"></div>
            </div>
            <div class="mt-2 flex justify-between text-xs text-slate-400 dark:text-navy-300">
              <p>Monthly target</p>
              <p>70%</p>
            </div>
          </div>



          <div class="rounded-lg border border-slate-150 p-4 dark:border-navy-600">
            <div class="flex justify-between">
              <div>
                <span class="text-2xl font-medium text-slate-700 dark:text-navy-100"></span>
                <span class="text-xs"></span>
              </div>
              <p class="text-xs+">Solutions</p>
            </div>

            <div class="progress mt-3 h-1.5 bg-slate-150 dark:bg-navy-500">
              <div class="relative w-5/12 overflow-hidden rounded-full bg-secondary"></div>
            </div>
            <div class="mt-2 flex justify-between text-xs text-slate-400 dark:text-navy-300">
              <p>Monthly target</p>
              <p>65%</p>
            </div>
          </div>




          <div class="rounded-lg border border-slate-150 p-4 dark:border-navy-600">
            <div class="flex justify-between">
              <div>
                <span class="text-2xl font-medium text-slate-700 dark:text-navy-100"></span>
                <span class="text-xs"></span>
              </div>
              <p class="text-xs+">Contact Us</p>
            </div>

            <div class="progress mt-3 h-1.5 bg-slate-150 dark:bg-navy-500">
              <div class="is-active relative w-4/12 overflow-hidden rounded-full bg-slate-500 dark:bg-navy-400"></div>
            </div>
            <div class="mt-2 flex justify-between text-xs text-slate-400 dark:text-navy-300">
              <p>Monthly target</p>
              <p>30%</p>
            </div>
          </div>



          <div class="rounded-lg border border-slate-150 p-4 dark:border-navy-600">
            <div class="flex justify-between">
              <div>
                <span class="text-xs"></span>
              </div>
              <p class="text-xs+">Subscribes</p>
            </div>

            <div class="progress mt-3 h-1.5 bg-slate-150 dark:bg-navy-500">
              <div class="is-active relative w-4/12 overflow-hidden rounded-full bg-slate-500 dark:bg-navy-400"></div>
            </div>
            <div class="mt-2 flex justify-between text-xs text-slate-400 dark:text-navy-300">
              <p>Monthly target</p>
              <p>35%</p>
            </div>
          </div>
        </div>


        <br>
        <br>
      </div>
    </div>
  </main>


  @endsection

@push('scripts')

@endpush
