<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer text-center">
    &COPY; 2021 <?php echo CORP; ?>
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>


<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="assets/plugins/bootstrap/js/tether.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!--Menu sidebar -->
<script src="js/sidebarmenu.js"></script>
<!--stickey kit -->
<script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>

<!--select2-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!--Custom JavaScript -->
<script src="js/custom.min.js"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!-- Flot Charts JavaScript -->
<script src="assets/plugins/flot/jquery.flot.js"></script>
<script src="assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<script src="js/flot-data.js"></script>
<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->
<script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

<!-- Data tables-->
<script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
<script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-------------------- WYSIWYG EDITOR ---------------->
<script src="assets/plugins/CLEditor1_4_3/jquery.cleditor.min.js"></script>
<!--    <script src="js/editorInit.js"></script>-->
<script type="text/javascript">
/*$('.select22').select2({
    placeholder: 'Search for value',
});

*/

//BEST COMFIGURATION. JUST MAKE THE SERVER SIDE A PAIR OF ID, TEXT PAIR, THEN EVERYTHING WORK WITH THIS ARRANGEMENT

$('.select22').select2({
    placeholder: 'Type Referer\'s Name',
    ajax: {
        url: 'search.php?type=select_users',
        dataType: 'json',
        type: 'GET',
        data: function(params) {
            var query = {
                q: params.term,
            }
            return query;
        },
        processResults: function(data) {
            // Transforms the top-level key of the response object from 'items' to 'results'
            return {
                results: data
            };
        },
        minimumInputLength: 1,
        

    }
});

/*


                /**
                var data = $.map(yourArrayData, function (obj) {
  obj.id = obj.id || obj.pk; // replace pk with your identifier

  return obj;
});

var data = $.map(yourArrayData, function (obj) {
  obj.text = obj.text || obj.name; // replace name with the property used for the text

  return obj;
});

                 

        $('.select22').select2({

                ajax: {
                    url: 'search.php',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        var query = {
                            search: params.term,
                            type: 'select2',
                            table: 'users'
                        }

                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },

                    processResults: function(data) {
                        return {
                            results: data.item,
                        }
                    },

                },

                placeholder: 'Search for a member name or id',
                minimumInputLength: 1,
                /*templateResult: formatRepo,
  templateSelection: formatRepoSelection

});

  */

function formatRepo(repo) {
    if (repo.loading) {
        return repo.text;
    }

}

function formatRepoSelection(repo) {
    return repo.full_name || repo.text;
}
</script>


<script type="text/javascript">
$(document).ready(function() {
    $('.pricing-list1 input[type=radio]').click(function e() {

        if ($('.pricing-list1 input[type=radio]').is(':checked')) {
            var min, top, profit, plan, platform;

            item = $(this);
            var info = $('form').find('input#amt');
            min = item.data('min');
            top = item.data('max');
            profit = parseInt(item.data('profit'));
            plan = item.data('plan');
            $('#plans').val(plan);

            info.attr({
                min: min,
                max: top
            });
            //info.attr('max', top);
            info.val(min);

            //total = (info.val * (profit/100)) + parseFloat(info.val());
            total = (min * (profit / 100)) + parseFloat(min);

            $('input#profit').val('$ ' + (total.toFixed(2)));

            price = item.parent();
            $(".pricing-list1 input[type=radio]").parent().find('#result').addClass('hidden').fadeOut(
                'fast');
            $(price).find('#result').removeClass('hidden');

            $('input#amt').attr('disabled', false);
        } else {

        }

    });

    $('input#amt').keyup(function() {

        var item = $('input#amt').val();
        var profit = $('.pricing-list1 input:checked').data('profit');
        total = (parseFloat(item) * (profit / 100)) + parseFloat(item);
        $('input#profit').val('$ ' + (total.toFixed(2)));
    });


    $('#plans').change(function() {
        var plan = $('#plans').val();
        $('#plan' + plan).trigger('click');
    });

    //$('#dataTables-example_wrapper input[type=checkbox]').addClass('form-control');

    $("#message").cleditor({
        width: 680,
        height: 400
    });

});
</script>


<script>
//  DATATABLE SCRIPTS

$('#dataTables-example2').dataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        url: "search.php?type=datatable_user",
        type: 'GET',
    },
    "order": [
        [0, 'asc']
    ],


    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        //debugger;
        var index = iDisplayIndexFull + 1;
        $("td:first", nRow).html(index);
        return nRow;
    },

});

