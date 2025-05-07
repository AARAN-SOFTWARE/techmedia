@pushonce('custom-style')

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@11/swiper-bundle.min.css"/>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper@11/swiper-bundle.min.js"></script>

    <style>
        .autoplay-progress {
            position: absolute;
            right: 16px;
            bottom: 16px;
            z-index: 10;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 400;
            color: dodgerblue;
        }

        .autoplay-progress svg {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            stroke-width: 3px;
            stroke: dodgerblue;
            /*var(--swiper-theme-color);*/
            fill: none;
            stroke-dasharray: 125.6;
            transform: rotate(-90deg);
            transition: stroke-dashoffset 0.3s ease;
        }

        /*for progress bar*/
        /*.autoplay-progress-bar {*/
        /*    z-index: 50;*/
        /*}*/

        /*.progress-inner {*/
        /*    width: 0%;*/
        /*}*/

        [data-animatable] {
            opacity: 0;
        }

        .fade-in {
            animation: fadeInDown 0.8s ease forwards;
        }

        .zoom-in {
            animation: zoomIn 0.8s ease forwards;
        }

        .flip-in {
            animation: flipIn 0.8s ease forwards;
        }

        .scale-in {
            animation: scaleIn 0.8s ease forwards;
        }

        @keyframes fadeInDown {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.5);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes flipIn {
            from {
                transform: rotateY(90deg);
                opacity: 0;
            }
            to {
                transform: rotateY(0);
                opacity: 1;
            }
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

    </style>

@endpushonce

<div class="swiper mySwiper h-screen group">
    <div class="swiper-wrapper">

        @foreach($sliders as $row)
            <div class="swiper-slide {{ $row->bg_colour }}" data-in="fade-in">
                <div
                    class="h-screen flex items-center justify-center w-full animate__animated wow animate__bounceInDown">
                    <div class="text-center space-y-6" data-animatable>
                        <h1
                            class="fade-in mx-auto max-w-7xl font-display caveat-brush-regular text-5xl font-medium tracking-tight text-slate-900 sm:text-7xl">
                            {!! \Aaran\Slider\Livewire\Class\SliderShow::highlightKeyword($row->header, $row->txt_colour, $row->fill_colour) !!}

                        </h1>

                        <p class="text-xl text-neutral-600" data-animatable>{{ $row->tagline }}</p>
                        <p class="text-xl text-neutral-600" data-animatable>{{ $row->tagline_2 }}</p>

                    </div>
                </div>
            </div>
        @endforeach


    </div>

    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-pagination"></div>
    <div class="autoplay-progress">
        <svg viewBox="0 0 48 48">
            <circle cx="24" cy="24" r="20"></circle>
        </svg>
        <span></span>
    </div>
</div>


<script>
    const progressCircle = document.querySelector('.autoplay-progress circle');
    const progressContent = document.querySelector('.autoplay-progress span');

    const animateSlide = (slide) => {
        const animType = slide.dataset.in || 'fade-in';
        const animatables = slide.querySelectorAll('[data-animatable]');
        animatables.forEach((el, index) => {
            el.classList.remove('fade-in', 'zoom-in', 'flip-in', 'scale-in');
            el.style.animationDelay = `${index * 0.2}s`; // Staggered animation
            el.classList.add(animType);
        });
    };

    const swiper = new Swiper('.mySwiper', {
        loop: true,
        autoplay: {
            delay: 6000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        on: {
            slideChangeTransitionEnd: function () {
                const currentSlide = swiper.slides[swiper.activeIndex];
                animateSlide(currentSlide);
            },
            autoplayTimeLeft(s, time, progress) {
                if (progressCircle && progressContent) {
                    const offset = 125.6 * (1 - progress);
                    progressCircle.style.strokeDashoffset = offset;
                    progressContent.textContent = `${Math.ceil(time / 1000)}s`;
                }
            },
        }
    });

    // Initial animation
    window.addEventListener('DOMContentLoaded', () => {
        animateSlide(swiper.slides[swiper.activeIndex]);
    });
</script>
