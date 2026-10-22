@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    @include('partials.page-header', [
        'eyebrow' => 'Contact',
        'title' => 'Get in touch',
        'intro' => 'Whether you would like to visit, volunteer, donate or partner with us, we would love to hear from you.',
    ])

    <section class="section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card-soft">
                        <div class="icon-bubble"><i class="bi-geo-alt"></i></div>
                        <h4>Head office</h4>
                        <p>6884 Mt. Madecheche,<br>Zimre Park, Ruwa, Harare</p>
                        <a href="https://www.google.com/maps/search/?api=1&query=Zimre+Park+Ruwa+Zimbabwe" target="_blank" rel="noopener" class="link-arrow mt-3">Get directions <i class="bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-soft">
                        <div class="icon-bubble rose"><i class="bi-telephone"></i></div>
                        <h4>Call us</h4>
                        <p>HR &amp; Office Manager</p>
                        <a href="tel:+263772490478" class="link-arrow mt-3">+263 772 490 478</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-soft">
                        <div class="icon-bubble"><i class="bi-envelope"></i></div>
                        <h4>Email us</h4>
                        <p>We aim to respond within a few working days.</p>
                        <a href="mailto:fbmaruta@yahoo.com" class="link-arrow mt-3">fbmaruta@yahoo.com</a>
                    </div>
                </div>
            </div>

            <div class="img-frame mt-5" style="aspect-ratio: 21 / 8">
                <iframe title="Map of Zimre Park, Ruwa" src="https://www.google.com/maps?q=Zimre+Park,+Ruwa,+Zimbabwe&output=embed" style="border:0; width:100%; height:100%" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
@endsection
