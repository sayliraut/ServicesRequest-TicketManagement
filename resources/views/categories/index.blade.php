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
                    <table id="Datatable_category_list" class="table table-bordered w-full">
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

</div>

    <script>
    $(function(){
        const table = $('#Datatable_category_list').DataTable({
            ajax: { url: BASE_URL + '/categories/loadajax', dataSrc: '' },
            columns: [
                { data: 'id' },
                { data: 'name' },
                {
                    data: 'is_active',
                    render: function (data, type, row) {
                        return data == 1
                            ? '<span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">Active</span>'
                            : '<span class="px-2 py-1 text-xs rounded bg-red-100 text-red-800">Inactive</span>';
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row){
                        const editUrl = BASE_URL + '/categories/' + row.id + '/edit';
                        return `
                            <a href="${editUrl}" class="inline-block px-2 py-1 mr-2 text-sm bg-blue-500 text-white rounded">Edit</a>
                            <button data-id="${row.id}" class="btn-delete inline-block px-2 py-1 mr-2 text-sm bg-red-500 text-white rounded">Delete</button>
                            <button data-id="${row.id}" data-active="${row.is_active}" class="btn-toggle inline-block px-2 py-1 text-sm bg-gray-500 text-white rounded">Toggle</button>
                        `;
                    }
                }
            ],
            pageLength: 25
        });

        // Delete
        $('#Datatable_category_list').on('click', '.btn-delete', function(){
            const id = $(this).data('id');
            if (!confirm('Delete this category?')) return;
            $.ajax({
                url: BASE_URL + '/categories/' + id,
                method: 'DELETE',
                data: { _token: $('meta[name="csrf-token"]').attr('content') },
                success: function(){ table.ajax.reload(null, false); },
                error: function(){ alert('Delete failed'); }
            });
        });

        // Toggle
        $('#Datatable_category_list').on('click', '.btn-toggle', function(){
            const id = $(this).data('id');
            $.ajax({
                url: BASE_URL + '/categories/' + id + '/toggle',
                method: 'POST',
                data: { _token: $('meta[name="csrf-token"]').attr('content') },
                success: function(){ table.ajax.reload(null, false); },
                error: function(){ alert('Toggle failed'); }
            });
        });
    });
    </script>
</x-app-layout>
