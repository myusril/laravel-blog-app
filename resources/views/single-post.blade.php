<x-main-layout :title="$title">
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
            <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue">
                <header class="mb-4 lg:mb-6 not-format">
                    <address class="flex items-center mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900">
                            <img class="mr-4 w-16 h-16 rounded-full"
                                src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="Jese Leos">
                            <div>
                                <a href="#" rel="author"
                                    class="text-xl font-bold text-gray-900">{{ $post->authors->name }}</a>
                                <p class="text-base text-gray-500">in {{ $post->categories->name }}</p>
                                <p class="text-base text-gray-500"><time pubdate datetime="2022-02-08"
                                        title="February 8th, 2022">{{ $post->updated_at->diffForHumans() }}</time></p>
                            </div>
                        </div>
                    </address>
                    <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl">
                        {{ $post->title }}</h1>
                </header>
                <p class="lead">{{ $post->body }}</p>
                <section class="not-format">
                    <div class="flex justify-between items-center my-6">
                        <h2 class="text-lg lg:text-2xl font-bold text-gray-900">Discussion</h2>
                    </div>
                    <form action="/post/{{ $post->slug }}/comment" method="POST" class="mb-6">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200">
                            <label for="comment" class="sr-only">Your comment</label>
                            <textarea id="comment" name="body" rows="6" class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0"
                                placeholder="Write a comment..." required></textarea>
                        </div>
                        <button type="submit"
                            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 hover:bg-blue-800">
                            Post comment
                        </button>
                    </form>
                    @foreach ($post->comments as $comment)
                        <article class="p-6 mb-6 text-base bg-white rounded-lg">
                            <footer class="flex justify-between items-center mb-2">
                                <div class="flex items-center">
                                    <p class="inline-flex items-center mr-3 font-semibold text-sm text-gray-900">
                                        <img class="mr-2 w-6 h-6 rounded-full"
                                            src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                            alt="{{ $comment->user->name }}">
                                        {{ $comment->user->name }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <time
                                            datetime="{{ $comment->created_at }}">{{ $comment->created_at->diffForHumans() }}</time>
                                    </p>
                                </div>
                            </footer>
                            <p>{{ $comment->body }}</p>
                            <div class="flex items-center mt-4 space-x-4">
                                @if ($comment->replies->count() === 0)
                                    <button type="button" onclick="toggleReplyForm({{ $comment->id }})"
                                        class="flex items-center font-medium text-sm text-gray-500 hover:underline">
                                        Reply
                                    </button>
                                @endif
                            </div>
                            <form action="/comment/{{ $comment->id }}/reply" method="POST" class="mt-4 hidden"
                                id="reply-form-{{ $comment->id }}">
                                @csrf
                                <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200">
                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                    <textarea name="body" rows="3" class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0"
                                        placeholder="Write a reply..." required></textarea>
                                </div>
                                <button type="submit"
                                    class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 hover:bg-blue-800">Reply</button>
                            </form>
                            @foreach ($comment->replies as $reply)
                                <article class="p-6 mb-6 ml-6 lg:ml-12 text-base bg-gray-50 rounded-lg">
                                    <footer class="flex justify-between items-center mb-2">
                                        <div class="flex items-center">
                                            <p
                                                class="inline-flex items-center mr-3 font-semibold text-sm text-gray-900">
                                                <img class="mr-2 w-6 h-6 rounded-full"
                                                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                                    alt="{{ $reply->user->name }}">
                                                {{ $reply->user->name }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                <time
                                                    datetime="{{ $reply->created_at }}">{{ $reply->created_at->diffForHumans() }}</time>
                                            </p>
                                        </div>
                                    </footer>
                                    <p>{{ $reply->body }}</p>
                                </article>
                            @endforeach
                        </article>
                    @endforeach
                </section>
            </article>
        </div>
    </main>
</x-main-layout>
