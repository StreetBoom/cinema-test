@extends('layouts.main')
@section('navBar')

    <main>
        <section class="py-5 text-center container ">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Filter page</h1>
                    <p class="lead text-muted">Список фильмов по вашим фильтрам</p>
                </div>
            </div>
        </section>
        <div style="background-image: url('https://look.com.ua/pic/201209/2560x1600/look.com.ua-36303.jpg');">
            <div class="row">

                <form method="POST" action="{{ route('movies.filter') }}">
                    @csrf
                    <input type="date" name="release_after" placeholder="После даты">
                    <input type="date" name="release_before" placeholder="До даты">
                    <input type="number" name="rating_min" placeholder="Минимальный рейтинг">
                    <input type="number" name="rating_max" placeholder="Максимальный рейтинг">
                    <select name="actors[]" multiple>
                        <option value="">Выберите актеров</option>
                        @foreach ($actors as $actor)
                            <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                        @endforeach
                    </select>
                    <select name="director_id">
                        <option value="">Выберите режиссёров</option>
                        @foreach ($directors as $director)
                            <option value="{{ $director->id }}">{{ $director->name }}</option>
                        @endforeach
                    </select>
                    <div><select name="sort_by">
                            <option value="release">Дата выхода</option>
                            <option value="rating">Рейтинг</option>
                        </select>
                        <select name="sort_order">
                            <option value="asc">По возрастанию</option>
                            <option value="desc">По убыванию</option>
                        </select>
                    </div>
                    <button type="submit">Фильтр</button>
                </form>

                @foreach ($movies as $movie)
                    <div class="col-md-4 mb-1">
                        <div class="album py-3 ">
                            <div class="container ">
                                <div class="col">
                                    <div class="card shadow-sm">
                                        <img
                                            src="{{$movie->image}}"
                                            class="bd-placeholder-img card-img-top" alt="">
                                        <div class="card-body">
                                            <h6 class="card-text">{{$movie->name}}</h6>
                                            <p class="card-text">Режиссер: {{$movie->director->name}}</p>
                                            <div class="d-flex justify-content-between align-items-center ">
                                                <div class="btn-group rounded-3 ">
                                                    <a href="{{route('movies.show', $movie->id)}}" type="button"
                                                       class="text-center btn btn-sm btn-outline-secondary p-3 ">Описание
                                                        фильма
                                                    </a>
                                                    <div
                                                        class="p-3 text-primary-emphasis bg-primary-subtle border border-primary-subtle ">
                                                        Рейтинг: {{$movie->rating}}*
                                                    </div>
                                                </div>

                                                <small class="text-muted rounded-3">Дата выхода:{{$movie->release}}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($loop->iteration % 3 == 0)
            </div>
            <div class="row">
                @endif
                @endforeach
                {{ $movies->links() }}
            </div>
        </div>

    </main>
@endsection

