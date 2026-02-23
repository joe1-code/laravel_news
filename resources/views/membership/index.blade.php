@extends('layouts.master')
@section('title')
@lang('translation.analytics')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
<span>@lang('translation.membership.membership')</span>
@endslot
@slot('title')
<span>@lang('translation.membership.members')</span>

@endslot
@endcomponent

        {{-- <button type="button" class="btn btn-outline-danger btn-border btn-submit btn-sm w-xs mt-2"
            data-bs-dismiss="modal">
            <i class="ri-close-line me-1"></i> Cancel
        </button> --}}
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-outline-primary btn-border btn-sm w-xs me-2 mb-2">
            <i class="ri-group-line"></i> Add Members
        </button>
        </div>
        
<div class="row">
    
    <div class="card-body">
        <div class="table-responsive">
            <table id="universes-datatables" class="display table table-striped" style="width:100%">
                <thead class="table-light text-muted">
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Unit</th>
                        <th>Is Mandatory</th>
                        <th>Assessment</th>
                        <th>Is Selected</th>
                        <th>Fin Year</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


@endsection

@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>

<!-- dashboard init -->
<script src="{{ URL::asset('build/js/pages/dashboard-analytics.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script>
    $(document).ready(function() {
    // Initialize Select2 for systems (single select)
    

    // Form submission
    $('#accessRequestForm').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = new FormData(this);

        Swal.fire({
            title: "Dear {{ Auth::user()->name }}",
            text: "Are you sure you want to submit?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes, submit',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: 'btn btn-outline-success btn-sm me-2',
                cancelButton: 'btn btn-outline-danger btn-sm'
            },
            buttonsStyling: false
        }).then((result) => {

            if (!result.isConfirmed) return;

            $.ajax({
                url: "{{ route('membership.post.members') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    form.find('button[type=submit]').prop('disabled', true);
                },
                success: function (response) {

                    if (response.success === false) {
                        Swal.fire({
                            title: 'Warning!',
                            text: response.message,
                            icon: 'warning',
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'btn btn-outline-warning btn-sm'
                            },
                            buttonsStyling: false
                        });
                    return; 
                    }

                    Swal.fire({
                        title: 'Success!',
                        text: response.message ?? 'Saved successfully',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-outline-success btn-sm'
                        },
                        buttonsStyling: false
                    });

                    $('#accessRequestModal').modal('hide');
                    form[0].reset();

                    $('#system_access_dt').DataTable().ajax.reload();
                },
                error: function (xhr) {

                    let message = 'Something went wrong';

                    if (xhr.status === 422) {
                        message = Object.values(xhr.responseJSON.errors).flat().join('\n');
                    }

                    Swal.fire({
                        title: 'Error',
                        text: message,
                        icon: 'error',
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-outline-danger btn-sm'
                        },
                        buttonsStyling: false
                    });
                },
                complete: function () {
                    form.find('button[type=submit]').prop('disabled', false);
                }
            });

        });
    });

    let table = $('#system_access_dt').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            // dom: 'lBfrtip',
            paging: true,
            scrollY: "400px",
            scrollCollapse: true,
            
            stateSaveCallback: function(settings, data) {
                localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data));
            },
            stateLoadCallback: function(settings) {
                return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance));
            },
            ajax: {
                url: "{!! route('membership.get.members') !!}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                error: function(xhr, error, code) {
                    console.log('Ajax error:', xhr, error, code);
                    console.log('Response:', xhr.responseText);
                }
            },
            columns: [
                    { data: 'expand', orderable: false, searchable: false, width: '40px' },
                    { data: 'name', name: 'user.name' },
                    { data: 'designation', name: 'user.designation' },
                    { data: 'email', name: 'user.email' },
                    { data: 'unit', name: 'user.unit' },
                    { data: 'request_date', name: 'staff_access_requests.created_at', orderable: false },
                    { data: 'status', orderable: false },
                    { data: 'assigned_to', orderable: false },
                    { data: 'reason', name: 'reason', orderable: false },
                ],
            fnRowCallback: function (nRow, aData) {
                $(nRow).on('click', function (e) {

                    if ($(e.target).closest('.btn-toggle').length) {
                        return;
                    }

                    document.location.href = "/ams/access_request/index/" + aData['id'];
                }).hover(
                    function () { $(this).css('cursor', 'pointer'); },
                    function () { $(this).css('cursor', 'auto'); }
                );
            }

        });
});

</script>


@endsection