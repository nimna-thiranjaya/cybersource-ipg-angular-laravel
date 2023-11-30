@include('layout.header')
@include('layout.sidebar')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome Back Admin!</h3>
                        <h6 class="font-weight-normal mb-0">
                            You're viewing
                            <span class="text-primary">Admin Dashboard </span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="
    display: flex;
    align-items: center;

            ">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg" style="
                width: 100%;
                height: 100%;
                background-color: transparent;
                border: none;
                margin-top: -20px;
                ">
                    <div class="card-people">
                        <img src="https://res.cloudinary.com/desnqqj6a/image/upload/v1690042294/6276023_uofpou.jpg"
                            alt="people" style="
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                        object-position: center;
                      " />
                        <div class="weather-info">
                            <div class="d-flex">
                                <div>
                                    <h2 class="mb-0 font-weight-normal">
                                        <i class="icon-sun mr-2"></i>31<sup>C</sup>
                                    </h2>
                                </div>
                                <div class="ml-2">
                                    <h4 class="location font-weight-normal">Colombo</h4>
                                    <h6 class="font-weight-normal">Sri Lanka</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Total Categories</p>
                                <p class="fs-30 mb-2">{{$dashBoardData['categoryCount']}}</p>
                                <p>Categories</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Published Notes</p>
                                <p class="fs-30 mb-2">{{$dashBoardData['noteCount']}}</p>
                                <p>Last 30 days</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">Favourites</p>
                                <p class="fs-30 mb-2">{{$dashBoardData['favoritesCount']}}</p>
                                <p>Last 30 days</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Archieved Notes</p>
                                <p class="fs-30 mb-2">{{$dashBoardData['draftCount']}}</p>
                                <p>Last 30 days</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ---------Card grid view with css---------------- -->
        <div class="col-12 col-xl-8 mb-4 mb-xl-5">
            <h3 class="font-weight-bold">Category List</h3>
            <h6 class="font-weight-normal mb-0">
                All Categories are listed here in
                <span class="text-primary">
                    Category List
                </span>
            </h6>
        </div>
        <div class="row" style="display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    gap: 20px;
   justify-content: space-around;
    ">
            @foreach($categories as $category)
            <a href="{{ route('viewnotes', ['id' => $category->id]) }}">
                <div class="article-card">
                    <div class="content">
                        <p class="date">{{ \Carbon\Carbon::parse($category->updatedAt)->format('M j, Y') }}</p>
                        <p class="title">{{$category->category_name}}</p>
                    </div>
                    <img src="{{$category->category_image}}" alt="article-cover" />
                </div>
            </a>
            @endforeach

            <!--
            <div class="article-card" onClick="
  window.location.href='{{URL::to('/viewnotes')}}'">
                <div class="content">
                    <p class="date">Jan 1, 2022</p>
                    <p class="title">Article Title Goes Here</p>
                </div>
                <img src="https://images.unsplash.com/photo-1482877346909-048fb6477632?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=958&q=80"
                    alt="article-cover" />
            </div>

            <div class="article-card" onClick="
  window.location.href='{{URL::to('/viewnotes')}}'">
                <div class="content">
                    <p class="date">Jan 1, 2022</p>
                    <p class="title">Using Category</p>
                </div>
                <img src="https://res.cloudinary.com/desnqqj6a/image/upload/v1667646633/cld-sample-3.jpg"
                    alt="article-cover" />
            </div>

            <div class="article-card">
                <div class="content">
                    <p class="date">Jan 1, 2022</p>
                    <p class="title">Article Title Goes Here</p>
                </div>
                <img src="https://res.cloudinary.com/desnqqj6a/image/upload/v1667646633/cld-sample-4.jpg"
                    alt="article-cover" />
            </div>

            <div class="article-card">
                <div class="content">
                    <p class="date">Jan 1, 2022</p>
                    <p class="title">Article Title Goes Here</p>
                </div>
                <img src="https://res.cloudinary.com/desnqqj6a/image/upload/v1667646633/cld-sample.jpg"
                    alt="article-cover" />
            </div>

            <div class="article-card">
                <div class="content">
                    <p class="date">Jan 1, 2022</p>
                    <p class="title">Article Title Goes Here</p>
                </div>
                <img src="https://res.cloudinary.com/desnqqj6a/image/upload/v1667646633/cld-sample-2.jpg"
                    alt="article-cover" />
            </div>

            <div class="article-card">
                <div class="content">
                    <p class="date">Jan 1, 2022</p>
                    <p class="title">Article Title Goes Here</p>
                </div>
                <img src="https://images.unsplash.com/photo-1482877346909-048fb6477632?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=958&q=80"
                    alt="article-cover" />
            </div>

            <div class="article-card">
                <div class="content">
                    <p class="date">Jan 1, 2022</p>
                    <p class="title">Article Title Goes Here</p>
                </div>
                <img src="https://images.unsplash.com/photo-1482877346909-048fb6477632?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=958&q=80"
                    alt="article-cover" />
            </div> -->

        </div>
        @include('layout.footer')
