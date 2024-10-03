@extends('dashboard.layouts.master')
@section('main')


<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center space-x-4 py-5 lg:py-6">
      <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
      Payment Transaction
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
        <li> Payment Transaction</li>
      </ul>
    </div>



    <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6 ">
      <div class="col-span-12 sm:col-span-8">
        <div class="card p-4 sm:p-5">
          <p class="text-base font-medium text-slate-700 dark:text-navy-100">
            PaymentTransaction
          </p>
          <div class="mt-4 space-y-4">

            <div class="mt-5">
                <label class="block">
                    <span>Package :</span>
                    <span>{{ $PaymentTransaction->package->title_en }}</span>


                </label>
            </div>



              <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <label class="block">
                    <span>total :</span>
                    <span >
                        <span>{{ $PaymentTransaction->total }}</span>
                    </span>

                </label>


            </div>


            <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                <label class="block sm:col-span-8">
                    <span>Invoice</span>

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
                  <span>status :</span>
                  <span>
                    @if( $PaymentTransaction->status == '0')
                    {{ 'Unactive' }}
                    @else
                    {{ 'active' }}
                    @endif

                    </span>
                </label>
              </div>



          </div>
        </div>
      </div>




    </div>
   </main>

 @endsection
