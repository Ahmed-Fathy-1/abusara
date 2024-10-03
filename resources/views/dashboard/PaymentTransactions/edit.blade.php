@extends('dashboard.layouts.master')
@section('main')


<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center space-x-4 py-5 lg:py-6">
      <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
      Payment Methods
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
        <li> Payment Methods</li>
      </ul>
    </div>

<form action="{{ route('PaymentTransaction.update' , $PaymentTransaction->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6 ">
      <div class="col-span-12 sm:col-span-8">
        <div class="card p-4 sm:p-5">
          <p class="text-base font-medium text-slate-700 dark:text-navy-100">
            PaymentTransaction
          </p>
          <div class="mt-4 space-y-4">

            <div class="mt-5">
                <label class="block">
                    <span>Package</span>
                    <select name="package_id"
                            class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2
                                   hover:border-slate-400 focus:border-primary
                                   dark:border-navy-450 dark:bg-navy-700
                                   dark:hover:border-navy-400 dark:focus:border-accent">
                        <option disabled selected>Choose Package...</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}"
                                    @if($PaymentTransaction->package_id == $package->id) selected @endif>
                                {{ $package->title_en }}
                            </option>
                        @endforeach
                    </select>
                    @error('package_id')
                        <span class="text-red-600 mt-1">{{ $message }}</span>
                    @enderror
                </label>
            </div>


              <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <label class="block">
                    <span>total</span>
                    <span class="relative mt-1.5 flex">
                        <input name="total" value="{{ $PaymentTransaction->total }}" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="total" type="text">

                    </span>
                    @error('total')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                </label>


            </div>


            <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                <label class="block sm:col-span-8">
                    <span>Invoice</span>
                    <div class="relative mt-1.5 flex">
                        <input name="image" onchange="showPreview(event)" id="image" class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" type="file">
                    </div>
                    @error('image')
                    <span style="color: red;">{{ $message }}</span>
                    @enderror
                    <img src="{{ asset('storage/uploads/images/' .  $PaymentTransaction->image) }}" id="img-prv" alt="" width="250px"
                    height="500px" srcset="">                    <script>
                        function showPreview(event) {
                            if (event.target.files.length > 0) {
                                let src = URL.createObjectURL(event.target.files[0]);
                                let prv = document.getElementById('img-prv');
                                prv.src = src;
                            }
                        }
                    </script>
                </label>
            </div>

            <div class="mt-5">
                <label class="block">
                  <span>status</span>
                  <select name="status" class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                    <option disabled selected>Choose status...</option>
                    <option @selected($PaymentTransaction->status == '1') value="1">Active</option>
                    <option  @selected($PaymentTransaction->status == '0') value="0">Unactive</option>
                  </select>
                  @error('status')
                  <span style="color: red;">{{ $message }}</span>
                  @enderror
                </label>
              </div>


            <div class="flex justify-end space-x-2">

              <button type="submit" class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                <span>update</span>

              </button>
            </div>
          </div>
        </div>
      </div>




    </div>
</form>
  </main>

 @endsection
