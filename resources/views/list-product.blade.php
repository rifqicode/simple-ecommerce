@if ($product)
    <div class="grid grid-cols-3 gap-4">
        @foreach ($product as $product)
            <div class="shadow-md w-auto rounded-b-xl" style="position: relative;">
                <button class="bg-indigo-200 p-3 rounded-sm float-right" style="position: absolute; right: 0"> Add </button>
                <img src="{{ asset($product->image) }}" class="rounded-xl rounded-b-none h-50" alt="image">

                <div class="p-5">
                    <p> {{ $product->name }} </p>
                    <p class="font-bold mt-2"> Rp. {{ number_format($product->price) ?? 0 }}</p>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-center">
                    Item not found!
                </div>
            </div>
        </div>
    </div>
@endif
