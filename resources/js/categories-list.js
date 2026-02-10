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

    // Delete button handler
    $('#Datatable_category_list').on('click', '.btn-delete', function(){
        const id = $(this).data('id');
        if (!confirm('Delete this category?')) return;
        
        $.ajax({
            url: BASE_URL + '/categories/' + id,
            method: 'DELETE',
            data: { _token: $('meta[name="csrf-token"]').attr('content') },
            success: function(){ 
                table.ajax.reload(null, false); 
            },
            error: function(){ 
                alert('Delete failed'); 
            }
        });
    });

    // Toggle button handler
    $('#Datatable_category_list').on('click', '.btn-toggle', function(){
        const id = $(this).data('id');
        
        $.ajax({
            url: BASE_URL + '/categories/' + id + '/toggle',
            method: 'POST',
            data: { _token: $('meta[name="csrf-token"]').attr('content') },
            success: function(){ 
                table.ajax.reload(null, false); 
            },
            error: function(){ 
                alert('Toggle failed'); 
            }
        });
    });
});
