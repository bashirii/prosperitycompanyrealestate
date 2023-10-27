<div>
    <div>
        <div class="row">

            @if($viewForm)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header ">
                            Add Agent
                            <button class="btn btn-warning btn-sm  float-end" wire:click="closeForm"><i class="uil-cancel"></i> Cancel</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="name" class="form-label font-12">agent Name <span class="required">*</span></label>
                                    <input type="text" wire:model="name" id="name" class="form-control form-control-sm">
                                    @error('name') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="image" class="form-label font-12">Image <span class="required">*</span></label>
                                    <input type="file" wire:model="file" id="image" accept="image/*" class="form-control form-control-sm">
                                    @error('file') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="phone" class="form-label font-12">Phone No:<span class="required">*</span></label>
                                    <input type="text" wire:model="phone" id="phone" class="form-control form-control-sm">
                                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="email" class="form-label font-12">Email<span class="required">*</span></label>
                                    <input type="email" wire:model="email" id="email" class="form-control form-control-sm">
                                    @error('email') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="description" class="form-label font-12">Discription<span class="required">*</span></label>
                                    <textarea wire:model="description" id="description" class="form-control form-control-sm"cols="30" rows="5"></textarea>
                                    @error('description') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class=" col-md-6 mb-2">
                                    <label class="form-label">Social Links</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Facebook</span>
                                        <input type="text" class="form-control" wire:model="facebook_link">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Twitter</span>
                                        <input type="text" class="form-control" wire:model="twitter_link">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Instagram</span>
                                        <input type="text" class="form-control" wire:model="instagram_link">
                                    </div>
                                </div>
                            </div>
                            
                            {{-- <div class="mb-2">
                                <label for="destination_id" class="form-label">Destination<span class="required">*</span></label>
                                <select class="form-control" wire:model="destination_id" id="destination_id">
                                    <option value="">Select Destination</option>
                                    @foreach($destinations as $destination)
                                        <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                                    @endforeach
                                </select>
                                @error('destination_id') <span class="error">{{ $message }}</span> @enderror
                            </div> --}}

                            

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
                         Agent
                        <button class="btn btn-primary btn-sm  float-end" wire:click="showForm"><i class="uil-plus"></i> Add agent</button>
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
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Descripiton</th>
                                    {{-- <th>Facebook</th> --}}
                                    {{-- <th>Twitter</th> --}}
                                    {{-- <th>Linkedin</th> --}}
                                    {{-- <th>Instagram</th> --}}
                                    {{-- <th>Status</th> --}}
                                    <th>Created At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                @forelse($team as $key => $agent)
                                    <tr>
                                        <td>{{ $i++ }}</td> {{-- changed from this<td>{{ $key+1 }}</td> --}}
                                        <td class="">

                                                <img src="{{ asset('storage/' . $agent->img) }}" alt="agent image" class="img" width="30px;" height="30px" srcset="">

                                        </td>

                                        <td>{{ $agent->name }}</td>

                                        <td>{{ $agent->phone }}</td>

                                        <td>{{ $agent->email }}</td>

                                        <td>{{ Str::limit($agent->description, 10) }}</td>

                                        <!-- Add columns for social links here -->
                                        {{-- <td>{{ $agent->facebook_link  }}</td> --}}
                                        {{-- <td>{{ $agent->twitter_link  }}</td> --}}
                                        {{-- <td>{{ $agent->linkedin_link  }}</td> --}}
                                        {{-- <td>{{ $agent->instagram_link  }}</td> --}}
                                        {{-- <td>
                                            @if($agent->is_active)
                                                <span class="badge badge-success-lighten">Active</span>
                                            @else
                                                <span class="badge badge-danger-lighten">In Active</span>
                                            @endif
                                        </td> --}}
                                        <td>

                                            {{ $agent->created_at->format('d-m-Y') }}

                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm" wire:click="showViewModal('{{$agent->id }}')" data-bs-toggle="modal" data-bs-target="#view_agent_modal"><i class="uil-eye"></i></button>
                                            <button class="btn btn-warning btn-sm" wire:click="prepareEditAgent('{{$agent->id }}')"><i class="uil-edit"></i></button>
                                            <button class="btn btn-danger btn-sm" wire:click="showDeleteModal('{{$agent->id }}')" data-bs-toggle="modal" data-bs-target="#delete_agent_modal"><i class="uil-trash"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center my-2">No agent</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <br>
                        {{ $team->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div id="view_agent_modal" wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-info">
                        <h4 class="modal-title" id="danger-header-modalLabel">Agent </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-7">
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <p class="font-14">{{ $agent->created_at }}</p>
                                    </div>
                                    <div class="col-12">
                                        <h2 class="font-16">{{ $agent->name }}</h2>
                                    </div>
                                </div>
                            </div>
                        <div class="col-5">
                            <div class="row">
                                <div class="col">
                                    <img src="{{ asset('storage/' . $agent->img ) }}" alt="agent image" width="180px" height="180px" style="object-fit: cover;">
                                </div>
                            </div>
                        </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <p>{{ $agent->phone }}</p>
                            </div>
                            <div class="col">
                                <p>{{ $agent->email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <p><b>Facebook:</b> {{ $agent->facebook_link  }}</p>
                            <p><b>Twitter:</b> {{ $agent->twitter_link  }}</p>
                            <p><b>Instagram:</b> {{ $agent->instagram_link  }}</p>
                            <p><b>Linkedin:</b> {{ $agent->linkedin_link  }}</p>
                        </div>
                        <hr>
                        <div class="row">
                            <p class="col ">Recorded by:<span class="fw-bold"> {{ optional($agent->user)->name }}</span></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <div id="delete_agent_modal" wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-info">
                        <h4 class="modal-title" id="danger-header-modalLabel">Confirmation</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <h4 style="color: red">Are you sure you want to delete this agent?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" wire:click="deleteAgent" data-bs-dismiss="modal">Yes, Delete</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    </div>

    <script>
        // View modal
        document.addEventListener('livewire:load', function () {
            livewire.on('showViewModal', () => {
                $('#view_agent_modal').modal('show')
            });
            livewire.on('closeDeleteModal', () => {
                $('#view_agent_modal').modal('hide')
            });
        });

        // Delete modal
        document.addEventListener('livewire:load', function () {
            livewire.on('showDeleteModal', () => {
                $('#delete_agent_modal').modal('show')
            });
            livewire.on('closeDeleteModal', () => {
                $('#delete_agent_modal').modal('hide')
            });
        });

    </script>

</div>
