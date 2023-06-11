(function () {

    FTX.Companys = {

        list: {
        
            selectors: {
                companys_table: $('#companys-table'),
            },
        
            init: function () {

                this.selectors.companys_table.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.companys_table.data('ajax_url'),
                        type: 'post',
                        data: { status: 1, trashed: false }
                    },
                    columns: [
                        { data: 'name', name: 'name' },
						{ data: 'logo', name: 'logo', visible: false },
						{ data: 'asset', name: 'asset' },
						{ data: 'required', name: 'required' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'actions', name: 'actions', searchable: false, sortable: false }

                    ],
					language:{
						emptyTable: 'لايوجد بيانات',
						loadingRecords: 'جار التحميل...',
						processing: "الاستعلام ...",
						search: "البحث: ",
						lengthMenu: "كل صفحة _MENU_ من العناصر",
						zeroRecords: 'لايوجد بيانات',
						paginate: {
							'first':      "الصفحة الأولى",
							'last':       "الصفحة الأخيرة",
							'next':       'الصفحة التالية',
							'previous':   'الصفحة السابقة'
						},
						info: "الصفحة (_PAGE_) / من اصل (_PAGE_) | العدد الكلي (_TOTAL_) ",
						infoEmpty: 'لايوجد بيانات',
						infoFiltered: "(إجمالي عناصر التصفية _MAX_ من العناصر) ",
					},
                    order: [[0, "asc"]],
                    searchDelay: 500,
                    "createdRow": function (row, data, dataIndex) {
                        FTX.Utils.dtAnchorToForm(row);
                    }
                });
            }
        },

        edit: {
            init: function (locale) {
                FTX.tinyMCE.init();                
            }
        },
    }
})();    