<!-- JAVASCRIPT -->
<script src="{{asset('/')}}assets/libs/jquery/jquery.min.js"></script>
<script src="{{asset('/')}}assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('/')}}assets/libs/metismenu/metisMenu.min.js"></script>
<script src="{{asset('/')}}assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{asset('/')}}assets/libs/node-waves/waves.min.js"></script>
<!-- apexcharts -->
<script src="{{asset('/')}}assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="{{asset('/')}}assets/js/pages/dashboard.init.js"></script>

<!-- Required datatable js -->
<script src="{{asset('/')}}assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{asset('/')}}assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{asset('/')}}assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/')}}assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('/')}}assets/libs/jszip/jszip.min.js"></script>
<script src="{{asset('/')}}assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="{{asset('/')}}assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="{{asset('/')}}assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('/')}}assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('/')}}assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="{{asset('/')}}assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('/')}}assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="{{asset('/')}}assets/js/pages/datatables.init.js"></script>
<script src="{{asset('/')}}assets/libs/select2/js/select2.min.js"></script>
<script src="{{asset('/')}}assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="{{asset('/')}}assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="{{asset('/')}}assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="{{asset('/')}}assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="{{asset('/')}}assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="{{asset('/')}}assets/libs/%40chenfengyuan/datepicker/datepicker.min.js"></script>

<!-- form advanced init -->
<script src="{{asset('/')}}assets/js/pages/form-advanced.init.js"></script>
<!-- Summernote js -->
<script src="{{asset('/')}}assets/libs/summernote/summernote-bs4.min.js"></script>

<!-- init js -->
<script src="{{asset('/')}}assets/js/pages/form-editor.init.js"></script>
<!-- App js -->
<script src="{{asset('/')}}assets/js/app.js"></script>

