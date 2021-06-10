@php
    $item = $item ?? null;
    $page = $item ? 'Edit' : 'Create';
    $action = $item ? route('item.update', $item->id) : route('item.store');
@endphp

<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p class="text-lg"> {{ $page }} Item </p>
                </div>

                <div class="p-6">
                    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if ($item)
                            <input type="hidden" name="_method" value="PUT">
                        @endif

                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <div class="row">
                            <div class="col-md-6 input-form mt-1">
                                <label for=""> Name </label>
                                <input type="text" class="form-control rounded-md" name="name" value="{{ $item->name ?? old('name')}}">
                            </div>

                            <div class="col-md-6 input-form mt-1">
                                <label for=""> Category </label>
                                <select name="category_id" class="form-control rounded-md border-3 border-black">
                                    <option value="" disabled selected> </option>
                                    @foreach ($category as $value)
                                        <option value="{{ $value->id }}" {{ $value->id == ($item->category_id ?? old('category_id')) ? 'selected' : ''}}> {{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12 input-form mt-1">
                                <label for=""> Description </label>
                                <textarea class="form-control" name="description" cols="30" rows="10">{{ $item->description ?? old('description') }}</textarea>
                            </div>

                            <div class="col-md-12 input-form mt-1">
                                <label for=""> Image </label>
                                <input type="file" class="form-control rounded-md" name="image" value="{{ $item->image ?? old('name')}}">
                            </div>

                            <div class="col-md-6 input-form mt-1">
                                <label for=""> Stock </label>
                                <input type="number" class="form-control rounded-md" name="stock" value="{{ $item->stock ?? old('stock')}}">
                            </div>

                            <div class="col-md-6 input-form mt-1">
                                <label for=""> Price </label>
                                <input type="text" class="form-control rounded-md" name="price" id="price" value="{{ $item->price ?? old('price')}}">
                            </div>

                            @php
                                $status = [
                                    '0' => 'Inactive',
                                    '1' => 'Active'
                                ];
                            @endphp

                            <div class="col-md-6 input-form mt-1">
                                <label for=""> Status </label>
                                <select name="active" class="form-control rounded-md border-3 border-black">
                                    <option value="" disabled selected> </option>
                                    @foreach ($status as $key => $value)
                                        <option value="{{ $key }}" {{ $key == ($item->status ?? old('active')) ? 'selected' : ''}}> {{ $value }}</option>
                                    @endforeach
                                </select>
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

    @push('scripts')
        <script src="{{ asset('js/numeric.js') }}"></script>
        <script>
            $(document).ready(function() {
                $(document).on('keyup', '#price', function() {
                    var value = $(this).val();
                    $(this).val( number_format(value, 0 , '.' , ',') );
                });
            });
        </script>
    @endpush()
</x-app-layout>
