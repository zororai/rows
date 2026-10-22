@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    @include('partials.page-header', [
        'eyebrow' => 'Projects',
        'title' => 'Our projects',
        'intro' => 'We embark on livelihood skills projects from time to time, including horticulture, poultry and peanut-butter making. Right now the children are eating vegetables and potatoes they grew themselves.',
    ])

    <section class="section">
        <div class="container">
            <div class="row g-4 mb-5">
                @foreach ([
                    ['images/farming.png', 'Farming activities'],
                    ['images/hot.png', 'Horticulture'],
                    ['images/dovi.png', 'Peanut-butter making'],
                    ['images/mai.png', 'Maize farming'],
                    ['images/chicken.png', 'Poultry'],
                ] as [$img, $title])
                    <div class="col-sm-6 {{ $loop->first ? 'col-lg-12' : 'col-lg-3' }}">
                        <div class="home-card" style="aspect-ratio: {{ $loop->first ? '21 / 8' : '4 / 5' }}">
                            <img src="{{ asset($img) }}" alt="{{ $title }}" loading="lazy">
                            <div class="home-card-body"><h4>{{ $title }}</h4></div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-6 col-lg-3">
                    <div class="card-soft">
                        <div class="icon-bubble"><i class="bi-shield-check"></i></div>
                        <h4>Who manages our finances?</h4>
                        <p>A qualified Accountant manages every bank transaction, ensuring transparency and greater accountability to both donors and beneficiaries.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card-soft">
                        <div class="icon-bubble rose"><i class="bi-calendar-check"></i></div>
                        <h4>Phase 1: current projects (2004 to 2023)</h4>
                        <p>Expenditure towards the running costs of our orphanages, Livelihood Skills Centre and High School.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card-soft">
                        <div class="icon-bubble"><i class="bi-building"></i></div>
                        <h4>Phase 2: priority infrastructure (2023 to 2025)</h4>
                        <p>We are seeking a sustainable financing strategy to build permanent structures on 200 acres of land. A clean title deed, electricity and two boreholes are available.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card-soft">
                        <div class="icon-bubble rose"><i class="bi-stars"></i></div>
                        <h4>Our core values</h4>
                        <p>Integrity and fear of God · Gender equity · Transformational change · Equal opportunity · Transparency and accountability · Teamwork · Quality · Respect for individuals · Technology · Scripture-based democratic culture</p>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-6">
                    <h3 class="h4 mb-3">Beneficiary institutions and infrastructure</h3>
                    <div class="img-frame bg-white"><img src="{{ asset('images/progress.png') }}" alt="Beneficiary institution and type of infrastructure" style="object-fit: contain"></div>
                </div>
                <div class="col-lg-6">
                    <h3 class="h4 mb-3">Project milestones (2006 to 2022)</h3>
                    <div class="img-frame bg-white"><img src="{{ asset('images/mile.png') }}" alt="Project milestones" style="object-fit: contain"></div>
                </div>
            </div>
        </div>
    </section>
@endsection
