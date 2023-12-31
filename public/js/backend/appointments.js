(function () {
    FTX.Appointments = {
        list: {
            selectors: {
                appointments_table: $("#appointments-table"),
            },

            init: function (com) {
                this.selectors.appointments_table.dataTable({
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
                        url: this.selectors.appointments_table.data("ajax_url"),
                        type: "post",
                        data: {
                            date: com,
                            status: 1,
                            trashed: false,
                            patient_id:
                                this.selectors.appointments_table.data(
                                    "patient_id"
                                ),
                        },
                    },
                    columns: [
                        { data: "start_date", name: "start_date" },
                        { data: "end_date", name: "end_date" },
                        { data: "patient_id", name: "patient_id" },
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
