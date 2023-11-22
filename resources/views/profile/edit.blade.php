@extends('layouts.main')
@section('navBar')
<div class="mb-5" ></div>
    <div class="album py-3 ">
        <div class="container ">
            <div class="d-flex justify-content-between align-items-center ">
                <div class="btn-group rounded-3 ">
                    <p class="lead mb-0 p-3  rounded-3 ">
                        <a class=" fw-bold"
                           data-bs-toggle="modal"
                           data-bs-target="#exampleModal">
                            Изменить данные пользователя
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
                                    <div class="py-12">
                                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                                            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                                                <div class="max-w-xl">
                                                    @include('profile.partials.update-profile-information-form')
                                                </div>
                                            </div>

                                            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                                                <div class="max-w-xl">
                                                    @include('profile.partials.update-password-form')
                                                </div>
                                            </div>

                                            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                                                <div class="max-w-xl">
                                                    @include('profile.partials.delete-user-form')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="background-image: url('https://look.com.ua/pic/201209/2560x1600/look.com.ua-36303.jpg');">
                <h5>Список фильмов которым вы поставили оценки или коментировали </h5>
                <div class="row">
                    @foreach ($movies as $movie)
                        <div class="col-md-4 mb-1">
                            <div class="album py-3 ">
                                <div class="container ">
                                    <div class="col">
                                        <div class="card shadow-sm">
                                            <img
                                                src="https://hdwpro.com/wp-content/uploads/2022/01/Simple-Black-Wallpaper-1366x768.jpg"
                                                class="bd-placeholder-img card-img-top" alt="pizda">
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
                                                    <small class="text-muted rounded-3">Дата
                                                        выхода:{{$movie->release}}</small>
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
                </div>
            </div>


@endsection
