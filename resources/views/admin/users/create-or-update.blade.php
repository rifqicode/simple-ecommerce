@php
    $user = $user ?? null;
    $page = $user ? 'Edit' : 'Create';
    $action = $user ? route('users.update', $user->id) : route('users.store');
@endphp

<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p class="text-lg"> {{ $page }} Users </p>
                </div>

                <div class="p-6">
                    <form action="{{ $action }}" method="POST">
                        @csrf

                        @if ($user)
                            <input type="hidden" name="_method" value="PUT">
                        @endif

                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <div class="row">
                            <div class="col-md-6 input-form mt-1">
                                <label for=""> Name </label>
                                <input type="text" class="form-control rounded-md" name="name" value="{{ $user->name ?? old('name')}}">
                            </div>

                            <div class="col-md-6 input-form mt-1">
                                <label for=""> Email </label>
                                <input type="email" class="form-control rounded-md" name="email" value="{{ $user->email ?? old('email')}}">
                            </div>

                            @php
                                $listRole = [
                                    '1' => 'Administrator',
                                    '2' => 'Users'
                                ];
                            @endphp

                            <div class="col-md-6 input-form mt-1">
                                <label for=""> Role </label>

                                <div class="">
                                    <select name="role" class="form-control rounded-md border-3 border-black">
                                        <option value="" disabled selected> </option>
                                        @foreach ($listRole as $key => $role)
                                            <option value="{{ $key }}" {{ $key == ($user->role ?? old('role')) ? 'selected' : ''}}> {{ $role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <br>
                                <hr>
                                <br>
                            </div>

                            <div class="col-md-12 input-form mt-1">
                                <label for=""> Password </label>
                                <input type="password" class="form-control rounded-md" name="password">
                            </div>

                            <div class="col-md-12 input-form mt-1">
                                <label for=""> Retype Password </label>
                                <input type="password" class="form-control rounded-md" name="password_confirmation">
                            </div>

                            <div class="col-md-6 offset-6 mt-3">
                                <button type="submit" class="btn btn-success float-right ml-1" > Save </button>
                                <a href="{{ route('users.index') }}" class="btn btn-danger float-right"> Cancel </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
