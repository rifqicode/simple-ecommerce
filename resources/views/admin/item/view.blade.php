<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                   Detail Item

                   <span>
                       <a href="{{ route('item.index') }}"class="float-right py-2 px-4 font-semibold rounded-lg shadow-md text-white btn-warning">
                            Back
                        </a>
                   </span>
                </div>

                <div class="p-6">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td> Name </td>
                                <td> {{ $item->name }} </td>
                            </tr>

                            <tr>
                                <td width="500"> Description </td>
                                <td> {{ $item->description }} </td>
                            </tr>

                            <tr>
                                <td width="500"> Image </td>
                                <td> <img src='{{ asset($item->image) }}' border="0" width="40" class="img-rounded" align="center" /> </td>
                            </tr>

                            <tr>
                                <td width="500"> Stock </td>
                                <td> {{ $item->stock }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
