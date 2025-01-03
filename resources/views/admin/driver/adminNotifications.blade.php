@include('admin.component.header')
{{-- @include('admin.component.style') --}}
@include('admin.component.topnav')
@include('admin.component.navbar')

<style>
    td, th {
        text-align: center !important;
        vertical-align: middle !important;
    }

    .badge {
        font-size: 0.9em;
        padding: 5px 10px;
    }

    .btn {
        margin: 0 5px;
    }

    .table-container {
        margin: 20px 0;
    }

    .card {
        padding: 20px;
    }
</style>

<div class="content-body">
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="table-container">
                    <div class="card">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="color: black;">S.no</th>
                                    <th style="color: black;">Sender</th>
                                    <th style="color: black;">Message</th>
                                    <th style="color: black;">Status</th>
                                    <th style="color: black;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($notifications as $notification)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $notification->sender->name ?? 'Unknown' }}</td>
                                        <td>{{ $notification->text ?? 'No message' }}</td>
                                        <td>
                                            @if ($notification->status === 'unread')
                                                <span class="badge bg-danger">Unread</span>
                                            @else
                                                <span class="badge bg-success">Read</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($notification->status === 'unread')
                                                <form method="POST" action="{{ route('read.notification' , $notification->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-primary btn-sm">Mark as Read</button>
                                                </form>
                                            @else
                                                <span>{{ $notification->text }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No Notifications Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.component.footer')

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">

<script>
    $(document).ready(function () {
        $('.table').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 10,
        });
    });
</script>
