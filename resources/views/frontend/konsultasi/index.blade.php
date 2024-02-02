@extends('frontend.layout')
@section('title', 'Konsultasi')
@section('content')
    <style>
        .card {
            --background-color: #18181B;
            --text-color: #A1A1AA;

            --card-background-color: rgba(255, 255, 255, .015);
            --card-border-color: rgba(255, 255, 255, 0.1);
            --card-box-shadow-1: rgba(0, 0, 0, 0.05);
            --card-box-shadow-1-y: 3px;
            --card-box-shadow-1-blur: 6px;
            --card-box-shadow-2: rgba(0, 0, 0, 0.1);
            --card-box-shadow-2-y: 8px;
            --card-box-shadow-2-blur: 15px;
            --card-label-color: #FFFFFF;
            --card-icon-color: #D4D4D8;
            --card-icon-background-color: rgba(255, 255, 255, 0.08);
            --card-icon-border-color: rgba(255, 255, 255, 0.12);
            --card-shine-opacity: .1;
            --card-shine-gradient: conic-gradient(from 205deg at 50% 50%, rgba(16, 185, 129, 0) 0deg, #10B981 25deg, rgba(52, 211, 153, 0.18) 295deg, rgba(16, 185, 129, 0) 360deg);
            --card-line-color: #2A2B2C;
            --card-tile-color: rgba(16, 185, 129, 0.05);

            --card-hover-border-color: rgba(255, 255, 255, 0.2);
            --card-hover-box-shadow-1: rgba(0, 0, 0, 0.04);
            --card-hover-box-shadow-1-y: 5px;
            --card-hover-box-shadow-1-blur: 10px;
            --card-hover-box-shadow-2: rgba(0, 0, 0, 0.3);
            --card-hover-box-shadow-2-y: 15px;
            --card-hover-box-shadow-2-blur: 25px;
            --card-hover-icon-color: #34D399;
            --card-hover-icon-background-color: rgba(52, 211, 153, 0.1);
            --card-hover-icon-border-color: rgba(52, 211, 153, 0.2);

            --blur-opacity: .01;

            &.light {
                --background-color: #FAFAFA;
                --text-color: #52525B;

                --card-background-color: transparent;
                --card-border-color: rgba(24, 24, 27, 0.08);
                --card-box-shadow-1: rgba(24, 24, 27, 0.02);
                --card-box-shadow-1-y: 3px;
                --card-box-shadow-1-blur: 6px;
                --card-box-shadow-2: rgba(24, 24, 27, 0.04);
                --card-box-shadow-2-y: 2px;
                --card-box-shadow-2-blur: 7px;
                --card-label-color: #18181B;
                --card-icon-color: #18181B;
                --card-icon-background-color: rgba(24, 24, 27, 0.04);
                --card-icon-border-color: rgba(24, 24, 27, 0.1);
                --card-shine-opacity: .3;
                --card-shine-gradient: conic-gradient(from 225deg at 50% 50%, rgba(16, 185, 129, 0) 0deg, #10B981 25deg, #EDFAF6 285deg, #FFFFFF 345deg, rgba(16, 185, 129, 0) 360deg);
                --card-line-color: #E9E9E7;
                --card-tile-color: rgba(16, 185, 129, 0.08);

                --card-hover-border-color: rgba(24, 24, 27, 0.15);
                --card-hover-box-shadow-1: rgba(24, 24, 27, 0.05);
                --card-hover-box-shadow-1-y: 3px;
                --card-hover-box-shadow-1-blur: 6px;
                --card-hover-box-shadow-2: rgba(24, 24, 27, 0.1);
                --card-hover-box-shadow-2-y: 8px;
                --card-hover-box-shadow-2-blur: 15px;
                --card-hover-icon-color: #18181B;
                --card-hover-icon-background-color: rgba(24, 24, 27, 0.04);
                --card-hover-icon-border-color: rgba(24, 24, 27, 0.34);

                --blur-opacity: .1;
            }

            &.toggle .grid * {
                transition-duration: 0s !important;
            }
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 240px);
            grid-gap: 32px;
            position: relative;
            z-index: 1;
        }

        .card {
            background-color: var(--background-color);
            box-shadow: 0px var(--card-box-shadow-1-y) var(--card-box-shadow-1-blur) var(--card-box-shadow-1), 0px var(--card-box-shadow-2-y) var(--card-box-shadow-2-blur) var(--card-box-shadow-2), 0 0 0 1px var(--card-border-color);
            padding: 56px 16px 16px 16px;
            border-radius: 15px;
            /* cursor: pointer; */
            position: relative;
            transition: box-shadow .25s;


            &::before {
                content: '';
                position: absolute;
                inset: 0;
                border-radius: 15px;
                background-color: var(--card-background-color);
            }

            .icon {
                z-index: 2;
                position: relative;
                display: table;
                padding: 8px;

                &::after {
                    content: '';
                    position: absolute;
                    inset: 4.5px;
                    border-radius: 50%;
                    background-color: var(--card-icon-background-color);
                    border: 1px solid var(--card-icon-border-color);
                    backdrop-filter: blur(2px);
                    transition: background-color .25s, border-color .25s;
                }

                svg {
                    position: relative;
                    z-index: 1;
                    display: block;
                    width: 24px;
                    height: 24px;
                    transform: translateZ(0);
                    color: var(--card-icon-color);
                    transition: color .25s;
                }
            }

            h4 {
                z-index: 2;
                position: relative;
                margin: 12px 0 4px 0;
                font-family: inherit;
                font-weight: 600;
                font-size: 14px;
                line-height: 2;
                color: var(--card-label-color);
            }

            p {
                z-index: 2;
                position: relative;
                margin: 0;
                font-size: 14px;
                line-height: 1.7;
                color: var(--text-color);
            }

            .shine {
                border-radius: inherit;
                position: absolute;
                inset: 0;
                z-index: 1;
                overflow: hidden;
                opacity: 0;
                transition: opacity .5s;

                &:before {
                    content: '';
                    width: 150%;
                    padding-bottom: 150%;
                    border-radius: 50%;
                    position: absolute;
                    left: 50%;
                    bottom: 55%;
                    filter: blur(35px);
                    opacity: var(--card-shine-opacity);
                    transform: translateX(-50%);
                    background-image: var(--card-shine-gradient);
                }
            }

            .background {
                border-radius: inherit;
                position: absolute;
                inset: 0;
                overflow: hidden;
                -webkit-mask-image: radial-gradient(circle at 60% 5%, black 0%, black 15%, transparent 60%);
                mask-image: radial-gradient(circle at 60% 5%, black 0%, black 15%, transparent 60%);

                .tiles {
                    opacity: 0;
                    transition: opacity .25s;

                    .tile {
                        position: absolute;
                        background-color: var(--card-tile-color);
                        animation-duration: 8s;
                        animation-iteration-count: infinite;
                        opacity: 0;

                        &.tile-4,
                        &.tile-6,
                        &.tile-10 {
                            animation-delay: -2s;
                        }

                        &.tile-3,
                        &.tile-5,
                        &.tile-8 {
                            animation-delay: -4s;
                        }

                        &.tile-2,
                        &.tile-9 {
                            animation-delay: -6s;
                        }

                        &.tile-1 {
                            top: 0;
                            left: 0;
                            height: 10%;
                            width: 22.5%;
                        }

                        &.tile-2 {
                            top: 0;
                            left: 22.5%;
                            height: 10%;
                            width: 27.5%;
                        }

                        &.tile-3 {
                            top: 0;
                            left: 50%;
                            height: 10%;
                            width: 27.5%;
                        }

                        &.tile-4 {
                            top: 0;
                            left: 77.5%;
                            height: 10%;
                            width: 22.5%;
                        }

                        &.tile-5 {
                            top: 10%;
                            left: 0;
                            height: 22.5%;
                            width: 22.5%;
                        }

                        &.tile-6 {
                            top: 10%;
                            left: 22.5%;
                            height: 22.5%;
                            width: 27.5%;
                        }

                        &.tile-7 {
                            top: 10%;
                            left: 50%;
                            height: 22.5%;
                            width: 27.5%;
                        }

                        &.tile-8 {
                            top: 10%;
                            left: 77.5%;
                            height: 22.5%;
                            width: 22.5%;
                        }

                        &.tile-9 {
                            top: 32.5%;
                            left: 50%;
                            height: 22.5%;
                            width: 27.5%;
                        }

                        &.tile-10 {
                            top: 32.5%;
                            left: 77.5%;
                            height: 22.5%;
                            width: 22.5%;
                        }
                    }
                }

                @keyframes tile {

                    0%,
                    12.5%,
                    100% {
                        opacity: 1;
                    }

                    25%,
                    82.5% {
                        opacity: 0;
                    }
                }

                .line {
                    position: absolute;
                    inset: 0;
                    opacity: 0;
                    transition: opacity .35s;

                    &:before,
                    &:after {
                        content: '';
                        position: absolute;
                        background-color: var(--card-line-color);
                        transition: transform .35s;
                    }

                    &:before {
                        left: 0;
                        right: 0;
                        height: 1px;
                        transform-origin: 0 50%;
                        transform: scaleX(0);
                    }

                    &:after {
                        top: 0;
                        bottom: 0;
                        width: 1px;
                        transform-origin: 50% 0;
                        transform: scaleY(0);
                    }

                    &.line-1 {
                        &:before {
                            top: 10%;
                        }

                        &:after {
                            left: 22.5%;
                        }

                        &:before,
                        &:after {
                            transition-delay: .3s;
                        }
                    }

                    &.line-2 {
                        &:before {
                            top: 32.5%;
                        }

                        &:after {
                            left: 50%;
                        }

                        &:before,
                        &:after {
                            transition-delay: .15s;
                        }
                    }

                    &.line-3 {
                        &:before {
                            top: 55%;
                        }

                        &:after {
                            right: 22.5%;
                        }
                    }
                }
            }

            &:hover {
                box-shadow: 0px 3px 6px var(--card-hover-box-shadow-1), 0px var(--card-hover-box-shadow-2-y) var(--card-hover-box-shadow-2-blur) var(--card-hover-box-shadow-2), 0 0 0 1px var(--card-hover-border-color);

                .icon {
                    &::after {
                        background-color: var(--card-hover-icon-background-color);
                        border-color: var(--card-hover-icon-border-color);
                    }

                    svg {
                        color: var(--card-hover-icon-color);
                    }
                }

                .shine {
                    opacity: 1;
                    transition-duration: .5s;
                    transition-delay: 0s;
                }

                .background {

                    .tiles {
                        opacity: 1;
                        transition-delay: .25s;

                        .tile {
                            animation-name: tile;
                        }
                    }

                    .line {
                        opacity: 1;
                        transition-duration: .15s;

                        &:before {
                            transform: scaleX(1);
                        }

                        &:after {
                            transform: scaleY(1);
                        }

                        &.line-1 {

                            &:before,
                            &:after {
                                transition-delay: .0s;
                            }
                        }

                        &.line-2 {

                            &:before,
                            &:after {
                                transition-delay: .15s;
                            }
                        }

                        &.line-3 {

                            &:before,
                            &:after {
                                transition-delay: .3s;
                            }
                        }
                    }
                }
            }
        }

        .day-night {
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 20px;
            opacity: .3;

            input {
                display: none;

                &+div {
                    border-radius: 50%;
                    width: 20px;
                    height: 20px;
                    position: relative;
                    box-shadow: inset 8px -8px 0 0 var(--text-color);
                    transform: scale(1) rotate(-2deg);
                    transition: box-shadow .5s ease 0s, transform .4s ease .1s;

                    &:before {
                        content: '';
                        width: inherit;
                        height: inherit;
                        border-radius: inherit;
                        position: absolute;
                        left: 0;
                        top: 0;
                        transition: background-color .3s ease;
                    }

                    &:after {
                        content: '';
                        width: 6px;
                        height: 6px;
                        border-radius: 50%;
                        margin: -3px 0 0 -3px;
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        box-shadow: 0 -23px 0 var(--text-color), 0 23px 0 var(--text-color), 23px 0 0 var(--text-color), -23px 0 0 var(--text-color), 15px 15px 0 var(--text-color), -15px 15px 0 var(--text-color), 15px -15px 0 var(--text-color), -15px -15px 0 var(--text-color);
                        transform: scale(0);
                        transition: all .3s ease;
                    }
                }

                &:checked+div {
                    box-shadow: inset 20px -20px 0 0 var(--text-color);
                    transform: scale(.5) rotate(0deg);
                    transition: transform .3s ease .1s, box-shadow .2s ease 0s;

                    &:before {
                        background: var(--text-color);
                        transition: background-color .3s ease .1s;
                    }

                    &:after {
                        transform: scale(1);
                        transition: transform .5s ease .15s;
                    }
                }
            }
        }



        // Center
        .card {
            min-height: 100vh;
            display: flex;

            font-family: 'Inter', Arial;
            justify-content: center;
            align-items: center;
            background-color: var(--background-color);
            overflow: hidden;


            &:before {
                content: '';
                position: absolute;
                inset: 0 -60% 65% -60%;
                background-image: radial-gradient(ellipse at top, #10B981 0%, var(--background-color) 50%);
                opacity: var(--blur-opacity);
            }

            .twitter {
                position: fixed;
                display: block;
                right: 12px;
                bottom: 12px;

                svg {
                    width: 32px;
                    height: 32px;
                    fill: #fff;
                }
            }
        }
    </style>
    <div class="container-lg">
        <div class="row justify-content-center mt-5 container mx-auto ">
            <h6 class="sub-title text-center">INGIN KONSULTASI DENGAN DOKTER KAMI SECARA GRATIS?</h6>
            <p class="sub-title text-center">Caranya gampang banget! Yuk klik Join Now di bawah ini!</p>
            @forelse ($konsultasi as $item)
                <div class="card col-lg-4"
                    style="margin-right: 15px;
            margin-left: 15px; margin-bottom: 15px; margin-top: 15px">
                    <a href="https://wa.me/+62{{ $item->no_wa }}" target="_blank"><span
                            class="icon d-flex align-items-center justify-content-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="#fff">
                                <path
                                    d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                            </svg>
                            <p class="text-white">Join Now</p>
                        </span></a>
                    <h4>{{ $item->judul }}</h4>
                    <p>
                        {{ $item->isi }}
                    </p>
                    <div class="shine"></div>
                    <div class="background">
                        <div class="tiles">
                            <div class="tile tile-1"></div>
                            <div class="tile tile-2"></div>
                            <div class="tile tile-3"></div>
                            <div class="tile tile-4"></div>

                            <div class="tile tile-5"></div>
                            <div class="tile tile-6"></div>
                            <div class="tile tile-7"></div>
                            <div class="tile tile-8"></div>

                            <div class="tile tile-9"></div>
                            <div class="tile tile-10"></div>
                        </div>

                        <div class="line line-1"></div>
                        <div class="line line-2"></div>
                        <div class="line line-3"></div>
                    </div>
                </div>
            @empty
                <p class="text-center">No data</p>
            @endforelse


        </div>
    </div>


@endsection