<script>
    $('.select2').select2({
        width: '100%',
    });
    var colorSizeID = 500;
    $(document).ready(function () {
        $(document).on('click', '#addNewSize', function () {
            $.ajax({
                type: 'GET',
                url: "{{ url('get-all-color-and-size') }}",
                data: '',
                dataType: 'json',
                success: function (res) {
                    var tr = '';
                    tr += '<tr>';

                    tr += '<td>';
                    tr += '<select name="size['+colorSizeID+']" class="form-control">';
                    tr += '<option value=""> ------ Select Product Size ------ </option>';
                    $.each(res.sizes, function (key, value) {
                        tr += '<option value="'+value.id+'"> '+value.name+' </option>';
                    });
                    tr += '</select>';
                    tr += '</td>';

                    tr += '<td>';
                    tr += '<select class="select2 form-control select2-multiple my-select2" name="color['+colorSizeID+']" multiple="multiple" data-placeholder="Select Colors...">';
                    $.each(res.colors, function (key, value) {
                        tr += '<option value="'+value.id+'"> '+value.name+' </option>';
                    });
                    tr += '</select>';
                    tr += '</td>';

                    tr += '<td>';
                    tr += '<button type="button" class="btn btn-danger" id="removeItems">Remove</button>';
                    tr += '</td>';

                    tr += '</tr>';

                    $('#upToRow').append(tr);
                    $('.my-select2').select2({
                        width: '100%',
                    });
                    colorSizeID++;
                }
            });
        });

        $(document).on('click', '#removeItems', function (){
            $(this).closest('tr').remove();
        });

        $(document).on('change', '#getCategoryId', function () {
            var categorId = $(this).val();
            $.ajax({
                type: 'GET',
                url: "{{ url('get-sub-category-by-category') }}",
                data: {id: categorId},
                dataType: 'json',
                success: function (res) {
                    var selectElement = $('#subCategoryId');
                    selectElement.empty();
                    var option = '';
                    option += '<option disabled selected> ------ Select Product Sub Category ------ </option>';
                    $.each(res, function (key, value) {
                        option += '<option value="'+value.id+'"> '+value.name+' </option>';
                    });
                    selectElement.append(option);
                }
            });
        });
    });

    var adStockIndex = 500;
    $(document).on('click', '#adStockBtn', function () {
        $.ajax({
            type: 'GET',
            url: "{{ url('get-id-wish-info') }}",
            data: '',
            dataType: 'json',
            success: function (res) {
                var tr = '';
                tr += '<tr>';

                tr += '<td>';
                tr += '<select name="stock['+adStockIndex+'][suplier]" class="form-control">';
                tr += '<option value=""> -- Select Suplier -- </option>';
                $.each(res.supliers, function (key, value) {
                    tr += '<option value="'+value.id+'"> '+value.company_name+' </option>';
                });
                tr += '</select>';
                tr += '</td>';

                tr += '<td>';
                tr += '<select name="stock['+adStockIndex+'][product]" class="form-control inventoryItemSelect" data-id="'+adStockIndex+'">';
                tr += '<option value=""> -- Select Product -- </option>';
                $.each(res.products, function (key, value) {
                    tr += '<option value="'+value.id+'"> '+value.name+' </option>';
                });
                tr += '</select>';
                tr += '</td>';

                tr += '<td>';
                tr += '<select class="select2 form-control select2-multiple my-select2" id="size'+adStockIndex+'" name="stock['+adStockIndex+'][size][]" multiple="multiple" data-placeholder="Select Size">';
                tr += '<option value=""> -- Select Size -- </option>';
                $.each(res.sizes, function (key, value) {
                    tr += '<option value="'+value.id+'"> '+value.name+' </option>';
                });
                tr += '</select>';
                tr += '</td>';

                tr += '<td>';
                tr += '<select class="select2 form-control select2-multiple my-select2" id="color'+adStockIndex+'" name="stock['+adStockIndex+'][color][]" multiple="multiple" data-placeholder="Select Color">';
                tr += '<option value=""> -- Select Color -- </option>';
                $.each(res.colors, function (key, value) {
                    tr += '<option value="'+value.id+'"> '+value.name+' </option>';
                });
                tr += '</select>';
                tr += '</td>';

                tr += '<td>';
                tr += '<input type="number" class="form-control inventory-unit-count" min="1" name="stock['+adStockIndex+'][unit_price]" data-id="'+adStockIndex+'" id="unitPrice'+adStockIndex+'"/>';
                tr += '</td>';

                tr += '<td>';
                tr += '<input type="number" class="form-control inventory-amount-count" min="1" data-id="'+adStockIndex+'" name="stock['+adStockIndex+'][stock_amount]" id="stockAmount'+adStockIndex+'"/>';
                tr += '</td>';

                tr += '<td>';
                tr += '<input type="number" class="form-control" readonly name="stock['+adStockIndex+'][total_price]" id="totalPrice'+adStockIndex+'"/>';
                tr += '</td>';

                tr += '<td>';
                tr += '<button type="button" class="btn btn-danger btn-sm" id="removeStockItems">-</button>';
                tr += '</td>';

                tr += '</tr>';

                $('#adStockFild').append(tr);
                $('.my-select2').select2({
                    width: '100%',
                });
                adStockIndex++;
            }
        });
    });

    $(document).on('click', '#removeStockItems', function (){
        $(this).closest('tr').remove();
    });

    $(document).on('change', '.inventoryItemSelect', function (){
        var id = $(this).val();
        var dataId = $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            url: "{{ url('get-product-stock-info') }}",
            data: {id: id},
            dataType: 'json',
            success: function (res) {
                var selectSize = $('#size'+dataId);
                var selectColor = $('#color'+dataId);
                var unitPrice = $('#unitPrice'+dataId);
                selectSize.empty();
                selectColor.empty();

                var colorOption = '';
                colorOption += '<option value=""> ------ Select Product Color ------ </option>';
                $.each(res.sizes, function (key, value) {
                    colorOption += '<option value="'+value.id+'"> '+value.name+' </option>';
                });
                selectSize.append(colorOption);

                var sizeOption = '';
                sizeOption += '<option value=""> ------ Select Product Size ------ </option>';
                $.each(res.colors, function (key, value) {
                    sizeOption += '<option value="'+value.id+'"> '+value.name+' </option>';
                });
                selectColor.append(sizeOption);

                unitPrice.val(res.price);
            }
        });
    });

    $(document).on('keyup', '.inventory-amount-count', function () {
        var dataId = $(this).attr('data-id');
        var stockAmount = $(this).val();
        var unitPrice = $('#unitPrice'+dataId).val();
        var itemsTotalPrice = stockAmount * unitPrice;

        $('#totalPrice'+dataId).val(itemsTotalPrice);
    });

    $(document).on('keyup', '.inventory-unit-count', function () {
        var dataId = $(this).attr('data-id');
        var unitPrice = $(this).val();
        var stockAmount = $('#stockAmount'+dataId).val();
        var itemsTotalPrice = stockAmount * unitPrice;

        $('#totalPrice'+dataId).val(itemsTotalPrice);
    });
</script>
