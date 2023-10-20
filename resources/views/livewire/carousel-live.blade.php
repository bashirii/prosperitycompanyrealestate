<div>
    <div class="row">

        @if($viewForm)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">
                        Add Carousel Item
                        <button class="btn btn-warning btn-sm  float-end" wire:click="closeForm"><i class="uil-cancel"></i> Cancel</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="image" class="form-label font-12">Image <span class="required">*</span></label>
                                <input type="file" wire:model="file" id="image" accept="image/*" class="form-control form-control-sm">
                                @error('file') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="name" class="form-label font-12">Name <span class="required">*</span></label>
                                <input type="text" wire:model="name" id="name" class="form-control form-control-sm">
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="p_o_box" class="form-label font-12">P.O.Box <span class="required">*</span></label>
                                <input type="text" wire:model="p_o_box" id="p_o_box" class="form-control form-control-sm">
                                @error('p_o_box') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="address" class="form-label font-12">Address <span class="required">*</span></label>
                                <input type="text" wire:model="address" id="address" class="form-control form-control-sm">
                                @error('address') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="location" class="form-label font-12">location <span class="required">*</span></label>
                                <input type="text" wire:model="location" id="location" class="form-control form-control-sm">
                                @error('location') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="price" class="form-label font-12">$ Price <span class="required">*</span></label>
                                <input type="text" wire:model="price" id="image" class="form-control form-control-sm">
                                @error('price') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-success" wire:click="save" wire:loading.attr="disabled">
                            <span wire:loading.remove>Save</span>
                            <span wire:loading>Saving...</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                     Carousel
                    <button class="btn btn-primary btn-sm  float-end" wire:click="showForm"><i class="uil-plus"></i> Add Item</button>
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
                                <th>Image</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Location</th>
                                <th>Price</th>
                                <th>Created At</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                            @forelse($carousels as $key => $item)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td class="">
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="destination image" class="img" width="30px;" height="30px" srcset="">
                                    </td>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td>
                                        {{ $item->p_o_box . ' ' . $item->address }}
                                    </td>
                                    <td>
                                        {{ $item->location }}
                                    </td>
                                    <td>
                                        {{ $item->price }}
                                    </td>
                                    {{-- <td>
                                        @if($item->is_active)
                                            <span class="badge badge-success-lighten">Active</span>
                                        @else
                                            <span class="badge badge-danger-lighten">In Active</span>
                                        @endif
                                    </td> --}}
                                    <td>
                                        {{ $item->created_at }}
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm" wire:click="showViewModal('{{$item->id }}')"><i class="uil-eye"></i></button>
                                        <button class="btn btn-warning btn-sm" wire:click="prepareEditcarousel('{{$item->id }}')"><i class="uil-edit"></i></button>
                                        <button class="btn btn-danger btn-sm" wire:click="showDeleteModal('{{$item->id }}')"><i class="uil-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center my-2">No Carousel</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <br>
                    {{ $carousels->links() }}
                </div>
            </div>
        </div>
    </div>

    <div id="view_carousel_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title" id="danger-header-modalLabel">Carousel </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-7">
                            <div class="row mt-2">
                                <div class="col-12">
                                    <p class="font-14">{{ $carousel->created_at }}</p>
                                </div>
                                <div class="col-12">
                                    <h2 class="font-16">{{ $carousel->address }}</h2>
                                </div>
                            </div>
                        </div>
                    <div class="col-5">
                        <div class="row">
                            <div class="col">
                                <img src="{{ asset('storage/' . $carousel->image ) }}" alt="Carousel image" srcset="" width="180px">
                            </div>
                        </div>
                    </div>
                    </div>
                    <hr>
                    <div class="row">
                        <p>{{ $carousel->location }}</p>
                    </div>
                    <hr>
                    <div class="row">
                        <p class="col ">Recorded by:<span class="fw-bold"> {{ optional($carousel->user)->name }}</span></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div id="delete_carousel_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title" id="danger-header-modalLabel">Confirmation</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <h4 style="color: red">Are you sure you want to delete this Carsousel item?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" wire:click="deletecarousel">Yes, Delete</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>

<script>
    // View modal
    document.addEventListener('livewire:load', function () {
        livewire.on('showViewModal', () => {
            $('#view_carousel_modal').modal('show')
        });
        livewire.on('closeDeleteModal', () => {
            $('#view_carousel_modal').modal('hide')
        });
    });

    // Delete modal
    document.addEventListener('livewire:load', function () {
        livewire.on('showDeleteModal', () => {
            $('#delete_carousel_modal').modal('show')
        });
        livewire.on('closeDeleteModal', () => {
            $('#delete_carousel_modal').modal('hide')
        });
    });

</script>

