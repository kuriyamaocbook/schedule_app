<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create_Family') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Create Family!") }}
                </div>
            </div>
        </div>
         <form action="/family_ceate/family_register" method="POST">
            @csrf
            <div>
                <h2>name</h2>
                <input type="text" name="family[name]" value="{{ old('family.name') }}">
                <p class="name__error" style="color:red">{{ $errors->first('family.name') }}</p>
            </div>
             <div>
                <h2>password</h2>
                <input type="text" name="family[password]" placeholder="password" value="{{ old('family.password') }}"/>
                <p class="time__error" style="color:red">{{ $errors->first('family.password') }}</p>
            </div>
            <input type="submit" value="保存"/>
        </form>
    </div>
</x-app-layout>