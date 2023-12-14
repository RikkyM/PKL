@extends('components.app')
@section('title')
    Login
@endsection
@section('pages')
    <div class="flex h-screen w-screen items-center justify-center">
        <div class="flex w-[80%] flex-col items-center justify-center gap-5 sm:w-[70%]">
            <form action="{{ route('login') }}" method="post"
                class="flex w-80 flex-col items-center space-y-3 rounded-xl border-2 bg-white p-10 shadow-[0_3px_5px_0_rgba(0,0,0,.2)] sm:w-96">
                @csrf
                <div class="flex w-full select-none">
                    <h2 class="mb-6 rounded-xl text-lg font-semibold lg:text-2xl">Login
                    </h2>
                </div>
                <div class="w-full space-y-5">
                    <div
                        class="@error('username') border-red-500 @else border-black @enderror flex items-center justify-center gap-3 border-b px-1 text-sm lg:text-sm">
                        <i class='bx bx-user bx-sm @error('username') text-red-500 @enderror'></i>
                        <input type="text" value="{{ old('username') }}" name="username" id="username"
                            class="@error('username') placeholder:text-red-500 text-red-500 @else placeholder:text-black @enderror w-full bg-transparent px-2 py-3 focus:outline-0"
                            placeholder="Username" autocomplete="off">
                    </div>
                    @error('username')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                    <div
                        class="@error('password') border-red-500 @else border-black @enderror flex items-center justify-center gap-3 border-b px-1 text-sm lg:text-sm">
                        <i class='bx bx-key bx-sm @error('password') text-red-500 @enderror'></i>
                        <input type="password" name="password" id="password"
                            class="@error('password') border-red-500 placeholder:text-red-500 text-red-500 @else placeholder:text-black @enderror w-full bg-transparent px-2 py-3 focus:outline-0"
                            placeholder="Password">
                    </div>

                    @error('password')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror

                    <div class="pt-5">
                        <button
                            class="w-full rounded-md bg-green-400 py-2 text-white transition-all duration-[.5s] hover:-translate-y-1 hover:bg-green-500 hover:shadow-[0_5px_3px_0_rgba(0,0,0,.2)] focus:-translate-y-1 focus:shadow-[0_5px_3px_0_rgba(0,0,0,.2)] focus:outline-0">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
