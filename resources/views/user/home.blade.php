@extends('user/app')

@section('main_content')
  <section id="athmo-home" data-section="home" style="background-image: url({{asset('user/images/full_image_2.jpg')}});" data-stellar-background-ratio="0.5">
    <div class="gradient"></div>
    <div class="container">
      <div class="text-wrap">
        <div class="text-inner">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h1 class="to-animate">Athmonitor</h1>
              <h2 class="to-animate">Athmonitor for monitoring athlete</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="slant"></div>
  </section>

  <section id="athmo-intro">
    <div class="container">
      <div class="row row-bottom-padded-lg">
        <div class="athmo-block to-animate" style="background-image: url({{asset('user/images/img_7.jpg')}});">
          <div class="overlay-darker"></div>
          <div class="overlay"></div>
          <div class="athmo-text">
            <i class="athmo-intro-icon icon-bulb"></i>
            <h2>Plan</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            <p><a href="#" class="btn btn-primary">Get In Touch</a></p>
          </div>
        </div>
        <div class="athmo-block to-animate" style="background-image: url({{asset('user/images/img_8.jpg')}});">
          <div class="overlay-darker"></div>
          <div class="overlay"></div>
          <div class="athmo-text">
            <i class="athmo-intro-icon icon-wrench"></i>
            <h2>Develop</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            <p><a href="#" class="btn btn-primary">Click Me</a></p>
          </div>
        </div>
        <div class="athmo-block to-animate" style="background-image: url({{asset('user/images/img_10.jpg')}});">
          <div class="overlay-darker"></div>
          <div class="overlay"></div>
          <div class="athmo-text">
            <i class="athmo-intro-icon icon-rocket"></i>
            <h2>Launch</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            <p><a href="#" class="btn btn-primary">Why Us?</a></p>
          </div>
        </div>
      </div>
      <div class="row watch-video text-center to-animate">
        <span>Watch the video</span>

        <a href="https://vimeo.com/channels/staffpicks/93951774" class="popup-vimeo btn-video"><i class="icon-play2"></i></a>
      </div>
    </div>
  </section>

  <section id="athmo-work" data-section="work">
    <div class="container">
      <div class="row">
        <div class="col-md-12 section-heading text-center">
          <h2 class="to-animate">Work</h2>
          <div class="row">
            <div class="col-md-8 col-md-offset-2 subtext to-animate">
              <h3>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="row row-bottom-padded-sm">
        <div class="col-md-4 col-sm-6 col-xxs-12">
          <a href="{{asset('user/images/work_1.jpg')}}" class="athmo-project-item image-popup to-animate">
            <img src="{{asset('user/images/work_1.jpg')}}" alt="Image" class="img-responsive">
            <div class="athmo-text">
            <h2>Project 1</h2>
            <span>Branding</span>
            </div>
          </a>
        </div>
        <div class="col-md-4 col-sm-6 col-xxs-12">
          <a href="{{asset('user/images/work_2.jpg')}}" class="athmo-project-item image-popup to-animate">
            <img src="{{asset('user/images/work_2.jpg')}}" alt="Image" class="img-responsive">
            <div class="athmo-text">
            <h2>Project 2</h2>
            <span>Web</span>
            </div>
          </a>
        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xxs-12">
          <a href="{{asset('user/images/work_3.jpg')}}" class="athmo-project-item image-popup to-animate">
            <img src="{{asset('user/images/work_3.jpg')}}" alt="Image" class="img-responsive">
            <div class="athmo-text">
            <h2>Project 3</h2>
            <span>Web</span>
            </div>
          </a>
        </div>
        <div class="col-md-4 col-sm-6 col-xxs-12">
          <a href="{{asset('user/images/work_4.jpg')}}" class="athmo-project-item image-popup to-animate">
            <img src="{{asset('user/images/work_4.jpg')}}" alt="Image" class="img-responsive">
            <div class="athmo-text">
            <h2>Project 4</h2>
            <span>UI/UX</span>
            </div>
          </a>
        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xxs-12">
          <a href="{{asset('user/images/work_5.jpg')}}" class="athmo-project-item image-popup to-animate">
            <img src="{{asset('user/images/work_5.jpg')}}" alt="Image" class="img-responsive">
            <div class="athmo-text">
            <h2>Project 1</h2>
            <span>Photography</span>
            </div>
          </a>
        </div>
        <div class="col-md-4 col-sm-6 col-xxs-12">
          <a href="{{asset('user/images/work_6.jpg')}}" class="athmo-project-item image-popup to-animate">
            <img src="{{asset('user/images/work_6.jpg')}}" alt="Image" class="img-responsive">
            <div class="athmo-text">
            <h2>Project 2</h2>
            <span>Illustration</span>
            </div>
          </a>
        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xxs-12">
          <a href="{{asset('user/images/work_7.jpg')}}" class="athmo-project-item image-popup to-animate">
            <img src="{{asset('user/images/work_7.jpg')}}" alt="Image" class="img-responsive">
            <div class="athmo-text">
            <h2>Project 3</h2>
            <span>Web</span>
            </div>
          </a>
        </div>
        <div class="col-md-4 col-sm-6 col-xxs-12">
          <a href="{{asset('user/images/work_8.jpg')}}" class="athmo-project-item image-popup to-animate">
            <img src="{{asset('user/images/work_8.jpg')}}" alt="Image" class="img-responsive">
            <div class="athmo-text">
            <h2>Project 4</h2>
            <span>Sketch</span>
            </div>
          </a>
        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xxs-12">
          <a href="{{asset('user/images/work_1.jpg')}}" class="athmo-project-item image-popup to-animate">
            <img src="{{asset('user/images/work_1.jpg')}}" alt="Image" class="img-responsive">
            <div class="athmo-text">
            <h2>Project 2</h2>
            <span>Illustration</span>
            </div>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center to-animate">
          <p>* Colaborate <a href="http://athmonitor.com/" target="_blank">suitdevelopers.com</a></p>
        </div>
      </div>
    </div>
  </section>

  <section id="athmo-testimonials" data-section="testimonials">
    <div class="container">
      <div class="row">
        <div class="col-md-12 section-heading text-center">
          <h2 class="to-animate">Testimonials</h2>
          <div class="row">
            <div class="col-md-8 col-md-offset-2 subtext to-animate">
              <h3>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="box-testimony">
            <blockquote class="to-animate-2">
              <p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
            </blockquote>
            <div class="author to-animate">
              <figure><img src="{{asset('user/images/person1.jpg')}}" alt="Person"></figure>
              <p>
              Jean Doe, CEO <a href="http://freehtml5.co/" target="_blank">FREEHTML5.co</a> <span class="subtext">Creative Director</span>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box-testimony">
            <blockquote class="to-animate-2">
              <p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.&rdquo;</p>
            </blockquote>
            <div class="author to-animate">
              <figure><img src="{{asset('user/images/person2.jpg')}}" alt="Person"></figure>
              <p>
              John Doe, Senior UI <a href="http://freehtml5.co/" target="_blank">FREEHTML5.co</a> <span class="subtext">Creative Director</span>
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="box-testimony">
            <blockquote class="to-animate-2">
              <p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. &rdquo;</p>
            </blockquote>
            <div class="author to-animate">
              <figure><img src="{{asset('user/images/person3.jpg')}}" alt="Person"></figure>
              <p>
              Chris Nash, Director <a href="http://freehtml5.co/" target="_blank">FREEHTML5.co</a> <span class="subtext">Creative Director</span>
              </p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section id="athmo-services" data-section="services">
    <div class="container">
      <div class="row">
        <div class="col-md-12 section-heading text-left">
          <h2 class=" left-border to-animate">Services</h2>
          <div class="row">
            <div class="col-md-8 subtext to-animate">
              <h3>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-sm-6 athmo-service to-animate">
          <i class="icon to-animate-2 icon-anchor"></i>
          <h3>Brand &amp; Strategy</h3>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean</p>
        </div>
        <div class="col-md-6 col-sm-6 athmo-service to-animate">
          <i class="icon to-animate-2 icon-layers2"></i>
          <h3>Web &amp; Interface</h3>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean</p>
        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-6 col-sm-6 athmo-service to-animate">
          <i class="icon to-animate-2 icon-video2"></i>
          <h3>Photo &amp; Video</h3>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean</p>
        </div>
        <div class="col-md-6 col-sm-6 athmo-service to-animate">
          <i class="icon to-animate-2 icon-monitor"></i>
          <h3>CMS &amp; eCommerce</h3>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean</p>
        </div>

      </div>
    </div>
  </section>

  <section id="athmo-about" data-section="about">
    <div class="container">
      <div class="row">
        <div class="col-md-12 section-heading text-center">
          <h2 class="to-animate">About</h2>
          <div class="row">
            <div class="col-md-8 col-md-offset-2 subtext to-animate">
              <h3>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="athmo-person text-center to-animate">
            <figure><img src="{{asset('user/images/person1.jpg')}}" alt="Image"></figure>
            <h3>Jean Smith</h3>
            <span class="athmo-position">Web Designer</span>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts</p>
            <ul class="social social-circle">
              <li><a href="#"><i class="icon-twitter"></i></a></li>
              <li><a href="#"><i class="icon-facebook"></i></a></li>
              <li><a href="#"><i class="icon-dribbble"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-4">
          <div class="athmo-person text-center to-animate">
            <figure><img src="{{asset('user/images/person2.jpg')}}" alt="Image"></figure>
            <h3>Rob Smith</h3>
            <span class="athmo-position">Web Developer</span>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts</p>
            <ul class="social social-circle">
              <li><a href="#"><i class="icon-twitter"></i></a></li>
              <li><a href="#"><i class="icon-facebook"></i></a></li>
              <li><a href="#"><i class="icon-github"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-4">
          <div class="athmo-person text-center to-animate">
            <figure><img src="{{asset('user/images/person3.jpg')}}" alt="Image"></figure>
            <h3>Larry Ben</h3>
            <span class="athmo-position">Web Designer</span>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts</p>
            <ul class="social social-circle">
              <li><a href="#"><i class="icon-twitter"></i></a></li>
              <li><a href="#"><i class="icon-facebook"></i></a></li>
              <li><a href="#"><i class="icon-dribbble"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="athmo-counters" style="background-image: url({{ asset('user/images/full_image_1.jpg')}});" data-stellar-background-ratio="0.5">
    <div class="athmo-overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 section-heading text-center to-animate">
          <h2>Fun Facts</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="athmo-counter to-animate">
            <i class="athmo-counter-icon icon-briefcase to-animate-2"></i>
            <span class="athmo-counter-number js-counter" data-from="0" data-to="89" data-speed="5000" data-refresh-interval="50">89</span>
            <span class="athmo-counter-label">Finished projects</span>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="athmo-counter to-animate">
            <i class="athmo-counter-icon icon-code to-animate-2"></i>
            <span class="athmo-counter-number js-counter" data-from="0" data-to="2343409" data-speed="5000" data-refresh-interval="50">2343409</span>
            <span class="athmo-counter-label">Line of codes</span>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="athmo-counter to-animate">
            <i class="athmo-counter-icon icon-cup to-animate-2"></i>
            <span class="athmo-counter-number js-counter" data-from="0" data-to="1302" data-speed="5000" data-refresh-interval="50">1302</span>
            <span class="athmo-counter-label">Cup of coffees</span>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="athmo-counter to-animate">
            <i class="athmo-counter-icon icon-people to-animate-2"></i>
            <span class="athmo-counter-number js-counter" data-from="0" data-to="52" data-speed="5000" data-refresh-interval="50">52</span>
            <span class="athmo-counter-label">Happy clients</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="athmo-contact" data-section="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-12 section-heading text-center">
          <h2 class="to-animate">Get In Touch</h2>
          <div class="row">
            <div class="col-md-8 col-md-offset-2 subtext to-animate">
              <h3>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="row row-bottom-padded-md">
        <div class="col-md-6 to-animate">
          <h3>Contact Info</h3>
          <ul class="athmo-contact-info">
            <li class="athmo-contact-address ">
              <i class="icon-home"></i>
              Trihanggo, Gamping, Sleman Regency<br>Special Region of Yogyakarta 55291
            </li>
            <li><i class="icon-phone"></i> (021) 465-6789</li>
            <li><i class="icon-envelope"></i>hai@athmonitor.com</li>
            <li><i class="icon-globe"></i> <a href="http://suitdevelopers.com/" target="_blank">athmonitor.com</a></li>
          </ul>
        </div>

        <div class="col-md-6 to-animate">
          <h3>Contact Form</h3>
          <div class="form-group ">
            <label for="name" class="sr-only">Name</label>
            <input id="name" class="form-control" placeholder="Name" type="text">
          </div>
          <div class="form-group ">
            <label for="email" class="sr-only">Email</label>
            <input id="email" class="form-control" placeholder="Email" type="email">
          </div>
          <div class="form-group ">
            <label for="phone" class="sr-only">Phone</label>
            <input id="phone" class="form-control" placeholder="Phone" type="text">
          </div>
          <div class="form-group ">
            <label for="message" class="sr-only">Message</label>
            <textarea name="" id="message" cols="30" rows="5" class="form-control" placeholder="Message"></textarea>
          </div>
          <div class="form-group ">
            <input class="btn btn-primary btn-lg" value="Send Message" type="submit">
          </div>
          </div>
        </div>

      </div>
    </div>
    <div id="map" class="to-animate"></div>
  </section>
@endsection
