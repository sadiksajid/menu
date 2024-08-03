<div>

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h4 class="page-title mb-0">{{$translations['shipping_companies']}}</h4>
     
        </div>


        <div class="d-flex">


            <div class="justify-content-center">
                <div wire:loading.class.remove="d-none" class="spinner-border text-primary d-none"
                    style='width: 20px;height: 20px;margin-left: 20px;transition: 1s;' role="status">
                    <span class="sr-only">Loading...</span>
                </div>

                <a href="/staf/shipping_companies/add">
                    <button type="button" class="btn btn-dark btn-icon-text my-2 mr-2" data-toggle="sidebar-right"
                        data-target=".sidebar-right">
                        <i class="fe fe-plus mr-2"></i> New Company
                    </button>
                </a>

                <button type="button" class="btn btn-white btn-icon-text my-2 mr-2 refresh_datatable">
                    <i class="fe fe-refresh-cw"></i>
                </button>

                <button type="button" class="btn btn-white btn-icon-text my-2 mr-2" data-toggle="sidebar-right"
                    data-target=".sidebar-right">
                    <i class="fe fe-filter mr-2"></i> Filter
                </button>

            </div>
        </div>
    </div>

    <div class="row row-sm">

        <div class="col-12">

            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive" wire:ignore>
                        <table class="table table-centered mb-0 text-nowrap text-md-nowrap table-hover dataTable w-100"
                            id="orders" wire:ignore>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>LOGO</th>
                                    <th>NAME</th>
                                    <th>TAG</th>
                                    <th>URL</th>
                                    <th>Date</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>
@section('js')
<script>
var startDate;
var endDate;

var filter_dates = [];
</script>
<!-- Internal Data Table js -->
<script src="{{URL::asset('assets/plugins/datatable/jquery.dataTables.min.js')}}?v=6"></script>
<script src="{{URL::asset('assets/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/fileexport/dataTables.buttons.min.js')}}"></script>


<script>
function makeTable() {

    $(function() {

        var oTable = $('#orders').DataTable({
            language: {
                searchPlaceholder: "Search..."
            },
            "aaSorting": [],
            processing: true,
            serverSide: true,
            deferRender: true,
            lengthMenu: [100],
            order: [
                [1, "desc"]
            ],
            ajax: {
                type: "POST",
                url: '{!! route("datatables.shipping_companies.list") !!}',
                data: function(d) {
                    return $.extend({}, d, {
                        _token: "{{ csrf_token() }}"
                    });
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'logo',
                    name: 'logo',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'tag',
                    name: 'tag',
                },
                {
                    data: 'url',
                    name: 'site',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'date',
                    name: 'created_at',
                },
                {
                    data: 'actions',
                    name: 'actions',
                    searchable: false,
                    orderable: false,
                },


            ]

        });


        window.addEventListener('GetData', event => {
            oTable.draw();
        });
        $('.refresh_datatable').click(function() {
            oTable.draw();
        });
        $('#search-form').on('submit', function(e) {
            e.preventDefault();
            filters_inputs();
            oTable.draw();
        });
        $('#search-form').on('reset', function(e) {
            filters_reset();
            oTable.draw();
        });



        function filters_reset() {


        }
    });

}


$(document).ready(function() {

    console.log('asdsad');
    makeTable();

});
</script>
@endsection