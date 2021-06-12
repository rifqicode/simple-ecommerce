<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
            <div class="flex justify-center gap-2">
                @foreach ($category as $category)
                    <button onclick="renderItem({{ $category->id }})" class="bg-white p-2 rounded-2xl shadow-md border-2 hover:bg-indigo-400 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50">
                        <p class="font-thin m-auto"> {{ $category->name }} </p>
                    </button>
                @endforeach
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" id="item">

        </div>

        <div class="bg-white shadow-sm" style="bottom:50px; right:100px;position: fixed;">
            <div class="" style="position: relative">
                <button class="btn btn-default rounded-sm text-green-600 font-bold text-opacity-100 shop" style="width: 100px;">
                    <img src="{{ asset('assets/icon/images.png') }}" style="width:60px; transform: scaleX(-1);margin: auto;">
                    <span class="text-red-500 font-bold" id="current-item"> 0 </span>
                    Item
                </button>
            </div>
        </div>

        <div class="modal" id="shop-modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content" style="margin-top: 20%">
                <div class="modal-header">
                    <h5 class="modal-title">List Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <label for=""> Name </label>
                            <input type="text" id="name" class="form-control" required>
                        </div>

                        <div class="col-md-12">
                            <label for=""> Address </label>
                            <textarea name="address" class="form-control" id="address" id="alamat" cols="30" rows="3"></textarea>
                        </div>
                    </div>

                    <ol class="list-group list-group-numbered mt-5" id="shop-list-item">

                    </ol>
                    <div class="col-md-12">
                        <div class="alert alert-success" role="alert" id="shop-total">
                            Total : Rp. 500.000 | 54 Item
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="order()">Order!</button>
                </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <script src="{{ asset('js/numeric.js') }}"></script>
        <script src="{{ asset('js/loader.js') }}"></script>

        <script>
            $(document).ready(() => {
                $('#shop-modal').modal();

                let defaultCategory = '{{ $firstCategory }}';

                renderItem(defaultCategory);
                updateCurrentItem();

                $(document).on('click', '.shop', function() {
                    renderItemList();
                    $('#shop-modal').modal('show');
                });

                $(document).on('click', '.add-item', function() {
                    let data = {
                        id : $(this).data('id'),
                        name : $(this).data('name'),
                        price : $(this).data('price'),
                    }

                    addItem(data);
                });

                $(document).on('click', '.remove-item', function() {
                    let idItem = $($(this).parent()).attr('id');

                    removeItem(idItem);
                })
            });
        </script>
    @endpush
</x-app-layout>
