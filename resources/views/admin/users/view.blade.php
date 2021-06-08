<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                   Detail Users

                   <span>
                       <a href="{{ route('users.index') }}"class="float-right py-2 px-4 font-semibold rounded-lg shadow-md text-white btn-warning">
                            Back
                        </a>
                   </span>
                </div>

                <div class="p-6">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td> Name </td>
                                <td> {{ $user->name }} </td>
                            </tr>

                            <tr>
                                <td> Email </td>
                                <td> {{ $user->email }} </td>
                            </tr>

                            <tr>
                                <td> Role </td>
                                <td> {{ $user->getRole() }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
