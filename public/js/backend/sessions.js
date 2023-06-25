(function () {
    FTX.Sessions = {
        list: {
            selectors: {
                sessions_table: $("#sessions-table"),
            },

            init: function () {
                this.selectors.sessions_table.dataTable({
                    dom: "Bfrtip",
                    buttons: [
                        //'copy', 'excel', 'pdf', 'print'
                        {
                            extend: "copy",
                            text: "نسخ",
                            exportOptions: {
                                columns: ":visible:not(:last-child)",
                            },
                        },
                        {
                            extend: "excel",
                            text: "تصدير Excel",
                            exportOptions: {
                                columns: ":visible:not(:last-child)",
                            },
                        },
                        {
                            extend: "pdfHtml5",
                            text: "تصدير pdf",
                            exportOptions: {
                                columns: ":visible:not(:last-child)",
                            },
                        },
                        {
                            extend: "print",
                            text: "طباعة",
                            exportOptions: {
                                columns: ":visible:not(:last-child)",
                            },
                        },
                        "pageLength",
                        "colvis",
                    ],
                    pageLength: 50,
                    lengthMenu: [
                        [10, 25, 50, 100, 200, 500],
                        [
                            "10 اسطر",
                            "25 سطر",
                            "50 سطر",
                            "100 سطر",
                            "200 سطر",
                            "500 سطر",
                        ],
                    ],
                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.sessions_table.data("ajax_url"),
                        type: "post",
                        data: {
                            status: 1,
                            trashed: false,
                            patient_id:
                                this.selectors.sessions_table.data(
                                    "patient_id"
                                ),
                        },
                    },
                    columns: [
                        { data: "patient_id", name: "patient_id" },
                        { data: "treatment_area", name: "treatment_area" },
                        { data: "spot_size", name: "spot_size" },
                        { data: "fluence", name: "fluence" },
                        { data: "pluse_width", name: "pluse_width" },
                        { data: "count", name: "count" },
                        { data: "price", name: "price" },
                        { data: "note", name: "note" },
                        { data: "created_at", name: "created_at" },
                        {
                            data: "actions",
                            name: "actions",
                            searchable: false,
                            sortable: false,
                        },
                    ],
                    order: [[0, "asc"]],
                    searchDelay: 500,
                    scrollY: true,
                    language: {
                        emptyTable: "لايوجد بيانات",
                        loadingRecords: "جار التحميل...",
                        processing: "الاستعلام ...",
                        search: "البحث: ",
                        lengthMenu: "كل صفحة _MENU_ من العناصر",
                        zeroRecords: "لايوجد بيانات",
                        paginate: {
                            first: "الصفحة الأولى",
                            last: "الصفحة الأخيرة",
                            next: "الصفحة التالية",
                            previous: "الصفحة السابقة",
                        },
                        info: "الصفحة (_PAGE_) / من اصل (_PAGE_) | العدد الكلي (_TOTAL_) ",
                        infoEmpty: "لايوجد بيانات",
                        infoFiltered:
                            "(إجمالي عناصر التصفية _MAX_ من العناصر) ",
                    },
                    createdRow: function (row, data, dataIndex) {
                        FTX.Utils.dtAnchorToForm(row);
                    },
                });
            },
        },

        edit: {
            init: function (locale) {
                FTX.tinyMCE.init();
            },
        },
    };
})();
