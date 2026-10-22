@extends('layouts.app')

@section('title', 'Our history')

@section('content')
    @include('partials.page-header', [
        'eyebrow' => 'About us',
        'title' => 'Who is Rose of Sharon?',
        'intro' => 'A fully registered welfare organisation (PVO 3/2004), fully compliant with regulatory authorities, caring for orphaned and vulnerable children since 2004.',
    ])

    <section class="section">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-7 prose">
                    <h3 class="mt-0">Why was the organisation established?</h3>
                    <p>Rose of Sharon Welfare Organisation was established in order to provide shelter, nutrition, healthcare, education and skills training to children who are orphaned, abandoned or neglected. Our registered office is 6884 Mt. Madecheche, Zimre Park, Ruwa, Harare.</p>

                    <h3>What are our immediate results?</h3>
                    <p>Rose of Sharon is all about providing shelter, nutrition, healthcare, education and skills to children. We operate five orphanages and a High School for orphans in Harare and Ruwa respectively.</p>
                    <p>We also run a Livelihood Skills Centre where we grow horticulture products on a small scale, in order to generate income and also impart skills to orphans. We have 5 babies who are between 6 months and 5 years, 72 pre-teens of primary-going age and another 98 youths of secondary-school-going age. We also attract 80 orphans from the community through our High School initiative.</p>

                    <h3>How is Rose of Sharon governed?</h3>
                    <p>Rose of Sharon Welfare Organisation has established a credible governance framework made up of the following:</p>
                    <ul class="list-check">
                        <li>Credible professionals make up the Non-Executive Board of Trustees.</li>
                        <li>A small Secretariat made up of professionals and headed by the Founding Director oversees the day-to-day running of the organisation.</li>
                    </ul>
                    <img src="{{ asset('images/board.PNG') }}" class="img-fluid rounded-4 my-3" alt="Board of Trustees">

                    <h3>Disclaimer on political affiliation, religion and non-discrimination</h3>
                    <p>Rose of Sharon Welfare Organisation is not affiliated to any political party and Board members are not political activists. As an organisation, Rose of Sharon Welfare Organisation subscribes to the Word of God. We do not discriminate against anyone or any institution on the basis of gender, political affiliation, church affiliation or any other basis. The community is at the centre of Rose of Sharon's development efforts.</p>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex flex-column gap-4 position-sticky" style="top: 110px">
                        <div class="mv-card green">
                            <h5>Our vision</h5>
                            <p>To be a household name synonymous with the provision of quality basic necessities and life skills training for the orphans and vulnerable children in Zimbabwe.</p>
                        </div>
                        <div class="mv-card rose">
                            <h5>Our mission</h5>
                            <p>To make orphans and vulnerable children highly employable, self-reliant and competent in their knowledge application.</p>
                        </div>
                        <div class="card-soft">
                            <h4 class="text-green">Our motto</h4>
                            <img src="{{ asset('images/org.jpg') }}" class="img-fluid mt-2" alt="Rose of Sharon motto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
