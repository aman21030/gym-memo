<x-guest-layout>
    <!-- ロゴ画像 -->
    <div class="flex justify-center mb-6">
        <a href="{{ url('/workouts') }}">
            <img src="{{ asset('images/logo.png') }}" alt="アプリロゴ" class="h-16">
        </a>
    </div>

    <h1 class="text-2xl font-bold mb-6 text-center">ログイン</h1>

    <!-- バリデーションエラー表示 -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- メールアドレス -->
        <div>
            <label class="block font-medium">メールアドレス</label>
            <input type="email" name="email" required autofocus class="w-full border rounded px-3 py-2">
        </div>

        <!-- パスワード -->
        <div>
            <label class="block font-medium">パスワード</label>
            <input type="password" name="password" required class="w-full border rounded px-3 py-2">
        </div>

        <!-- ログインボタン -->
        <div class="text-center">
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">ログイン</button>
        </div>
    </form>

    <div class="mt-4 text-center text-sm text-gray-600">
        アカウントをお持ちでない方は
        <a href="{{ route('register') }}" class="text-blue-500 hover:underline">新規登録</a>
        してください
    </div>
</x-guest-layout>
