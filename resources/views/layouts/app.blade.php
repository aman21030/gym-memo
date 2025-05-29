<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gym Memo') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

    <!-- 🔽 共通ヘッダー -->
    <header class="bg-white shadow">
        <div class="bg-white shadow py-4">
            <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
                {{-- ロゴ部分 --}}
                <a href="{{ route('workouts.index') }}" class="text-xl font-bold text-gray-800 hover:text-blue-600">
                    <img src="{{ asset('images/header_logo.png') }}" alt="SunFit Logo" class="h-10 inline">
                </a>

                {{-- メニュー部分 --}}
                <div class="flex gap-2">
                    <a href="{{ route('profile.edit') }}"
                    class="bg-blue-200 text-gray-800 hover:bg-blue-300 px-2 py-2 rounded text-sm font-medium">
                        プロフィール
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 text-white hover:bg-red-600 px-2 py-2 rounded text-sm font-medium">
                            ログアウト
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </header>

    <!-- 🔽 ページ内容 -->
    <main class="py-6 p-5">
        @yield('content')
    </main>

</body>
</html>
