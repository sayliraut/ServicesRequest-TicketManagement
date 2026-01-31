<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Categories
        </h2>
        <a href="{{route('categories.create')}}" class="text-sm text-blue-600 hover:underline">
            Create New Category
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table id="Datatable_category_list" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>

$('#Datatable_category_list').DataTable({
    ajax: BASE_URL + 'categories/loadajax',
    columns: [
        { data: 'id' },
        { data: 'name' },
        {
            data: 'is_active',
            render: function (data) {
                return data == 1
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>';
            }
        }
    ]
});

    </script>
</x-app-layout>
