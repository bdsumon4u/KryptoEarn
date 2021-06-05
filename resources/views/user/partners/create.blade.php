<x-user-layout>
    <div class="card">
        <div class="job-search">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="media">
                            <img class="img-40 img-fluid m-r-20" src="{{ asset('cuba/user1/assets/images/job-search/1.jpg') }}" alt="">
                            <div class="media-body">
                                <h6 class="f-w-600"><a href="#"> {{ config('app.name') }} PARTNER PROGRAMME </a></h6>
                                <p>{{ config('app.name') }} INC <span><i class="fa fa-star font-warning"></i><i
                                            class="fa fa-star font-warning"></i><i
                                            class="fa fa-star font-warning"></i><i
                                            class="fa fa-star font-warning"></i><i class="fa fa-star font-warning"></i></span>
                                </p>
                            </div>
                        </div>
                        <div class="job-description"><h6>Partner Responsibilities</h6>
                            <ul>
                                <li>Marketing the company through various channels.</li>
                                <li>Selling voucher codes.</li>
                                <li>Offering assistance to users.</li>
                            </ul>
                        </div>
                        <div class="job-description"><h6>Qualifications </h6>
                            <ul>
                                <li>You should be subscribed to a package.</li>
                                <li>You should have more than 10 referrals.</li>
                                <li>You should have a large social media presence.</li>
                            </ul>
                        </div>
                        <div class="job-description"><h6>Perks</h6>
                            <ul>
                                <li>Competitive pay.</li>
                                <li>Earn a {{ config('others.voucher_selling_commission', 15) }}% commission from selling voucher codes.</li>
                                <li>Periodic bonuses based on performance.</li>
                                <li>Priority customer support.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="job-description border p-3">
                            @php($user = request()->user())
                            <x-validation-errors />
                            <form action="{{ route('partners.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="city">City</label>
                                            <input type="text" name="city" id="city" value="{{ old('city', $user->city) }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="road-no">Road No</label>
                                            <input type="text" name="road_no" id="road-no" value="{{ old('road_no', $user->road_no) }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="postal-code">Postal Code</label>
                                            <input type="text" name="postal_code" id="postal-code" value="{{ old('postal_code', $user->postal_code) }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="language">Language</label>
                                            <input type="text" name="language" id="language" value="{{ old('language', $user->language) }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="address">Street Address</label>
                                            <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}"address class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Apply</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
