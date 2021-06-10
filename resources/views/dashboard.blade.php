<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
            <div class="flex justify-center gap-2">
                @foreach ($category as $category)
                    <button onclick="renderItem({{ $category->id }})" class="bg-white p-2 rounded-2xl shadow-md border-2 hover:bg-indigo-400 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50">
                        <p class="font-thin"> {{ $category->name }} </p>
                    </button>
                @endforeach
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" id="item">

        </div>

        <div class="bg-white shadow-sm" style="bottom:50px; right:100px;position: fixed;">
            <div class="container">
                <img src="{{ asset('assets/icon/images.png') }}" style="width:60px; transform: scaleX(-1);margin: auto;">
                <button class="bg-white p-2 rounded-sm text-green-600 font-bold text-opacity-100" style="width: 100px;">
                    Cart
                </button>
            </div>
        </div>>
    </div>

    @push('scripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script>
            $(document).ready(() => {
                let defaultCategory = '{{ $firstCategory }}';

                renderItem(defaultCategory)
            });

            async function renderItem(category) {

                var url = '{{ route("list-product", ":id") }}';
                url = url.replace(':id', category);

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        $('#item').html(res.html)
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
