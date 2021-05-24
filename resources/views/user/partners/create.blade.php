<x-user-layout>
    <div class="card">
        <div class="job-search">
            <div class="card-body">
                <div class="media">
                    <img class="img-40 img-fluid m-r-20" src="{{ asset('cuba/user1/assets/images/job-search/1.jpg') }}" alt="">
                    <div class="media-body">
                        <h6 class="f-w-600"><a href="#"> {{ config('app.name') }} PARTNER PROGRAMME </a></h6>
                        <p>EntryCaptcha INC <span><i class="fa fa-star font-warning"></i><i
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
                <div class="job-description">
                    <form action="{{ route('partners.store') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Apply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
