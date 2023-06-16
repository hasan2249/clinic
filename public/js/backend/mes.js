(function () {
    FTX.Mes = {
        list: {
            selectors: {
                mes_table: $("#mes-table"),
            },

            init: function () {
                this.selectors.mes_table.dataTable({
                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.mes_table.data("ajax_url"),
                        type: "post",
                        data: { status: 1, trashed: false },
                    },
                    columns: [
                        { data: "name", name: "name" },
                        { data: "phone", name: "phone" },
                        { data: "logo", name: "logo" },
                        { data: "address", name: "address" },
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
