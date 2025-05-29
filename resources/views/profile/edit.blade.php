@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 space-y-10">

    {{-- プロフィール編集 --}}
    <div>
        <h2 class="text-xl font-semibold mb-4">プロフィール情報</h2>

        @if (session('status') === 'profile-updated')
            <div class="mb-4 text-green-600">プロフィールを更新しました。</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label for="name" class="block text-sm font-medium">名前</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                    class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium">メールアドレス</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                    class="w-full border rounded px-3 py-2 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">プロフィール更新</button>
            </div>
        </form>
    </div>

    {{-- パスワード変更 --}}
    <div>
        <h2 class="text-xl font-semibold mb-4">パスワード変更</h2>

        @if (session('status') === 'password-updated')
            <div class="mb-4 text-green-600">パスワードを変更しました。</div>
        @endif

        <form method="POST" action="{{ route('user-password.update') }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="current_password" class="block text-sm font-medium">現在のパスワード</label>
                <input type="password" name="current_password" id="current_password" required
                    class="w-full border rounded px-3 py-2 @error('current_password') border-red-500 @enderror">
                @error('current_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium">新しいパスワード</label>
                <input type="password" name="password" id="password" required
                    class="w-full border rounded px-3 py-2 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium">新しいパスワード（確認）</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="text-right">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">パスワード変更</button>
            </div>
        </form>
    </div>

    {{-- アカウント削除 --}}
    <div>
        <h2 class="text-xl font-semibold mb-4 text-red-600">アカウント削除</h2>

        <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('本当に削除しますか？この操作は取り消せません。')" class="space-y-4">
            @csrf
            @method('DELETE')

            <div>
                <label for="password" class="block text-sm font-medium text-red-500">パスワード確認</label>
                <input type="password" name="password" required
                    class="w-full border border-red-400 rounded px-3 py-2 @error('password') border-red-500 @enderror">
                @error('password', 'userDeletion')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-right">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">アカウントを削除</button>
            </div>
        </form>
    </div>

    <div class="mt-6">
        <a href="{{ route('workouts.index') }}" class="text-blue-500 hover:underline">← トップへ戻る</a>
    </div>
</div>
@endsection
