@php
    $category = $category ?? null;
    $page = $category ? 'Edit' : 'Create';
    $action = $category ? route('category.update', $category->id) : route('category.store');
@endphp

<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p class="text-lg"> {{ $page }} Category </p>
                </div>

                <div class="p-6">
                    <form action="{{ $action }}" method="POST">
                        @csrf

                        @if ($category)
                            <input type="hidden" name="_method" value="PUT">
                        @endif

                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <div class="row">
                            <div class="col-md-12 input-form mt-1">
                                <label for=""> Name </label>
                                <input type="text" class="form-control rounded-md" name="name" value="{{ $category->name ?? old('name')}}">
                            </div>

                            <div class="col-md-12 input-form mt-1">
                                <label for=""> Description </label>
                                <textarea class="form-control" name="decsription" cols="30" rows="10">{{ $category->description ?? old('description') }}</textarea>
                            </div>

                            <div class="col-md-6 offset-6 mt-3">
                                <button type="submit" class="btn btn-success float-right ml-1" > Save </button>
                                <a href="{{ route('category.index') }}" class="btn btn-danger float-right"> Cancel </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
