@extends('layouts.app')

@section('title', 'Our school')

@section('content')
    @include('partials.page-header', [
        'eyebrow' => 'About us',
        'title' => 'Rose of Sharon High School',
        'intro' => 'A Christian day and boarding school, established in 2006, giving every learner quality access to education.',
    ])

    <section class="section">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 prose">
                    <p class="lead-2">Rose of Sharon High School was established in 2006 with the vision to help the needy, so that children have quality and quick access to educational resources without any hassle.</p>
                    <p>Ours is a mixed school where boys and girls learn together. It is a Christian day and boarding school that is growing such that enrolment increases every term. Among the school staff is a team of qualified counsellors who look after the social and psychological needs of learners.</p>
                    <p>The school offers co-curricular activities such as athletics, drama, debate and major ball games. The school has a committed and hard-working staff. School starts at 7am and ends at 4pm.</p>
                    <h3>School motto</h3>
                    <img src="{{ asset('images/moto.png') }}" class="img-fluid" style="max-height: 160px" alt="School motto">
                    <div class="mt-4">
                        <a href="https://www.roshs.co.zw" class="btn-green" target="_blank" rel="noopener">Visit the school website <i class="bi-box-arrow-up-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="img-frame mb-4"><img src="{{ asset('images/hero4.jpg') }}" alt="Rose of Sharon High School"></div>
                    <div class="quote-card">
                        Then Rose of Sharon High School will know that He is the Lord God who lives in Zion, His holy mountain. Rose of Sharon High School will remain forever, foreign mountains will drip with sweet wine and the hills will flow with milk; water will fill the streambeds of Rose of Sharon High School and a fountain will burst forth from the Lord's temple, watering its arid valleys. Rose of Sharon High School will endure through all future generations.
                        <cite>School declaration</cite>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
