<div class="sidebar sidebar-panel print:hidden">
    <div class="flex h-full grow flex-col border-r border-slate-150 bg-white dark:border-navy-700 dark:bg-navy-750">
        <div class="flex items-center justify-between px-3 pt-4">
            <!-- Application Logo -->
            {{-- @php
                $setting = \App\Models\Setting::findOrFail(1);
            @endphp --}}

            <div class="flex justify-center w-full">
                <a href="https://aitech.net.au/v2/" class="block">
                    {{-- <img width="50" height="20" src="{{ asset('storage/uploads/images/settings/'.$setting->image) }}" alt="logo"> --}}
                </a>
            </div>

            <button
                class="sidebar-close btn h-7 w-7 rounded-full p-0 text-primary hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:text-accent-light/80 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 xl:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
        </div>

        <div class="nav-wrapper mt-5 h-[calc(100%-4.5rem)] overflow-x-hidden pb-6" data-simplebar="init">
            <div class="simplebar-wrapper" style="margin: 0px 0px -24px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                            aria-label="scrollable content" style="height: auto; overflow: hidden scroll;">
                            <div class="simplebar-content" style="padding: 0px 0px 24px;">



                                <ul class="flex flex-1 flex-col px-4 font-inter">
                                    <li class="ac nav-parent [&amp;.is-active_svg]:rotate-90 [&amp;.is-active_.ac-trigger]:font-semibold [&amp;.is-active_.ac-trigger]:text-slate-800 dark:[&amp;.is-active_.ac-trigger]:text-navy-50 js-enabled"
                                        data-nav-parent-index="0" id="ac-0">
                                        <button
                                            class="ac-trigger flex w-full items-center justify-between py-2 text-xs+ tracking-wide text-slate-600 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                            id="ac-trigger-0" role="button" aria-controls="ac-panel-0"
                                            aria-disabled="false" aria-expanded="false">
                                            <span>Home</span>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 text-slate-400 transition-transform ease-in-out"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </button>
                                        <ul class="ac-panel" id="ac-panel-0" role="region"
                                            aria-labelledby="ac-trigger-0"
                                            style="transition-duration: 200ms; height: 0px;">

                                            <li>
                                                <a href="#"
                                                    class="nav-link flex items-center justify-between p-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 text-slate-600 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                                    data-default-class="text-slate-600 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                                    data-active-class="font-medium text-primary dark:text-accent-light">
                                                    <div class="flex items-center space-x-2">
                                                        <div
                                                            class="h-1.5 w-1.5 rounded-full border border-current opacity-40">
                                                        </div>
                                                        <span>Domains</span>
                                                    </div>
                                                </a>
                                            </li>

                                        </ul>
                                    </li>
                                </ul>
                                <div class="my-3 mx-4 h-px bg-slate-200 dark:bg-navy-500"></div>


                                {{-- @can('about_us-edit')
                                <ul class="flex flex-1 flex-col px-4 font-inter">
                                    <li>
                                        <a href="{{ route('about_us.edit', 1) }}" class="">
                                            <span>About Us</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="my-3 mx-4 h-px bg-slate-100 dark:bg-navy-500"></div>
                                @endcan --}}



                                <ul class="flex flex-1 flex-col px-4 font-inter">
                                    <li>
                                        <a href="#" class="">
                                            <span>Tenants</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="my-3 mx-4 h-px bg-slate-100 dark:bg-navy-500"></div>



                                {{-- <ul class="flex flex-1 flex-col px-4 font-inter">
                                    <li class="ac nav-parent [&amp;.is-active_svg]:rotate-90 [&amp;.is-active_.ac-trigger]:font-semibold [&amp;.is-active_.ac-trigger]:text-slate-800 dark:[&amp;.is-active_.ac-trigger]:text-navy-50 js-enabled"
                                        data-nav-parent-index="8" id="ac-8">
                                        <button
                                            class="ac-trigger flex w-full items-center justify-between py-2 text-xs+ tracking-wide text-slate-600 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                            id="ac-trigger-8" role="button" aria-controls="ac-panel-8"
                                            aria-disabled="false" aria-expanded="false">
                                            <span>Services</span>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 text-slate-400 transition-transform ease-in-out"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </button>
                                        <ul class="ac-panel" id="ac-panel-8" role="region"
                                            aria-labelledby="ac-trigger-8"
                                            style="transition-duration: 200ms; height: 0px;">

                                @can('Categories-list')
                                            <li>
                                                <a href="{{ route('categories.index') }}"
                                                    class="nav-link flex items-center justify-between p-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 text-slate-600 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                                    data-default-class="text-slate-600 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                                    data-active-class="font-medium text-primary dark:text-accent-light">
                                                    <div class="flex items-center space-x-2">
                                                        <div
                                                            class="h-1.5 w-1.5 rounded-full border border-current opacity-40">
                                                        </div>
                                                        <span>Category</span>
                                                    </div>
                                                </a>
                                            </li>
                                @endcan

                                @can('Services-list')
                                            <li>
                                                <a href="{{ route('services.index') }}"
                                                    class="nav-link flex items-center justify-between p-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 text-slate-600 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                                    data-default-class="text-slate-600 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                                    data-active-class="font-medium text-primary dark:text-accent-light">
                                                    <div class="flex items-center space-x-2">
                                                        <div
                                                            class="h-1.5 w-1.5 rounded-full border border-current opacity-40">
                                                        </div>
                                                        <span>Services</span>
                                                    </div>
                                                </a>
                                            </li>
                                @endcan

                                @can('Ourservices-list')
                                            <li>
                                                <a href="{{ route('ourservices.index') }}"
                                                    class="nav-link flex items-center justify-between p-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 text-slate-600 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                                    data-default-class="text-slate-600 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                                    data-active-class="font-medium text-primary dark:text-accent-light">
                                                    <div class="flex items-center space-x-2">
                                                        <div
                                                            class="h-1.5 w-1.5 rounded-full border border-current opacity-40">
                                                        </div>
                                                        <span>Our Services</span>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <div class="my-3 mx-4 h-px bg-slate-200 dark:bg-navy-500"></div>
                                @endcan --}}


                                {{-- @can('Contactus-list')
                                <ul class="flex flex-1 flex-col px-4 font-inter">
                                    <li>
                                        <a href="{{ route('contactus.index') }}" class="">
                                            <span>Contact Us</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="my-3 mx-4 h-px bg-slate-100 dark:bg-navy-500"></div>
                                @endcan --}}


                                <ul class="flex flex-1 flex-col px-4 font-inter">
                                    <li>
                                        <a href="#" class="">
                                            <span>Users</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="my-3 mx-4 h-px bg-slate-100 dark:bg-navy-500"></div>


                                <ul class="flex flex-1 flex-col px-4 font-inter">
                                    <li>
                                        <a href="#" class="">
                                            <span>Roles</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="my-3 mx-4 h-px bg-slate-100 dark:bg-navy-500"></div>


                                <ul class="flex flex-1 flex-col px-4 font-inter">
                                    <li class="ac nav-parent [&amp;.is-active_svg]:rotate-90 [&amp;.is-active_.ac-trigger]:font-semibold [&amp;.is-active_.ac-trigger]:text-slate-800 dark:[&amp;.is-active_.ac-trigger]:text-navy-50 js-enabled"
                                        data-nav-parent-index="8" id="ac-8">
                                        <button
                                            class="ac-trigger flex w-full items-center justify-between py-2 text-xs+ tracking-wide text-slate-600 outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                            id="ac-trigger-8" role="button" aria-controls="ac-panel-8"
                                            aria-disabled="false" aria-expanded="false">
                                            <span>Settings</span>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 text-slate-400 transition-transform ease-in-out"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </button>
                                        <ul class="ac-panel" id="ac-panel-8" role="region"
                                            aria-labelledby="ac-trigger-8"
                                            style="transition-duration: 200ms; height: 0px;">


                                            <li>
                                                <a href="#"
                                                    class="nav-link flex items-center justify-between p-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 text-slate-600 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                                    data-default-class="text-slate-600 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                                    data-active-class="font-medium text-primary dark:text-accent-light">
                                                    <div class="flex items-center space-x-2">
                                                        <div
                                                            class="h-1.5 w-1.5 rounded-full border border-current opacity-40">
                                                        </div>
                                                        <span>Web Site Settings</span>
                                                    </div>
                                                </a>
                                            </li>



                                            <li>
                                                {{-- <a href="{{ route('profile', auth()->user()->id) }}" --}}
                                                <a href="#"
                                                    class="nav-link flex items-center justify-between p-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4 text-slate-600 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                                    data-default-class="text-slate-600 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                                    data-active-class="font-medium text-primary dark:text-accent-light">
                                                    <div class="flex items-center space-x-2">
                                                        <div
                                                            class="h-1.5 w-1.5 rounded-full border border-current opacity-40">
                                                        </div>
                                                        <span>Profile</span>
                                                    </div>
                                                </a>
                                            </li>


                                        </ul>
                                    </li>

                                </ul>



                            </div>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder" style="width: auto; height: 414px;"></div>

            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                <div class="simplebar-scrollbar"
                    style="height: 25px; display: block; transform: translate3d(0px, 0px, 0px);"></div>
            </div>
        </div>
    </div>
</div>
