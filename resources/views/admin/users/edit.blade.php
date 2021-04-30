<x-admin-layout>
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-5 col-md-5 mb-30">

            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body p-0">
                    <div class="p-3 bg--white">
                        <div class="">
                            <img src="{{ $user->profile_photo_url }}" alt="profile-image" class="b-radius--10 w-100">
                        </div>
                        <div class="mt-2">
                            <h4 class="">{{ $user->name }}</h4>
                            <span class="text--small">Joined At <strong>{{ $user->created_at->format('d-M-Y H:i A') }}</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-7 col-md-7 mb-30">

            <div class="row mb-none-30">
                <x-pocket-balances :user="$user" />
            </div>


            <div class="card mt-50">
                <div class="card-body">
                    <x-validation-errors />
                    <h5 class="card-title mb-50 border-bottom pb-2">{{ $user->username }}'s Information</h5>

                    <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-control-label font-weight-bold">Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" value="{{ old('name', $user->name) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-control-label  font-weight-bold">Phone Number<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="phone" value="{{ old('phone', $user->phone) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-control-label font-weight-bold">Email <span class="text-danger">*</span></label>
                                    <input class="form-control" type="email" name="email" value="{{ old('email', $user->email) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-control-label font-weight-bold">Address </label>
                                    <input class="form-control" type="text" name="address" value="{{ old('address', $user->address) }}">
                                    <small class="form-text text-muted"><i class="las la-info-circle"></i> House number,
                                        street address </small>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="mb-3">
                                    <label class="form-control-label font-weight-bold">City </label>
                                    <input class="form-control" type="text" name="city" value="{{ old('city', $user->city) }}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="mb-3">
                                    <label class="form-control-label font-weight-bold">Country </label>
                                    <input class="form-control" type="text" name="country" value="{{ old('country', $user->country) }}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="mb-3">
                                    <label class="form-control-label font-weight-bold">Timezone</label>
                                    <input class="form-control" type="text" name="timezone" value="{{ old('timezone', $user->timezone) }}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="mb-3">
                                    <label class="form-control-label font-weight-bold">Package</label>
                                    <input class="form-control" type="text" name="package" value="{{ old('package', $user->membership->plan->name) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100 btn-lg">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
