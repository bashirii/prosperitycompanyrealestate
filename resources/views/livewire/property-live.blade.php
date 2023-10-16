<div>
    <div>
        <div class="row">

            @if($viewForm)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header ">
                            Add Property
                            <button class="btn btn-warning btn-sm  float-end" wire:click="closeForm"><i class="uil-cancel"></i> Cancel</button>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <label for="name" class="form-label font-12"> Name <span class="required">*</span></label>
                                <input type="text" wire:model="name" id="name" class="form-control form-control-sm">
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-2">
                                <label for="image" class="form-label font-12">Image <span class="required">*</span></label>
                                <input type="file" wire:model="file" id="image" accept="image/*" class="form-control form-control-sm">
                                @error('file') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-2">
                                <label for="address" class="form-label">Address <span class="required">*</span></label>
                                <input type="text" wire:model="address" id="address" class="form-control form-control-sm">
                                @error('address') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-2">
                                <label for="location" class="form-label">Location <span class="required">*</span></label>
                                <input type="text" wire:model="location" id="location" class="form-control form-control-sm">
                                @error('location') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-2">
                                <label for="price" class="form-label">Price <span class="required">*</span></label>
                                <input type="text" wire:model="price" id="price" class="form-control form-control-sm">
                                @error('price') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-2">
                                <label for="area" class="form-label">Area <span class="required">*</span></label>
                                <input type="text" wire:model="area" id="area" class="form-control form-control-sm">
                                @error('area') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-2">
                                <label for="beds" class="form-label">Beds <span class="required">*</span></label>
                                <input type="text" wire:model="beds" id="beds" class="form-control form-control-sm">
                                @error('beds') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-2">
                                <label for="baths" class="form-label">Baths <span class="required">*</span></label>
                                <input type="text" wire:model="baths" id="baths" class="form-control form-control-sm">
                                @error('baths') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-2">
                                <label for="garages" class="form-label">Garages <span class="required">*</span></label>
                                <input type="text" wire:model="garages" id="garages" class="form-control form-control-sm">
                                @error('garages') <span class="error">{{ $message }}</span> @enderror
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
                         Property
                        <button class="btn btn-primary btn-sm  float-end" wire:click="showForm"><i class="uil-plus"></i> Add Property</button>
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
                                    <th>Image</th>
                                    <th>Address</th>
                                    <th>Location</th>
                                    <th>Price</th>
                                    <th>Area</th>
                                    <th>Beds</th>
                                    <th>Baths</th>
                                    <th>Garages</th>

                                    {{-- <th>Status</th> --}}
                                    <th>Created At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                @forelse($properties as $key => $property)
                                    <tr>
                                        <td>{{ $i + 1 }}</td> {{-- changed from this<td>{{ $key+1 }}</td> --}}
                                        <td class="">
                                            <img src="{{ asset('storage/' . $property->img) }}" alt="property image" class="img" width="30px;" height="30px" srcset="">
                                        </td>
                                        <td>{{ $property->name }}</td>
                                        <td>
                                            {{ $property->address }}
                                        </td>
                                        <td>
                                            {{ $property->location }}
                                        </td>
                                        <td>
                                            {{ $property->area }}
                                        </td>
                                        <td>
                                            {{ $property->price }}
                                        </td>
                                        <td>
                                            {{ $property->beds }}
                                        </td>
                                        <td>
                                            {{ $property->baths }}
                                        </td>
                                        <td>
                                            {{ $property->garages }}
                                        </td>

                                        {{-- <td>
                                            @if($property->is_active)
                                                <span class="badge badge-success-lighten">Active</span>
                                            @else
                                                <span class="badge badge-danger-lighten">In Active</span>
                                            @endif
                                        </td> --}}
                                        <td>
                                            {{ $property->created_at }}
                                        </td>

                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm" wire:click="showViewModal('{{$property->id }}')"><i class="uil-eye"></i></button>
                                            <button class="btn btn-warning btn-sm" wire:click="prepareEditproperty('{{$property->id }}')"><i class="uil-edit"></i></button>
                                            <button class="btn btn-danger btn-sm" wire:click="showDeleteModal('{{$property->id }}')"><i class="uil-trash"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center my-2">No property</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <br>
                        {{ $properties->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div id="view_property_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-info">
                        <h4 class="modal-title" id="danger-header-modalLabel">properties </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-7">
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <p class="font-14">{{ $property->created_at }}</p>
                                    </div>
                                    <div class="col-12">
                                        <h2 class="font-16">{{ $property->name }}</h2>
                                    </div>
                                </div>
                            </div>
                        <div class="col-5">
                            <div class="row">
                                <div class="col">
                                    <img src="{{ asset('storage/' . $property->img ) }}" alt="property image" srcset="" width="180px">
                                </div>
                            </div>
                        </div>
                        </div>
                        <hr>
                        <div class="row">
                            <p>{{ $property->address }}</p>
                        </div>
                        <div class="row">
                            <p>{{ $property->location }}</p>
                        </div>
                        <div class="row">
                            <p>{{ $property->area }}</p>
                        </div>
                        <div class="row">
                            <p>{{ $property->price }}</p>
                        </div>
                        <div class="row">
                            <p>{{ $property->beds }}</p>
                        </div>
                        <div class="row">
                            <p>{{ $property->baths }}</p>
                        </div>
                        <div class="row">
                            <p>{{ $property->garages }}</p>
                        </div>
                        <hr>
                        <div class="row">
                            <p class="col ">Recorded by:<span class="fw-bold"> {{ $property->user->name }}</span></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <div id="delete_property_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-info">
                        <h4 class="modal-title" id="danger-header-modalLabel">Confirmation</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <h4 style="color: red">Are you sure you want to delete this property?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" wire:click="deleteproperty">Yes, Delete</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    </div>

    <script>
        // View modal
        document.addEventListener('livewire:load', function () {
            livewire.on('showViewModal', () => {
                $('#view_property_modal').modal('show')
            });
            livewire.on('closeDeleteModal', () => {
                $('#view_property_modal').modal('hide')
            });
        });

        // Delete modal
        document.addEventListener('livewire:load', function () {
            livewire.on('showDeleteModal', () => {
                $('#delete_property_modal').modal('show')
            });
            livewire.on('closeDeleteModal', () => {
                $('#delete_property_modal').modal('hide')
            });
        });

    </script>

</div>
