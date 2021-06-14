@if (count($product) > 0)
    <div class="grid md:grid-cols-3 sm:grid-cols-4 gap-4">
        @foreach ($product as $product)
            <div class="shadow-md w-auto rounded-b-xl" style="position: relative;">
                <button class="btn btn-success btn-md add-item"
                        data-name="{{ $product->name }}"
                        data-id="{{ $product->id }}"
                        data-price="{{ $product->price }}"
                        style="position: absolute; right: 0"> Add </button>
                <img src="{{ asset($product->image) }}" class="rounded-xl rounded-b-none" alt="image" style="width: 100%;
                height: 300px;">

                <div class="p-3">
                    <p> {{ $product->name }} </p>
                    <p class="font-bold mt-2"> Rp. {{ number_format($product->price) ?? 0 }}</p>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="min-height: 500px; position: relative;">
                <div class="p-6 bg-white border-gray-200 flex justify-center">
                    {{-- <img src="{{ asset('assets/icon/empty.png') }}" alt=""> --}}
                    <h1 style="margin:auto; top: 30%; position: absolute" class="text-lg"> Item not Found!</h1>
                </div>
            </div>
        </div>
    </div>
@endif
