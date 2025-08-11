jQuery(document).ready(function($) {
    'use strict';

    if ($("table.first").length) {

        $(document).ready(function() {
            $('table.first').DataTable({
                "order": [[ 0, "desc" ]],
                "language":{
                    
                        "sEmptyTable":     "Não há registos para mostrar",
                        "sInfo":           "A mostrar de _START_ até _END_ de _TOTAL_ registos",
                        "sInfoEmpty":      "A motrar de 0 até 0 de 0 registos",
                        "sInfoFiltered":   "(filtered from _MAX_ total entries)",
                        "sInfoPostFix":    "",
                        "sInfoThousands":  ",",
                        "sLengthMenu":     "Mostrar _MENU_ registos",
                        "sLoadingRecords": "A carregar",
                        "sProcessing":     "A processar...",
                        "sSearch":         "Procurar:",
                        "sZeroRecords":    "Não foram encontrados resultados",
                        "oPaginate": {
                            "sFirst":    "Primeiro",
                            "sLast":     "Ultimo",
                            "sNext":     "Próximo",
                            "sPrevious": "Anterior"
                        },
                        "select": {
                            "rows": {
                                "_": "Escolheu %d linhas",
                                "0": "Clique numa linha para selecionar",
                                "1": "1 linha selecionada"
                            }
                        }
                    
                }
            });
        });
    }

    /* Calender jQuery **/

    if ($("table.second").length) {

        $(document).ready(function() {
            var table = $('table.second').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');
        });
    }


    if ($("#example2").length) {

        $(document).ready(function() {
            $(document).ready(function() {
                var groupColumn = 2;
                var table = $('#example2').DataTable({
                    "columnDefs": [
                        { "visible": false, "targets": groupColumn }
                    ],
                    "order": [
                        [groupColumn, 'asc']
                    ],
                    "displayLength": 25,
                    "drawCallback": function(settings) {
                        var api = this.api();
                        var rows = api.rows({ page: 'current' }).nodes();
                        var last = null;

                        api.column(groupColumn, { page: 'current' }).data().each(function(group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before(
                                    '<tr class="group"><td colspan="5">' + group + '</td></tr>'
                                );

                                last = group;
                            }
                        });
                    }
                });

                // Order by the grouping
                $('#example2 tbody').on('click', 'tr.group', function() {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === groupColumn && currentOrder[1] === 'desc') {
                        table.order([groupColumn, 'desc']).draw();
                    } else {
                        table.order([groupColumn, 'asc']).draw();
                    }
                });
            });
        });
    }

    if ($("#example3").length) {

        $('#example3').DataTable({
            select: {
                style: 'multi'
            }
        });

    }
    if ($("#example4").length) {

        $(document).ready(function() {
            var table = $('#example4').DataTable({
                fixedHeader: true
            });
        });
    }

});