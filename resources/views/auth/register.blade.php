<x-guest-layout>
    <!-- ロゴ画像 -->
    <div class="flex justify-center mb-6">
        <a href="{{ url('/workouts') }}">
            <img src="{{ asset('images/logo.png') }}" alt="アプリロゴ" class="h-16">
        </a>
    </div>

    <h1 class="text-2xl font-bold mb-6 text-center">新規登録</h1>

    <!-- バリデーションエラー表示 -->
    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- 名前 -->
        <div>
            <label class="block font-medium">名前</label>
            <input type="text" name="name" required autofocus class="w-full border rounded px-3 py-2">
        </div>

        <!-- メール -->
        <div>
            <label class="block font-medium">メールアドレス</label>
            <input type="email" name="email" required class="w-full border rounded px-3 py-2">
        </div>

        <!-- パスワード -->
        <div>
            <label class="block font-medium">パスワード</label>
            <input type="password" name="password" required class="w-full border rounded px-3 py-2">
        </div>

        <!-- パスワード確認 -->
        <div>
            <label class="block font-medium">パスワード（確認）</label>
            <input type="password" name="password_confirmation" required class="w-full border rounded px-3 py-2">
        </div>

        <!-- 登録ボタン -->
        <div class="text-center">
            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 w-full">登録する</button>
        </div>
    </form>

    <div class="mt-4 text-center text-sm text-gray-600">
        すでにアカウントをお持ちの方は
        <a href="{{ route('login') }}" class="text-blue-500 hover:underline">ログイン</a>
    </div>
</x-guest-layout>
