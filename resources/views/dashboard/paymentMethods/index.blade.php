@extends('dashboard.layouts.master')
@section('main')
<style>
    .btn-custom-red {
        background-color: red; /* لون الخلفية */
        color: white; /* لون النص */
    }

    .btn-custom-red:hover {
        background-color: darkred; /* لون الخلفية عند التحويم */
    }

    .btn-custom-red:focus {
        background-color: darkred; /* لون الخلفية عند التركيز */
    }

    .btn-custom-red:active {
        background-color: crimson; /* لون الخلفية عند النقر */
    }
</style>
<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center space-x-4 py-5 lg:py-6">
      <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
        paymentMethods
      </h2>
      <div class="hidden h-full py-1 sm:flex">
        <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
      </div>
      <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
        <li class="flex items-center space-x-2">
          <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="#">Components</a>
          <svg x-ignore="" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </li>
        <li>paymentMethods</li>
      </ul>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
        <div class="flex justify-end space-x-2">

            <a href="{{ route('PaymentMethod.create') }}" class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
              <span>Create</span>

            </a>
          </div>
      <!-- From HTML Table -->
      <div class="card pb-4">
        <div class="my-3 flex h-8 items-center justify-between px-4 sm:px-5">
          <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
            paymentMethods
          </h2>

        </div>
        <div>

          <div x-data="" x-init="$el._x_grid =  new Gridjs.Grid({
            from: $refs.table,
            sort: true,
            search: true,
          }).render($refs.wrapper);">
            <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
              <table x-ref="table" class="w-full text-left" style="display: none;">
                <thead>
                  <tr>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                      #
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                      Name
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                      image
                    </th>
                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                       action
                    </th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
            <div>

                <div x-ref="wrapper">
                     <div role="complementary" class="gridjs gridjs-container" style="width: 100%;"><div class="gridjs-head">
                        <div class="gridjs-search">
                            <input type="search" placeholder="Type a keyword..." aria-label="Type a keyword..." class="gridjs-input gridjs-search-input"></div>
                        </div>
                        <div class="gridjs-wrapper" style="height: auto;">
                            <table role="grid" class="gridjs-table" style="height: auto;">
                                <thead class="gridjs-thead"><tr class="gridjs-tr"><th data-column-id="#" class="gridjs-th gridjs-th-sort" tabindex="0">
                                    <div class="gridjs-th-content"> #</div>
                                    <button tabindex="-1" aria-label="Sort column ascending" title="Sort column ascending" class="gridjs-sort gridjs-sort-neutral"></button>
                                </th><th data-column-id="
Name
" class="gridjs-th gridjs-th-sort" tabindex="0"><div class="gridjs-th-content">
                      Name
                    </div><button tabindex="-1" aria-label="Sort column ascending" title="Sort column ascending" class="gridjs-sort gridjs-sort-neutral"></button></th><th data-column-id="
Job
" class="gridjs-th gridjs-th-sort" tabindex="0"><div class="gridjs-th-content">
                      Job
                    </div><button tabindex="-1" aria-label="Sort column ascending" title="Sort column ascending" class="gridjs-sort gridjs-sort-neutral"></button></th><th data-column-id="
FavoriteColor
" class="gridjs-th gridjs-th-sort" tabindex="0"><div class="gridjs-th-content">
                      Favorite Color
                    </div><button tabindex="-1" aria-label="Sort column ascending" title="Sort column ascending" class="gridjs-sort gridjs-sort-neutral"></button></th></tr></thead>
                    <tbody class="gridjs-tbody">
                        @foreach($data as $method)
                        <tr class="gridjs-tr">
                            <td data-column-id="#" class="gridjs-td">{{ $loop->index +1 }}
                        </td><td data-column-id="Name" class="gridjs-td">{{ $method->name_en }}
                        </td><td data-column-id="Job" class="gridjs-td"><img src="{{ $method->image }}" width="75" height="75" alt="">
                        </td><<td data-column-id="FavoriteColor" class="gridjs-td">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('PaymentMethod.edit', $method->id) }}" class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                    <span>Edit</span>
                                </a>

                                <form action="{{ route('PaymentMethod.destroy', $method->id) }}" method="post" class="inline-block" onsubmit="return confirmDelete();">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-custom-red space-x-2">
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>

                        <script>
                            function confirmDelete() {
                                return confirm("Are you sure you want to delete this payment method?");
                            }
                        </script>

                    </tr>
                        @endforeach

                </tbody></table></div><div id="gridjs-temp" class="gridjs-temp"></div></div></div>
            </div>
          </div>
        </div>
      </div>


      </div>
    </div>
  </main>

 @endsection
