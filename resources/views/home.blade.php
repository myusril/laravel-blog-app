<x-main-layout :title="$title">

    <section class="bg-white">
        <div class="py-24 mx-auto max-w-screen-xl">
            <form id="filterForm" action="/" method="GET" class="w-full">
                <input type="hidden" name="sort" id="sortInput" value="{{ request('sort', 'latest') }}">

                <div class="relative mb-8 bg-white shadow-md sm:rounded-lg">
                    <div
                        class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">

                        <!-- 🔍 Search -->
                        <div class="w-full md:w-1/2">
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}" id="simple-search"
                                    class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Search...">
                            </div>
                        </div>

                        <!-- ⚙ Sort & Filter -->
                        <div
                            class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                            <div class="flex items-center w-full space-x-3 md:w-auto">

                                <!-- Sort Dropdown -->
                                <div class="relative">
                                    <button type="button" id="sortDropdownBtn"
                                        class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                                        <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                        </svg>
                                        Sort by
                                    </button>
                                    <div id="sortDropdown"
                                        class="absolute hidden z-10 bg-white divide-y divide-gray-100 rounded shadow w-44">
                                        <ul class="py-1 text-sm text-gray-700">
                                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100"
                                                    data-sort="latest">Latest</a></li>
                                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100"
                                                    data-sort="oldest">Oldest</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Filter Dropdown -->
                                <div class="relative">
                                    <button type="button" id="filterDropdownBtn"
                                        class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                            class="w-4 h-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Filter
                                        <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                        </svg>
                                    </button>
                                    <div id="filterDropdown"
                                        class="absolute hidden z-10 w-48 p-3 bg-white rounded-lg shadow">
                                        <h6 class="mb-3 text-sm font-medium text-gray-900">Category</h6>
                                        <ul class="space-y-2 text-sm">
                                            @foreach ($categories as $category)
                                                <li class="flex items-center">
                                                    <input type="checkbox" name="categories[]"
                                                        value="{{ $category->id }}"
                                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 category-checkbox"
                                                        {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}>
                                                    <label class="ml-2">{{ $category->name }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <!-- Reset Button -->
                                <a href="{{ url('/') }}"
                                    class="px-4 py-2 text-sm text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">
                                    Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="grid gap-8 lg:grid-cols-2">
                @foreach ($posts as $post)
                    <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md">
                        <div class="flex justify-between items-center mb-5 text-gray-500">
                            <span
                                class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded">
                                <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                                    </path>
                                </svg>
                                {{ $post->categories->name }}
                            </span>
                            <span class="text-sm">{{ $post->updated_at->diffForHumans() }}</span>
                        </div>
                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 hover:underline"><a
                                href="/post/{{ $post->slug }}">{{ $post->title }}</a></h2>
                        <p class="mb-5 font-light text-gray-500">{{ Str::limit($post->body, 100, '...') }}</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                <img class="w-7 h-7 rounded-full"
                                    src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png"
                                    alt="Jese Leos avatar" />
                                <span class="font-medium">
                                    {{ $post->authors->name }}
                                </span>
                            </div>
                            <a href="/post/{{ $post->slug }}"
                                class="inline-flex items-center font-medium text-blue-600 hover:underline">
                                Read more
                                <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

</x-main-layout>
