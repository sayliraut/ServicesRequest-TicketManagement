<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 dark:text-white">Categories</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Manage your service request categories</p>
            </div>
            <a href="{{route('categories.create')}}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow-md transition">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Add Category</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl">
            <div class="p-6">
                <table id="Datatable_category_list" class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                            <th class="text-left px-4 py-3 font-semibold text-gray-700 dark:text-gray-300">ID</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-700 dark:text-gray-300">Name</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-700 dark:text-gray-300">Status</th>
                            <th class="text-center px-4 py-3 font-semibold text-gray-700 dark:text-gray-300">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script>
    $(function(){
        const table = $('#Datatable_category_list').DataTable({
            ajax: { url: BASE_URL + '/categories/loadajax', dataSrc: '' },
            columnDefs: [
                { className: "px-4 py-3", targets: "_all" },
                { className: "text-center", targets: -1 }
            ],
            columns: [
                { data: 'id', render: (data) => `<span class="font-medium text-gray-700 dark:text-gray-300">${data}</span>` },
                { data: 'name', render: (data) => `<span class="text-gray-900 dark:text-white font-medium">${data}</span>` },
                {
                    data: 'is_active',
                    render: function (data) {
                        return data == 1
                            ? '<span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200"><span class="w-2 h-2 bg-emerald-600 dark:bg-emerald-400 rounded-full"></span>Active</span>'
                            : '<span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200"><span class="w-2 h-2 bg-red-600 dark:bg-red-400 rounded-full"></span>Inactive</span>';
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row){
                        const editUrl = BASE_URL + '/categories/' + row.id + '/edit';
                        return `
                            <div class="flex items-center justify-center gap-2">
                                <a href="${editUrl}" class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition"><span>✎</span> Edit</a>
                                <button data-id="${row.id}" class="btn-toggle inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition"><span>⟲</span></button>
                                <button data-id="${row.id}" class="btn-delete inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium bg-red-500 text-white rounded-lg hover:bg-red-600 transition"><span>✕</span></button>
                            </div>
                        `;
                    }
                }
            ],
            pageLength: 25,
            drawCallback: function() {
                $('#Datatable_category_list tbody tr').addClass('hover:bg-gray-50 dark:hover:bg-gray-700/50 transition border-b border-gray-200 dark:border-gray-700');
            }
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
