(function () {
    FTX.Patients = {
        list: {
            selectors: {
                Patients_table: $("#Patients-table"),
            },

            init: function () {
                this.selectors.Patients_table.dataTable({
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
                        url: this.selectors.Patients_table.data("ajax_url"),
                        type: "post",
                        data: { status: 1, trashed: false },
                    },
                    columns: [
                        { data: "name", name: "name" },
                        { data: "phone", name: "phone" },
                        { data: "birthday", name: "birthday" },
                        { data: "address", name: "address" },
                        { data: "created_at", name: "created_at" },
                        {
                            data: "actions",
                            name: "actions",
                            searchable: false,
                            sortable: false,
                        },
                    ],
                    order: [[0, "desc"]],
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
