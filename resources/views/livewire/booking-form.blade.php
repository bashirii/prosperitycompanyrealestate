<div wire:ignore.self>

    <!-- Header Start -->
    <div wire:ignore.self class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Destination</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="{{ route('index') }}">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Destination</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Destination Start -->
    <div wire:ignore.self class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Destination</h6>
                <h1>Explore Top Destination</h1>
            </div>
            <div class="row">
                @foreach ($destinations as $destination)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="destination-item position-relative overflow-hidden mb-2">
                        <img class="img-fluid" src="{{ asset('storage/'.$destination->img) }}" alt="">
                        <a class="destination-overlay text-white text-decoration-none" href="">
                            <h5 class="text-white">{{ $destination->name }}</h5>
                            <span class="text-dark glowing-text">{{ $destination->preview_desc }}</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Destination Start -->

    <!-- Booking Start -->
    <div wire:ignore.self class="container-fluid booking mt-5 pb-5">
        <div class="container">
            <div class="bg-light shadow p-4">
                <div class="row align-items-center" style="min-height: 60px;">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-8">
                                @if (session()->has('booked'))
                                    <script>
                                        swal({
                                                title: "",
                                                text: "{{ session('booked') }}",
                                                icon: "success",
                                                button: "OK",
                                            });
                                    </script>
                                @endif
                                @if (session()->has('not-booked'))
                                    <script>
                                        swal({
                                                title: "",
                                                text: "{{ session('not-booked') }}",
                                                icon: "error",
                                                button: "OK",
                                            });
                                    </script>
                                @endif
                                <form wire:ignore.self id="booking" class="booking-form" enctype="multipart/form-data" wire:submit.prevent="saveBooking" novalidate="novalidate">
                                    @csrf
                                    <input type="hidden" name="form_id" value="1">

                                    <!-- Section 1: User Details -->
                                    <fieldset class="booking-fieldset">
                                        <legend>Please Provide Your Details</legend>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="vfb-11-first">First Name <span class="required">*</span></label>
                                                <input type="text" wire:model="first_name" id="vfb-11-first" class="form-control required">
                                                @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="vfb-11-last">Last Name <span class="required">*</span></label>
                                                <input type="text" wire:model="last_name" id="vfb-11-last" class="form-control required">
                                                @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="vfb-12">Email <span class="required">*</span></label>
                                            <input type="email" wire:model="email" id="vfb-12" class="form-control required email">
                                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="vfb-13">Phone <span class="required">*</span></label>
                                            <input type="tel" wire:model="phone" id="vfb-13" class="form-control required phone">
                                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="vfb-14">City</label>
                                                <input type="text" wire:model="city" id="vfb-14" class="form-control">
                                                @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="vfb-15">Country <span class="required">*</span></label>
                                                <input type="text" wire:model="country" id="vfb-15" class="form-control required">
                                                @error('country') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </fieldset>

                                    <!-- Section 2: Plan Your Trip -->
                                    <fieldset class="booking-fieldset">
                                        <legend>Plan Your Trip</legend>
                                        <div class="date form-group" id="date1" data-target-input="nearest">
                                            <input type="date" wire:model="travel_date_from" class="form-control p-4 datetimepicker-input required" placeholder="Travel Date From*" data-target="#date1" data-toggle="datetimepicker"/>
                                            @error('travel_date_from') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="date form-group" id="date2" data-target-input="nearest">
                                            <input type="date" wire:model="travel_date_to" class="form-control p-4 datetimepicker-input required" placeholder="Travel Dates To*" data-target="#date2" data-toggle="datetimepicker"/>
                                            @error('travel_date_to') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="vfb-19">Number of People <span class="required">*</span></label>
                                            <input type="text" wire:model="no_people" name="vfb-19" id="vfb-19" class="form-control required">
                                            @error('no_people') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="vfb-20">Number of Children(if any)</label>
                                            <input type="text" wire:model="no_children" name="vfb-20" id="vfb-20" class="form-control">
                                            @error('no_children') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        {{-- <div class="form-group">
                                            <label>Select Room Type <span class="required">*</span></label>
                                            <div>
                                                <span class="vfb-span">
                                                    <input type="checkbox" name="vfb-1090[]" id="vfb-1090-0" value="Single" class="vfb-checkbox  required " wfd-id="id13">
                                                    <label for="vfb-1090-0" class="vfb-choice">Single</label>
                                                </span><span class="vfb-span">
                                                    <input type="checkbox" name="vfb-1090[]" id="vfb-1090-1" value="Double" class="vfb-checkbox  required " wfd-id="id14">
                                                    <label for="vfb-1090-1" class="vfb-choice">Double</label>
                                                </span>
                                                <span class="vfb-span">
                                                    <input type="checkbox" name="vfb-1090[]" id="vfb-1090-2" value="Twin" class="vfb-checkbox  required " wfd-id="id15">
                                                    <label for="vfb-1090-2" class="vfb-choice">Twin</label>
                                                </span>
                                                <span class="vfb-span">
                                                    <input type="checkbox" name="vfb-1090[]" id="vfb-1090-3" value="Triple" class="vfb-checkbox  required " wfd-id="id16">
                                                    <label for="vfb-1090-3" class="vfb-choice">Triple</label>
                                                </span>
                                                <div style="clear:both;">
                                                </div>
                                            </div>
                                        </div> --}}
                                    </fieldset>

                                    <!-- Section 3: Destinations -->
                                    <fieldset class="booking-fieldset">
                                        <legend>What are the destinations of your choice?</legend>
                                        <div class="form-group">
                                            <label for="destinationSelect" class="form-label">Tanzania Destination:</label>
                                            <select class="custom-select" wire:model="destination_id" id="destinationSelect">
                                                <option selected>Choose Destination</option>
                                                @foreach ($destinations as $destination)
                                                    <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('destination_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="vfb-23">Tell Us More</label>
                                            <textarea name="vfb-23" wire:model="more_info" id="vfb-23" class="form-control"></textarea>
                                            @error('more_info') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </fieldset>

                                    <input type="hidden" name="_wp_http_referer" value="/enquiry/">
                            </div>
                        </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-block" type="submit" style="height: 47px; margin-top: -2px;">Submit</button>
                    </div>
                </form>

                    </div>
                </div>
            </div>
        </div>
    </div>>
    <!-- Booking End -->

</div>
