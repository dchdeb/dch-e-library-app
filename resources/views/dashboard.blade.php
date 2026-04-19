@extends('layouts.layout')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}">Home</a>
@endsection

@section('title', 'Dashboard')
@section('content')



    <!-- row 1 -->
    <div class="col-12 col-xl ">

        <div class=" dashboard-home-heading ">
            <div class=" fw-semibold dashboard-home-heading-title">DHAKA COMMUNITY HOSPITAL</div>
            <div class="fw-semibold fs-6"> 190/1 Boro Moghbazar Wireless Railgate, Dhaka 1217.</div>
            <div> Phone: 02-222221191 Mobile : 01711-194576 <span class=" fw-semibold"> Email: dcht87@gmail.com</span> </div>

        </div>


        <div class="border border-1 rounded $cyan-300 p-2">
            <div class=" fw-semibold dashboard-home p-2 ">All library’s Information </div>
            <hr>

            <div class="row g-2">
                <div class="col-12 col-xl-3">
                    <div class="card px-4 stat">
                        <div class="stat-body my-2 ">
                            <div class=" text-center">
                                <div class="tile ">
                                    <i class="bi bi-book-half"></i>
                                </div>
                            </div>

                            <div class="text-area mt-3 text-center">

                                <div class="fs-6 fw-semibold">Total Book</div>
                                <div class="fs-5 fw-semibold text-muted">2</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-3">
                    <div class="card px-4 stat">
                        <div class="stat-body my-2 ">
                            <div class=" text-center">
                                <div class="tile ">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                            </div>

                            <div class="text-area mt-3 text-center">

                                <div class="fs-6 fw-semibold">Total Author</div>
                                <div class="fs-5 fw-semibold text-muted">4</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-3">
                    <div class="card px-4 stat">
                        <div class="stat-body my-2 ">
                            <div class=" text-center">
                                <div class="tile ">
                                    <i class="bi bi-collection-fill"></i>
                                </div>
                            </div>

                            <div class="text-area mt-3 text-center">

                                <div class="fs-6 fw-semibold">Total Category</div>
                                <div class="fs-5 fw-semibold text-muted">10</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-3">
                    <div class="card px-4 stat">
                        <div class="stat-body my-2 ">
                            <div class=" text-center">
                                <div class="tile ">
                                    <i class="bi bi-hdd-rack-fill"></i>
                                </div>
                            </div>

                            <div class="text-area mt-3 text-center">

                                <div class="fs-6 fw-semibold">Total Location of Rack</div>
                                <div class="fs-5 fw-semibold text-muted">500</div>
                            </div>
                        </div>
                    </div>
                </div>

                 <div class="col-12 col-xl-3">
                    <div class="card px-4 stat">
                        <div class="stat-body my-2 ">
                            <div class=" text-center">
                                <div class="tile ">
                                    <i class="bi bi-basket-fill"></i>
                                </div>
                            </div>

                            <div class="text-area mt-3 text-center">

                                <div class="fs-6 fw-semibold">Total book issue</div>
                                <div class="fs-5 fw-semibold text-muted">6</div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-12 col-xl-3">
                    <div class="card px-4 stat">
                        <div class="stat-body my-2 ">
                            <div class=" text-center">
                                <div class="tile ">
                                    <i class="bi bi-back"></i>
                                </div>
                            </div>

                            <div class="text-area mt-3 text-center">

                                <div class="fs-6 fw-semibold">Total book Returned</div>
                                <div class="fs-5 fw-semibold text-muted">6</div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-12 col-xl-3">
                    <div class="card px-4 stat">
                        <div class="stat-body my-2 ">
                            <div class=" text-center">
                                <div class="tile ">
                                    <i class="bi bi-arrow-down-left-square-fill"></i>
                                </div>
                            </div>

                            <div class="text-area mt-3 text-center">

                                <div class="fs-6 fw-semibold">Total book not return</div>
                                <div class="fs-5 fw-semibold text-muted">20</div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-12 col-xl-3">
                    <div class="card px-4 stat">
                        <div class="stat-body my-2 ">
                            <div class=" text-center">
                                <div class="tile ">
                                    <i class="bi bi-coin"></i>
                                </div>
                            </div>

                            <div class="text-area mt-3 text-center">

                                <div class="fs-6 fw-semibold">Total fine Receives</div>
                                <div class="fs-5 fw-semibold text-muted">20</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>





    <!-- row 2 -->
    {{-- <div class="row g-3 mt-1">
        
        <div class="col-12 col-xl-4">
            <div class="card dashboard-2nd-card-section">
                <div class="stat-body my-2 ">
                    <div class="text-area mt-3 text-center">
                        <div class="fs-5 fw-semibold text-muted">100</div>
                        <div class="fs-6 fw-semibold">Free Bed/Ward</div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-12 col-xl-4">
            <div class="card  dashboard-2nd-card-section">
                <div class="stat-body my-2 ">
                    <div class="text-area mt-3 text-center">
                        <div class="fs-5 fw-semibold text-muted">100</div>
                        <div class="fs-6 fw-semibold">Booked Ward/Bed</div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-12 col-xl-4">
             <div class="card  dashboard-2nd-card-section">
                <div class="stat-body my-2 ">
                    <div class="text-area mt-3 text-center">
                        <div class="fs-5 fw-semibold text-muted">100</div>
                        <div class="fs-6 fw-semibold">Pre booked Ward/Bed </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- row 3 -->
    {{-- <div class="row g-3 mt-1">
        
        <div class="border border-1 rounded $cyan-300 p-2">
            <div class=" fw-semibold dashboard-home p-2 ">Task</div>
            <hr>

            <div class="row g-2">
                <div class="col-12 col-xl-4">
                    <div class="card px-4 stat">
                        <div class="stat-body my-2 ">
                            <div class=" text-center">
                                <div class="tile ">
                                    <i class=" bi bi-clipboard"></i>
                                </div>
                            </div>

                            <div class="text-area mt-3 text-center">
                                <div class="fs-5 fw-semibold text-muted">200</div>
                                <div class="fs-6 fw-semibold">Submit Task</div>
                            </div>
                        </div>
                    </div>   
                </div>
                <div class="col-12 col-xl-4">
                    <div class="card px-4 stat">
                        <div class="stat-body my-2 ">
                            <div class=" text-center">
                                <div class="tile ">
                                    <i class="bi bi-clipboard"></i>
                                </div>
                            </div>

                            <div class="text-area mt-3 text-center">


                                <div class="fs-5 fw-semibold text-muted">20</div>
                                <div class="fs-6 fw-semibold">Pending Task</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="card px-4 stat">
                        <div class="stat-body my-2 ">
                            <div class=" text-center">
                                <div class="tile ">
                                    <i class="bi bi-clipboard"></i>
                                </div>
                            </div>

                            <div class="text-area mt-3 text-center">


                                <div class="fs-5 fw-semibold text-muted">214</div>
                                <div class="fs-6 fw-semibold">Complete Task</div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>



       

    </div> --}}

@endsection
