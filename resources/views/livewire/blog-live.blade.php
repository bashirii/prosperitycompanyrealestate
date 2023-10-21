<div>
    <div>
        <div class="row">

            @if($viewForm)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header ">
                            Add blog
                            <button class="btn btn-warning btn-sm  float-end" wire:click="closeForm"><i class="uil-cancel"></i> Cancel</button>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <label for="image" class="form-label font-12">Image <span class="required">*</span></label>
                                <input type="file" wire:model="file" id="image" accept="image/*" class="form-control form-control-sm">
                                @error('file') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-2">
                                <label for="preview_desc" class="form-label">Description <span class="required">*</span></label>
                                <textarea wire:model="preview_desc" id="preview_desc" class="form-control form-control-sm"cols="30" rows="5"></textarea>
                                @error('preview_desc') <span class="error">{{ $message }}</span> @enderror
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
                         blog
                        <button class="btn btn-primary btn-sm  float-end" wire:click="showForm"><i class="uil-plus"></i> Add blog</button>
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
                                    <th>Date</th>
                                    <th>Description</th>
                                    {{-- <th>Status</th> --}}
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                @forelse($blogs as $key => $blog)
                                    <tr>
                                        <td>{{ $i + 1 }}</td> {{-- changed from this<td>{{ $key+1 }}</td> --}}
                                        <td class="">

                                        <img src="{{ asset('storage/' . $blog->img) }}" alt="blog image" class="img" width="30px;" height="30px" srcset="">

                                        </td>

                                        <td>{{ $blog->created_at->format('Y-m-d') }}</td>

                                        <td>{{ Str::limit($blog->preview_desc, 20) }}</td>

                                        {{-- <td>
                                            <button class="btn btn-primary btn-sm" wire:click="Active_Inactive('{{ $blog->id }}')"><i class="uil-eye"></i> >
                                                @if($blog->is_active)
                                                    <span class="badge badge-success-lighten">Active</span>
                                                @else
                                                    <span class="badge badge-danger-lighten">In Active</span>
                                                @endif
                                            </button>
                                        </td> --}}
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm" wire:click="showViewModal('{{$blog->id }}')"><i class="uil-eye"></i></button>
                                            <button class="btn btn-warning btn-sm" wire:click="prepareEditblog('{{$blog->id }}')"><i class="uil-edit"></i></button>
                                            <button class="btn btn-danger btn-sm" wire:click="showDeleteModal('{{$blog->id }}')"><i class="uil-trash"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center my-2">No blog</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <br>
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div id="view_blog_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-info">
                        <h4 class="modal-title" id="danger-header-modalLabel">blogs </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-7">
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <p class="font-14">{{ $blog->created_at }}</p>
                                    </div>
                                </div>
                            </div>
                        <div class="col-5">
                            <div class="row">
                                <div class="col">
                                    <img src="{{ asset('storage/' . $blog->img ) }}" alt="blog image" srcset="" width="180px">
                                </div>
                            </div>
                        </div>
                        </div>
                        <hr>
                        <div class="row">
                            <p>{{ $blog->preview_desc }}</p>
                        </div>
                        <hr>
                        {{-- <div class="row">
                            <p class="col ">Recorded by:<span class="fw-bold"> {{ $blog->user->name }}</span></p>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <div id="delete_blog_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-info">
                        <h4 class="modal-title" id="danger-header-modalLabel">Confirmation</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <h4 style="color: red">Are you sure you want to delete this blog?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" wire:click="deleteblog">Yes, Delete</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    </div>

    <script>
        // View modal
        document.addEventListener('livewire:load', function () {
            livewire.on('showViewModal', () => {
                $('#view_blog_modal').modal('show')
            });
            livewire.on('closeDeleteModal', () => {
                $('#view_blog_modal').modal('hide')
            });
        });

        // Delete modal
        document.addEventListener('livewire:load', function () {
            livewire.on('showDeleteModal', () => {
                $('#delete_blog_modal').modal('show')
            });
            livewire.on('closeDeleteModal', () => {
                $('#delete_blog_modal').modal('hide')
            });
        });

    </script>

</div>
