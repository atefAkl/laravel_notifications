<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            لوحة التحكم
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        إجمالي المقالات
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        {{ App\Models\Post::count() }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        المقالات المنشورة
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        {{ App\Models\Post::published()->count() }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        المسودات
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        {{ App\Models\Post::draft()->count() }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        إجمالي التعليقات
                                    </dt>
                                    <dd class="text-lg font-medium text-gray-900">
                                        {{ App\Models\Comment::count() }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            @if(auth()->user()->canCreatePost())
            <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-8">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                        إجراءات سريعة
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('posts.create') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="ml-2 -mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            مقال جديد
                        </a>

                        <a href="{{ route('posts.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="ml-2 -mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            عرض المقالات
                        </a>

                        @if(auth()->user()->isAdmin())
                        <a href="#"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="ml-2 -mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            إدارة المستخدمين
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Recent Posts -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            آخر المقالات
                        </h3>
                        <a href="{{ route('posts.index') }}" class="text-sm text-blue-600 hover:text-blue-500">
                            عرض الكل
                        </a>
                    </div>

                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        العنوان
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        الحالة
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        التاريخ
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        الإجراءات
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                $recentPosts = App\Models\Post::with('user')->latest()->take(5)->get();
                                @endphp
                                @forelse($recentPosts as $post)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ Str::limit($post->title, 50) }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $post->user->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($post->isPublished())
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            منشور
                                        </span>
                                        @elseif($post->isDraft())
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            مسودة
                                        </span>
                                        @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            مؤرشف
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $post->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                        <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:text-blue-900 ml-3">
                                            عرض
                                        </a>
                                        @if(auth()->user()->canEditPost($post))
                                        <a href="{{ route('posts.edit', $post) }}" class="text-indigo-600 hover:text-indigo-900 ml-3">
                                            تعديل
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        لا توجد مقالات بعد
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Recent Comments -->
            @if(auth()->user()->isAdmin() || auth()->user()->isWriter())
            <div class="bg-white overflow-hidden shadow-sm rounded-lg mt-8">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            آخر التعليقات
                        </h3>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-500">
                            عرض الكل
                        </a>
                    </div>

                    <div class="space-y-4">
                        @php
                        $recentComments = App\Models\Comment::with(['user', 'post'])->latest()->take(5)->get();
                        @endphp
                        @forelse($recentComments as $comment)
                        <div class="flex items-start space-x-3 space-x-reverse p-3 bg-gray-50 rounded-lg">
                            <img class="h-8 w-8 rounded-full" src="{{ $comment->user->avatar_url }}" alt="{{ $comment->user->name }}">
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $comment->user->name }}</p>
                                        <p class="text-xs text-gray-500">
                                            على مقال: <a href="{{ route('posts.show', $comment->post) }}"
                                                class="text-blue-600 hover:underline">{{ Str::limit($comment->post->title, 30) }}</a>
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-2 space-x-reverse">
                                        @if(!$comment->is_approved)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            في انتظار الموافقة
                                        </span>
                                        @endif
                                        <span class="text-xs text-gray-500">{{ $comment->created_at->format('d M Y H:i') }}</span>
                                    </div>
                                </div>
                                <p class="mt-1 text-sm text-gray-700">{{ Str::limit($comment->content, 100) }}</p>

                                @if(auth()->user()->isAdmin() || auth()->user()->isWriter())
                                <div class="mt-2 flex space-x-2 space-x-reverse">
                                    @if(!$comment->is_approved)
                                    <form action="{{ route('comments.approve', $comment) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-xs text-green-600 hover:text-green-800">موافقة</button>
                                    </form>
                                    @endif
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline"
                                        onsubmit="return confirm('هل أنت متأكد من حذف هذا التعليق؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-red-600 hover:text-red-800">حذف</button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="text-center text-gray-500 py-8">
                            لا توجد تعليقات جديدة
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>