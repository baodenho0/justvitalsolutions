<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-5">
                <h4 class="uppercase">{{ $section->title }}</h4>
                <p>{{ $section->subtitle }}</p>
                <hr>
                <div class="mb40">
                    {!! $section->content !!}
                </div>
                <div class="mb40">
                    @php
                        $contactInfo = ($section->extra_data);
                    @endphp

                    @if(isset($contactInfo['address']))
                    <p>{{ $contactInfo['address'] }}</p>
                    @endif

                    @if(isset($contactInfo['phone']))
                    <p>{{ $contactInfo['phone'] }}</p>
                    @endif

                    @if(isset($contactInfo['email']))
                    <p><a href="mailto:{{ $contactInfo['email'] }}">{{ $contactInfo['email'] }}</a></p>
                    @endif
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-md-offset-1">
                <form class="form-email" data-success="Thanks for your submission, we will be in touch shortly." data-error="Please fill all fields correctly.">
                    <input type="text" class="validate-required" name="name" placeholder="Your Name" />
                    <input type="text" class="validate-required validate-email" name="email" placeholder="Email Address" />
                    <textarea class="validate-required" name="message" rows="4" placeholder="Message"></textarea>
                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>
