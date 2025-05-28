@extends('client.layout.default')

@section('title')
    @parent
    Hỗ trợ khách hàng
@endsection

@push('style')
    
@endpush

@section('content') 
    
    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="{{ asset('client/img/hero/category.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Liên hệ với chúng tôi</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

    <!-- ================ contact section start ================= -->
    <section class="contact-section">
            <div class="container">
                <div class="d-none d-sm-block mb-5 pb-4">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3317.5882054109347!2d105.74477689047546!3d21.038013946042778!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455305afd834b%3A0x17268e09af37081e!2sT%C3%B2a%20nh%C3%A0%20FPT%20Polytechnic.!5e0!3m2!1svi!2s!4v1748168612330!5m2!1svi!2s" width="1150" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    
                </div>
    
    
                <div class="row">
                    <div class="col-12">
                        <h2 class="contact-title">Nhập thông tin</h2>
                    </div>
                    <div class="col-lg-8">
                        <form class="form-contact contact_form" action="https://preview.colorlib.com/theme/estore/contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập lời nhắn'" placeholder="Nhập lời nhắn"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập tên của bạn'" placeholder="Nhập tên của bạn">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Địa chỉ email'" placeholder="Địa chỉ email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Tiêu đề email'" placeholder="Tiêu đề email">
                                    </div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm boxed-btn">Gửi</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-home"></i></span>
                            <div class="media-body">
                                <h3>Công ty trách nhiệm hữu hạn 1 thành viên.</h3>
                                <p>Địa chỉ:Đường Trịnh Văn Bô</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                            <div class="media-body">
                                <h3>+84 123456789</h3>
                                <p>Thời gian làm việc: 7 giờ sáng đến 6 giờ chiều</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-email"></i></span>
                            <div class="media-body">
                                <h3>SupportShopCao@gmail.com</h3>
                                <p>Hãy gửi những thắc mắc của bạn đến chúng tôi!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- ================ contact section end ================= -->
    
    <!-- Gallery Start-->
        <div class="gallery-wrapper lf-padding">
            <div class="gallery-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="gallery-items">
                            <img src="{{ asset('client/img/gallery/gallery1.jpg') }}" alt="">
                        </div> 
                        <div class="gallery-items">
                            <img src="{{ asset('client/img/gallery/gallery2.jpg') }}" alt="">
                        </div>
                        <div class="gallery-items">
                            <img src="{{ asset('client/img/gallery/gallery3.jpg') }}" alt="">
                        </div>
                        <div class="gallery-items">
                            <img src="{{ asset('client/img/gallery/gallery4.jpg') }}" alt="">
                        </div>
                        <div class="gallery-items">
                            <img src="{{ asset('client/img/gallery/gallery5.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gallery End-->

@endsection

@push('scripts')
@endpush