$('#dataTables-exmaple').dataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        url: "search.php?type=datatable_withd",
        type: 'GET',
    },
    "order": [
        [0, 'asc']
    ],


    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        //debugger;
        var index = iDisplayIndexFull + 1;
        $("td:first", nRow).html(index);
        return nRow;
    },


});

$('#dataTables-example3').dataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        url: "search.php?type=datatable_pendinguser",
        type: 'GET',
    },
    "order": [
        [0, 'asc']
    ],


    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        //debugger;
        var index = iDisplayIndexFull + 1;
        $("td:first", nRow).html(index);
        return nRow;
    },


});


$('#dataTables-example3 tr').attr('onclick', 'mark()');
/*
$(document).ready(function() {
	var table = $('#datatables-example').DataTable({
		"footerCallback": function(row, data, start, end, display) {
			var api = this.api(),
				data;

			// Remove the formatting to get integer data for summation
			var intVal = function(i) {
				return typeof i === 'string' ?
					i.replace(/[\$,]/g, '') * 1 :
					typeof i === 'number' ?
					i : 0;
			};
			// Total over this page
			pageTotal = api
				.column(6, {
					page: 'current'
				})
				.data()
				.reduce(function(a, b) {
					return intVal(a) + intVal(b);
				}, 0);
			Total = api
				.column(6)
				.data()
				.reduce(function(a, b) {
					return intVal(a) + intVal(b);
				}, 0);

			// Update footer
			$(api.column(6).footer()).html(
				'' + pageTotal.toFixed(2) + '<br>(Total: ' + Total.toFixed(2) + ')' + ''
			);
		},
		select: {
			style: 'single'
		},
		order: [
			[2, 'asc']
		],

		dom: 'Bfrtip',
		"fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			//debugger;
			var index = iDisplayIndexFull + 1;
			$("td:first", nRow).html(index);
			return nRow;
		},

		"pageLength": 20,
		"lengthMenu": [
			[20, 30, 50, -1],
			[20, 30, 50, "All"]
		],
		columnDefs: [{
			targets: 0,
			render: function(data, type, row, meta) {
				console.log(meta.row);
				console.log(type == 'export' ? meta.row : data);
				return type == 'export' ? meta.row + 1 : data;
			}
		}],
		buttons: ['pageLength',
			{
				extend: 'print',
				text: 'Print All',
				autoPrint: true,
				exportOptions: {
					columns: [':not(.hidden-print)'],
					orthogonal: 'export',
					modifier: {
						page: 'all'
					},
				},
				messageTop: function() {
					return '<h2 class="text-center"></h2>'
				},
				messageBottom: 'Print: 01-May-2019',
				customize: function(win) {

					$(win.document.body).find('h1').css('text-align', 'center');
					$(win.document.body).find('table')
						.removeClass('table-striped table-responsive-sm table-responsive-lg dataTable')
						.addClass('compact')
						.css('font-size', 'inherit', 'color', '#000');

				},
				footer: true
			},

		]
	})
});
*/
</script>
<!--------------- Select Search  --------->
<script type="text/javascript">
function mark(id) {
    $('#' + id).trigger('click');
    $('#r' + id).addclass('background-color: lightbrown!important');
}
</script>
<?php
if (isset($_SESSION['result'])) {

    list($code, $message) = $_SESSION['result'];
    $title = ($code == 1) ? "Successful" : "An Error Occurred";
    ?>

<div id="gritter-notice-wrapper" class="wow fadeIn" onclick="return $('#gritter-notice-wrapper').fadeOut();">
    <div id="gritter-item-1" class="gritter-item-wrapper my-sticky-class">
        <div class="gritter-top"></div>
        <div class="gritter-item">
            <div class="gritter-close" onclick="return $('#gritter-notice-wrapper').addClass('hidden');"
                style="display: inline;">
                <?php
$image = ($code == 1) ? 'good.jpg' : 'fail.jpg';
    ?>
            </div><img src="../assets/new/<?php echo $image; ?>" class="gritter-image">
            <div class="gritter-with-image">
                <span class="gritter-title" style="color:#ffd777"><?php echo $title; ?>!</span>
                <p><?php echo $message; ?>
                </p>
            </div>
            <div style="clear:both">

            </div>
        </div>
        <div class="gritter-bottom">

        </div>
    </div>
</div>
<!--Uppps... App Error!
    The application encountered an error. Don't worry this error was already logged and our sysadmins were automatically notified!-->

<?php
unset($_SESSION['result']);
}
?>

</body>

</html>
/