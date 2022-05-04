
        $(document).ready(function() {
            // $('#example').DataTable();
            $("#example")
                        .DataTable({
                            responsive: true,
                            lengthChange: false,
                            "lengthMenu": [
                                [10, 24, 49, -1],
                                [10, 25, 50, "All"]
                            ],
                            
                            autoWidth: false,
                            buttons: {
                                dom: {
                                    button: {
                                        className: "btn btn-light  ",
                                    },
                                },
                                buttons: [{
                                    extend: "colvis",
                                    className: "btn btn-outline-primary"
                                }, ]
                            },
                            language: {
                                buttons: {
                                    colvis: "เลือกคอลัมน์",
                                },
                            },
                        })
                        .buttons()
                        .container()
                        .appendTo("#example_wrapper .col-md-6:eq(0)");
                        });
 