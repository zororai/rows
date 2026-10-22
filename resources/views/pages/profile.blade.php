@extends('layouts.app')

@section('title', 'Our founder')

@section('content')
    @include('partials.page-header', [
        'eyebrow' => 'Our founder',
        'title' => 'Dr. Fatima Maruta',
        'intro' => 'Founding Director of Rose of Sharon Welfare Organisation.',
    ])

    <section class="section">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5 text-center">
                    <div class="position-sticky" style="top: 110px">
                        <img src="{{ asset('images/img-8.png') }}" class="img-fluid" style="max-width: 420px" alt="Dr. Fatima Maruta">
                        <div class="quote-card text-start mt-4">"A generous person will prosper; whoever refreshes others will be refreshed."<cite>Proverbs 11:25</cite></div>
                    </div>
                </div>
                <div class="col-lg-7 prose">
                    <h3 class="mt-0">Education</h3>
                    <p>Dr. Fatima Maruta holds several accounting qualifications, including a Bachelor's Degree in Accountancy from the University of Zimbabwe and a Masters Degree in Business Administration from Bloomsburg University, PA, USA.</p>

                    <h3>Honours &amp; awards</h3>
                    <ul class="list-check">
                        <li><strong>2014</strong> · Honorary Doctorate in Humane Letters (DHL) from the International Institute of Philanthropy, in recognition of practical application of expertise in Humanities.</li>
                        <li><strong>2016</strong> · Honorary Doctor of Arts Degree and Honorary Master of Business Leadership Degree from International Women's University.</li>
                        <li><strong>2016</strong> · Zimbabwe Top Female Academic Leader, Zimbabwe Leadership Awards.</li>
                        <li><strong>2017</strong> · Christian Leadership Excellence Lifetime Achievement Award, Christian Business and Leadership Awards.</li>
                        <li><strong>2018</strong> · Organisation of the Year special recognition in Academic Leadership Excellence.</li>
                        <li><strong>2020</strong> · Top Female Business and Community Development Leadership of the Year.</li>
                        <li><strong>2020</strong> · Honorary Doctorate of Entrepreneurship, Innovation and Maverick Leadership.</li>
                        <li><strong>2020</strong> · Philanthropic and Humanitarian Organisation of the Year, named among the Zimbabwe Top 100 business brands.</li>
                        <li><strong>2020</strong> · Honorary Doctorate Degree in Community Development, UNISA.</li>
                        <li><strong>2021</strong> · Honorary Ambassadorship, with the honour and status of Her Excellency (H.E.) Ambassador.</li>
                        <li><strong>2021</strong> · Honorary Commissionership, with the honour and status of Commissioner.</li>
                        <li><strong>2021</strong> · Honorary Doctorate of Diplomacy and International Relations (Hon. DIR).</li>
                        <li><strong>2022</strong> · Honorary Professorship in Philanthropy, Professor Emeritus honoris causa (Hon. Prof.).</li>
                    </ul>

                    <img src="{{ asset('images/org.jpg') }}" class="img-fluid mt-4" style="max-height: 160px" alt="Rose of Sharon motto">
                </div>
            </div>
        </div>
    </section>
@endsection
