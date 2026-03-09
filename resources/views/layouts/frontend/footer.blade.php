      @php
          $footer_pages = App\Models\Menuitem::with(['subMenus.childMenus'])
              ->whereNull('parent_id')
              ->whereHas('get_menu', function ($query) {
                  $query->where('location', 'footer1')->where('sourch', 'page');
              })
              ->orderby('position', 'asc')
              ->get();
          $footer_pages1 = App\Models\Menuitem::with(['subMenus.childMenus'])
              ->whereNull('parent_id')
              ->whereHas('get_menu', function ($query) {
                  $query->where('location', 'footer2')->where('sourch', 'page');
              })
              ->orderby('position', 'asc')
              ->get();
      @endphp
      <footer class="main-footer">
          <div class="bg bg-pattern-7"></div>
          <div class="auto-container">
              <div class="footer-upper">
                  <div class="logo-box"><img
                          src="{{ asset(get_setting('site_footer_logo')->value ?? 'frontend/images/logo-2.png') }}"
                          alt=""></div>
                  <ul class="contact-info">
                      <li>
                          <i class="icon fa fa-phone-square"></i>
                          <span class="title">Phone:</span>
                          <div class="text"><a
                                  href="tel:{{ get_setting('phone')->value ?? '' }}">{{ get_setting('phone')->value ?? '' }}</a>
                          </div>
                      </li>
                      <li>
                          <i class="icon fa fa-envelope"></i>
                          <span class="title">Email:</span>
                          <div class="text"><a
                                  href="mailto:{{ get_setting('email')->value ?? '' }}">{{ get_setting('email')->value ?? '' }}</a>
                          </div>
                      </li>
                      <li>
                          <i class="icon fa fa-map-marker"></i>
                          <span class="title">Address:</span>
                          <div class="text">{{ get_setting('business_address')->value ?? '' }}</div>
                      </li>
                  </ul>
                  <div class="btn-box">
                      <a href="#" class="theme-btn btn-style-four"><span class="btn-title">Book
                              Consultation</span></a>
                  </div>
              </div>
          </div>

          <!--Widgets Section-->
          <div class="widgets-section">
              <div class="auto-container">
                  <div class="row">
                      <!--Footer Column-->
                      <div class="footer-column col-xl-6 col-lg-8 col-md-12 mb-0">
                          <div class="row">
                              <div class="footer-widget col-lg-4 col-md-4 col-ms-12">
                                  <h6 class="widget-title">Links</h6>
                                  <ul class="user-links">
                                      @if (count($footer_pages) == 0)
                                          @for ($i = 1; $i < 5; $i++)
                                              <li><a href="#"> Default Page {{ $i }}</a></li>
                                          @endfor
                                      @endif
                                      @foreach ($footer_pages->take(5) as $key => $pages)
                                          <li><a href="{{ route('footer.menu.page', $pages->url) }}">
                                                  {{ $pages->title ?? '' }}</a></li>
                                      @endforeach
                                  </ul>
                              </div>
                              <div class="footer-widget col-lg-4 col-md-4 col-ms-12">
                                  <h6 class="widget-title">Services</h6>
                                  <ul class="user-links">
                                      @if (count($footer_pages1) == 0)
                                          @for ($i = 1; $i < 5; $i++)
                                              <li><a href="#">Default Page {{ $i }}</a></li>
                                          @endfor
                                      @endif
                                      @foreach ($footer_pages1->take(5) as $key => $pages)
                                          <li><a
                                                  href="{{ route('footer.menu.page', $pages->url) }}">{{ $pages->title ?? '' }}</a>
                                          </li>
                                      @endforeach
                                  </ul>
                              </div>
                          </div>
                      </div>

                      <!--Footer Column-->
                      <div class="footer-column col-xl-3 col-lg-12 col-md-6">
                          <div class="footer-widget">
                              <h6 class="widget-title">Newsletter</h6>
                              <div class="subscribe-form">
                                  <div class="text">Signup for our latest news & articles.</div>
                                  <form method="post" action="#">
                                      <div class="form-group">
                                          <input type="email" name="email" class="email" value=""
                                              placeholder="Email Address" required="">
                                          <button type="button" class="theme-btn"><i
                                                  class="fa fa-paper-plane"></i></button>
                                      </div>
                                  </form>
                              </div>
                              <ul class="social-icon-two">
                                  <li><a target="_blank" href="{{ get_setting('facebook_url')->value ?? '#' }}"><i
                                              class="fab fa-facebook"></i></a></li>
                                  <li><a target="_blank" href="{{ get_setting('pinterest_url')->value ?? '' }}"><i
                                              class="fab fa-pinterest"></i></a></li>
                                  <li><a target="_blank" href="{{ get_setting('instagram_url')->value ?? '' }}"><i
                                              class="fab fa-instagram"></i></a></li>
                              </ul>

                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <!--Footer Bottom-->
          <div class="footer-bottom">
              <div class="auto-container">
                  <div class="inner-container d-flex justify-content-between align-items-center">

                      <!-- Left -->
                      <div class="copyright-text text-light">
                          {{ get_setting('copy_right')->value ?? '' }}
                          <a  href="https://immigro.chalkboardbd.com/">
                              {{ date('Y') }} All rights reserved.
                          </a>
                      </div>

                      <!-- Right -->
                      <div class="developed-by">
                          Developed by
                          <a class="text-light" href="{{ get_setting('developer_link')->value ?? '#' }}" target="_blank">
                              {{ get_setting('developed_by')->value ?? '' }}
                          </a>
                      </div>

                  </div>
              </div>
          </div>
      </footer>
