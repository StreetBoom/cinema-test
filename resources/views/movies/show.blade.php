@extends('layouts.main')
@section('navBar')
    <body>
    <main>
        <section class="py-5 text-center container ">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Show page</h1>
                    <p class="lead text-muted">{{$movie->name}}</p>
                </div>
            </div>
        </section>
        <div
            style="background-image: url('https://catherineasquithgallery.com/uploads/posts/2021-02/1614257532_3-p-sploshnoi-chernii-fon-4.jpg');">
            <div class="row">
                <div class="album py-3 ">
                    <div class="container ">
                        <div class="col">
                            <div class="card shadow-sm">
                                <div id="carouselExample" class="carousel slide">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="{{$movie->image}}" class="d-block w-100" alt="...">
                                        </div>
                                        @foreach($movie->galleries as $gallery)
                                            <div class="carousel-item">
                                                <img src="{{$gallery->image}}" class="d-block w-100" alt="...">
                                            </div>
                                        @endforeach

                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Предыдущий</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Следующий</span>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-text">{{$movie->name}}</h5>
                                    <h6 class="card-text">Красткое описание фильма: {{$movie->description}}</h6>
                                    <h6 class="card-text">Режиссер: {{$movie->director->name}}</h6>
                                    <div class="d-flex justify-content-between align-items-center ">
                                        <div class="btn-group rounded-3 ">
                                            <p class="lead mb-0 p-3  rounded-3 ">
                                                <a class=" fw-bold"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#exampleModal">
                                                    Список актеров
                                                </a>
                                            </p>
                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-black">
                                                            @foreach($movie->actors as $actor)
                                                                <h6 class="card-text">{{$actor->name}}</h6>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @auth('web')
                                    <form action="/movies/{{ $movie->id }}/rate" method="POST">
                                        @csrf
                                        <label for="rating">Поставьте оценку фильму:</label>
                                        <input type="number" name="rating" id="rating" min="1" max="10" required>
                                        <button type="submit">Оценить</button>
                                    </form>
                                    @endauth
                                    <h6 class="card-text">Рейтинг фильма: {{$movie->rating}}</h6>

                                    <small class="text-muted rounded-3">{{$movie->release}}</small>
                                </div>
                            </div>

                            @foreach($movie->comments as $comment)
                                <div class="card-body" style="background-color: #f8f9fa;">
                                    <div class="d-flex flex-start align-items-center">
                                        <img class="rounded-circle shadow-1-strong me-3"
                                             src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp"
                                             alt="avatar"
                                             width="60"
                                             height="60"/>
                                        <div>
                                            <h6 class="fw-bold text-primary mb-1">{{$comment->user->name}}</h6>
                                            <p class="text-muted small mb-0">{{$comment->created_at}}</p>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-4 pb-2">{{$comment->message}}</p>
                                </div>
                            @endforeach
                            @guest()
                                <a type="button" href="{{route('login')}}" class="btn btn-light btn-rounded">Чтобы оставить отзыв или оценку авторизуйтесь.</a>
                            @endguest
                            @auth('web')
                                <form action="{{route('movies.comment')}}" method="post">
                                    @csrf
                                    <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                                        <div class="d-flex flex-start w-100">
                                            <img class="rounded-circle shadow-1-strong me-3"
                                                 src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp"
                                                 alt="avatar"
                                                 width="40"
                                                 height="40"/>
                                            <div class="form-outline w-100">
                <textarea name="message" class="form-control" id="textAreaExample" rows="4"
                          style="background: #fff;"></textarea>
                                            </div>
                                        </div>
                                        <div class="float-end mt-2 pt-1">
                                            <input type="hidden" name="movie_id" value="{{$movie->id}}">
                                            <button type="submit" class="btn btn-primary btn-sm">Post comment</button>
                                        </div>
                                    </div>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
    </body>
    </html>

@endsection
