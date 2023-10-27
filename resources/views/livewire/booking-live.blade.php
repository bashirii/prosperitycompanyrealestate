<div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header ">
                 Customer Booking
                {{-- <button class="btn btn-primary btn-sm  float-end" wire:click="showForm"><i class="uil-plus"></i> Add Item</button> --}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <input type="text" class="form-control form-control-sm" wire:model="keywords" placeholder="Search here...">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered table-centered mb-0">
                        <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            {{-- <th>Email</th> --}}
                            <th>Phone number</th>
                            <th>Country</th>
                            <th>Travel Date</th>
                            <th>Destination</th>
                            <th>More info</th>
                            <th>Created At</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                        @forelse($bookings as $key => $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td class="">
                                    {{ $item->first_name . ' ' . $item->last_name }}
                                    {{-- <img src="{{ asset('storage/' . $item->image) }}" alt="destination image" class="img" width="30px;" height="30px" srcset=""> --}}
                                </td>
                                {{-- <td>
                                    @if($item->is_active)
                                        <span class="badge badge-success-lighten">Active</span>
                                    @else
                                        <span class="badge badge-danger-lighten">In Active</span>
                                    @endif
                                </td> --}}
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->country }}</td>
                                <td>{{ $item->travel_date_from }}</td>
                                <td>{{ $item->destination->name }}</td>
                                <td>{{ Str::limit($item->more_info, 10) }}</td>
                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-sm" wire:click="showViewModal('{{$item->id }}')" data-bs-toggle="modal" data-bs-target="#view_booking_modal"><i class="uil-eye"></i></button>
                                    {{-- <button class="btn btn-warning btn-sm" wire:click="prepareEditbooking('{{$item->id }}')"><i class="uil-edit"></i></button> --}}
                                    <button class="btn btn-danger btn-sm" wire:click="showDeleteModal('{{$item->id }}')" data-bs-toggle="modal" data-bs-target="#delete_booking_modal"><i class="uil-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center my-2">No Customer Booking</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <br>
                {{ $bookings->links() }}
            </div>
        </div>
    </div>

    <div id="view_booking_modal" wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title" id="danger-header-modalLabel">destinations </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-7">
                            <div class="row mt-2">
                                <div class="col-12">
                                    <p class="font-14">{{ $booking->created_at }}</p>
                                </div>
                                <div class="col-12">
                                    <h2 class="font-16">{{ $booking->name }}</h2>
                                </div>
                            </div>
                        </div>
                    <div class="col-5">
                        <div class="row">
                            <div class="col">
                                <img src="{{ asset('storage/' . $booking->image ) }}" alt="booking image" srcset="" width="180px">
                            </div>
                        </div>
                    </div>
                    </div>
                    <hr>
                    <div class="row">
                        <p>{{ $booking->preview_desc }}</p>
                    </div>
                    <hr>
                    <div class="row">
                        {{-- <p class="col ">Recorded by:<span class="fw-bold"> {{ $booking->user->name }}</span></p> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div id="delete_booking_modal" wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title" id="danger-header-modalLabel">Confirmation</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <h4 style="color: red">Are you sure you want to delete this Booking record?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" wire:click="deletebooking" data-bs-dismiss="modal">Yes, Delete</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    </div>

<script>
// View modal
document.addEventListener('livewire:load', function () {
    livewire.on('showViewModal', () => {
        $('#view_booking_modal').modal('show')
    });
    livewire.on('closeDeleteModal', () => {
        $('#view_booking_modal').modal('hide')
    });
});

// Delete modal
document.addEventListener('livewire:load', function () {
    livewire.on('showDeleteModal', () => {
        $('#delete_booking_modal').modal('show')
    });
    livewire.on('closeDeleteModal', () => {
        $('#delete_booking_modal').modal('hide')
    });
});

</script>
</div>
