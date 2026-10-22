@extends('layouts.app')

@section('title', 'Donate')

@section('content')
    @include('partials.page-header', [
        'eyebrow' => 'Donate',
        'title' => 'Give a child a future',
        'intro' => 'Every gift goes towards shelter, food, healthcare, education and skills for the children in our care. A qualified Accountant manages every transaction for full transparency.',
    ])

    <section class="section">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="img-frame bg-white"><img src="{{ asset('images/dona.png') }}" alt="How to donate to Rose of Sharon" style="object-fit: contain"></div>
                </div>
                <div class="col-lg-6">
                    <span class="eyebrow">Ways to help</span>
                    <h2 class="section-title">Your generosity changes lives</h2>
                    <ul class="list-check lead-2">
                        <li>Sponsor a child's school fees at our High School</li>
                        <li>Help feed our children through our Livelihood Skills Centre</li>
                        <li>Fund permanent buildings on our 200-acre campus</li>
                        <li>Donate clothes, books and household goods</li>
                    </ul>
                    <p class="text-muted-2">For bank details or to arrange an in-kind donation, please contact us.</p>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="tel:+263772490478" class="btn-rose"><i class="bi-telephone"></i> +263 772 490 478</a>
                        <a href="mailto:fbmaruta@yahoo.com" class="btn-outline-green"><i class="bi-envelope"></i> Email us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
