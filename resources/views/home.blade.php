@extends('layouts.app')

@section('content')

<main class="container-fluid">
    <main class="container-fluid">
        @if(session('updated'))
        <div class="alert alert-dark" role="alert">
            {{ session('updated') }}
        </div>
        @endif
        @isset($matiere)
        <h2 class="text-dark" style="text-align: center" id="text-title mb-3">{{ $matiere->name }}</h2>
        @endif
        @isset($user)
        <h2 class="text-dark" style="text-align: center" id="text-title mb-3">
            @lang('Retrouvez tous les cours publiés par') {{ $user->name }}.</h2>
        @endif
        @isset($professeur)
        <h2 class="text-dark" style="text-align: center" id="text-title mb-3">@lang('Les cours dispensées par')
            {{ $professeur->name }}</h2>
        @endif
        <div class="d-flex justify-content-center">
            {{ $lecons->links() }}
        </div>
        @foreach($lecons as $lecon)
        <div id="lecon{{ $lecon->id }}">
            <a href="{{ url('lecons/' . $lecon->name) }}" class="lecon-link"
                data-link="{{ route('lecon.click', $lecon->id) }}">
            </a>
        </div>
        @endforeach
        <div class="row mb-2">
            @foreach ($lecons as $lecon)
            <div class="col-md-6">
                <div class="card flex-md-row mb-4 box-shadow h-md-250">
                    <div class="card-body d-flex flex-column align-items-start">
                        <strong class="d-inline-block mb-2 text-primary">{{$lecon->matiere->name}}</strong>
                        <h3 class="mb-0">
                            <a class="text-dark">{{$lecon->titre}}</a>
                        </h3>
                        <div class="mb-1 text-muted">@lang('Publié') @lang('le')
                            {{ $lecon->created_at->formatLocalized('%d %B %Y') }} @lang('à')
                            {{ $lecon->created_at->formatLocalized('%H:%M') }} @lang('par') {{$lecon->user->name}}
                        </div>
                        <p class="card-text mb-auto">{{$lecon->description}}</p>
                        <a class="mb-1 text-muted href=" href="{{ route('user', $lecon->user->id) }}">
                            @lang('En voir plus...')</a>
                        @isset($professeur)
                        <div class="mb-1 text-muted">@lang('Cours dispensée par') {{ $professeur->name}}</div>
                        @endisset
                        <div class="pull-right">

                            <em>
                                (<span class="lecon-click">{{ $lecon->clicks }}</span>
                                {{ trans_choice(__('vue|vues'), $lecon->clicks) }})
                                {{ $lecon->created_at->formatLocalized('%x') }}
                            </em>
                        </div>
                        <div class="star-rating" id="{{ $lecon->id }}">
                            <span class="count-number">({{ $lecon->users->count() }})</span>
                            <div id="{{ $lecon->id . '.5' }}" data-toggle="tooltip" title="5" @if($lecon->rate >
                                4)
                                class="star-yellow" @endif>
                                <i class="fas fa-star"></i>
                            </div>
                            <div id="{{ $lecon->id . '.4' }}" data-toggle="tooltip" title="4" @if($lecon->rate >
                                3)
                                class="star-yellow" @endif>
                                <i class="fas fa-star"></i>
                            </div>
                            <div id="{{ $lecon->id . '.3' }}" data-toggle="tooltip" title="3" @if($lecon->rate >
                                2)
                                class="star-yellow" @endif>
                                <i class="fas fa-star"></i>
                            </div>
                            <div id="{{ $lecon->id . '.2' }}" data-toggle="tooltip" title="2" @if($lecon->rate >
                                1)
                                class="star-yellow" @endif>
                                <i class="fas fa-star"></i>
                            </div>
                            <div id="{{ $lecon->id . '.1' }}" data-toggle="tooltip" title="1" @if($lecon->rate >
                                0)
                                class="star-yellow" @endif>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="pull-right">
                                @adminOrOwner($lecon->user_id)
                                <a class="toggleIcons" href="#">
                                    <i class="fa fa-cog"></i>
                                </a>
                                <span class="menuIcons" style="display: none">
                                    <a class="form-delete text-danger" href="{{ route('lecon.destroy', $lecon->id) }}"
                                        data-toggle="tooltip" title="@lang('Supprimer ce cours')">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                    <a class="description-manage" href="{{ route('lecon.description', $lecon->id) }}"
                                        data-toggle="tooltip" title="@lang('Gérer la description')">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="matiere-edit" data-id="{{ $lecon->matiere_id }}"
                                        href="{{ route('lecon.update', $lecon->id) }}" data-toggle="tooltip"
                                        title="@lang('Changer de matière')">
                                        <i class="fas fa-compress-alt"></i>
                                    </a>
                                    <a class="professeurs-manage" href="{{ route('lecon.professeurs', $lecon->id) }}"
                                        data-toggle="tooltip" title="@lang('Qui enseigne ce cours')">
                                        <i class="fas fa-user-tie"></i> </a>
                                </span>
                                <form action="{{ route('lecon.destroy', $lecon->id) }}" method="POST" class="hide">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @endadminOrOwner
                            </span>
                        </div>
                    </div>
                    <img class=img-responsive src="{{ url('storage\app\public' . $lecon->name) }}">
                </div>
            </div>

            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $lecons->links() }}
        </div>
    </main>

    <div class="modal fade" id="changeMatiere" tabindex="-1" role="dialog" aria-labelledby="matiereLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="matiereLabel">@lang('Changement de la matière')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            @isset($matieres)
                            <select class="form-control" name="matiere_id">
                                @foreach($matieres as $matiere)
                                <option value="{{ $matiere->id }}">{{ $matiere->name }}</option>
                                @endforeach
                            </select>
                            @endisset
                        </div>
                        <button type="submit" class="btn btn-primary">@lang('Envoyer')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changeDescription" tabindex="-1" role="dialog" aria-labelledby="descriptionLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="descriptionLabel">@lang('Changement de la description')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="descriptionForm" action="" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="description" id="description">
                            <small class="invalid-feedback"></small>
                        </div>
                        <button type="submit" class="btn btn-primary">@lang('Envoyer')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProfesseurs" tabindex="-1" role="dialog" aria-labelledby="professeurLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="professeurLabel">@lang("Qui dispense ce cours")</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="manageProfesseurs" action="" method="POST">
                        <div class="form-group" id="listeProfesseurs"></div>
                        <button type="submit" class="btn btn-primary">@lang('Envoyer')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @section('script')

    <script>
        $(() =>{
            $('a.matiere-edit').click((e) => {
            e.preventDefault()
            let that = $(e.currentTarget)
            $('select').val(that.attr('data-id'))
            $('#editForm').attr('action', that.attr('href'))
            $('#changeMatiere').modal('show')
            })

                const swallAlertServer = () => {
                    swal.fire({
                        title: '@lang('Il semble y avoir une erreur sur le serveur, veuillez réessayer plus tard...')',
                        type: 'warning'
                    })
                }

                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                })

                $('.site-wrapper').fadeOut(1000)

                $('[data-toggle="tooltip"]').tooltip()

                $('.card-columns').magnificPopup({
                    delegate: 'a.lecon-link',
                    type: 'lecon',
                    tClose: '@lang("Fermer (Esc)")'@if($lecons->count() > 1),
                    gallery: {
                        enabled: true,
                        tPrev: '@lang("Précédent (Flèche gauche)")',
                        tNext: '@lang("Suivant (Flèche droite)")'
                    },
                    callbacks: {
                        buildControls: function () {
                            this.contentContainer.append(this.arrowLeft.add(this.arrowRight))
                        }
                    }@endif
                })

                $('a.toggleIcons').click((e) => {
                    e.preventDefault();
                    let that = $(e.currentTarget)
                    that.next().toggle('slow').end().children().toggleClass('fa-cog').toggleClass('fa-play')
                })

                $('a.form-delete').click((e) => {
                    e.preventDefault();
                    let href = $(e.currentTarget).attr('href')
                    swal.fire({
                        title: '@lang('Vraiment supprimer ce cours ?')',
                        type: 'error',
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: '@lang('Oui')',
                        cancelButtonText: '@lang('Non')'
                    }).then((result) => {
                        if (result.value) {
                            $("form[action='" + href + "'").submit()
                        }
                    })
                })

                $('a.description-manage').click((e) => {
                    e.preventDefault()
                    let that = $(e.currentTarget)
                    let text = that.parents('.card').find('.card-text').text()
                    $('#description').val(text)
                    $('#descriptionForm').attr('action', that.attr('href')).find('input').removeClass('is-invalid').next().text()
                    $('#changeDescription').modal('show')
                })

                $('#descriptionForm').submit((e) => {
                    e.preventDefault()
                    let that = $(e.currentTarget)
                    $.ajax({
                        method: 'put',
                        url: that.attr('action'),
                        data: that.serialize()
                    })
                        .done((data) => {
                            let card = $('#lecon' + data.id)
                            let body = card.find('.card-body')
                            if(body.length) {
                                body.children().text(data.description)
                            } else {
                                card.children('a').after('<div class="card-body"><p class="card-text">' + data.description + '</p></div>')
                            }
                            $('#changeDescription').modal('hide')
                        })
                        .fail((data) => {
                            if(data.status === 422) {
                                $.each(data.responseJSON.errors, function (key, value) {
                                    $('#descriptionForm input[name=' + key + ']').addClass('is-invalid').next().text(value)
                                })
                            } else {
                                swallAlertServer()
                            }
                        })
                })

                $('a.category-edit').click((e) => {
                    e.preventDefault()
                    let that = $(e.currentTarget)
                    $('select').val(that.attr('data-id'))
                    $('#editForm').attr('action', that.attr('href'))
                    $('#changeCategory').modal('show')
                })

                $('a.adult-edit').click((e) => {
                    e.preventDefault()
                    let that = $(e.currentTarget)
                    let icon = that.children()
                    let adult = icon.hasClass('fa-graduation-cap')
                    if(adult) {
                        icon.removeClass('fa-graduation-cap')
                    } else {
                        icon.removeClass('fa-child')
                    }
                    icon.addClass('fa-cog fa-spin')
                    adult = !adult
                    $.ajax({
                        method: 'put',
                        url: that.attr('href'),
                        data: { adult: adult }
                    })
                        .done(() => {
                            that.tooltip('hide')
                            let icon = that.children()
                            icon.removeClass('fa-cog fa-spin')
                            let card = that.parents('.card')
                            if(adult) {
                                icon.addClass('fa-graduation-cap')
                                card.addClass('border-danger')
                            } else {
                                icon.addClass('fa-child')
                                card.removeClass('border-danger')
                            }
                        })
                        .fail(() => {
                            swallAlertServer()
                        })
                })

                $('a.professeurs-manage').click((e) => {

                    $('a.professeurs-manage').click((e) => {
                    e.preventDefault()
                    let that = $(e.currentTarget)
                    that.tooltip('hide')
                    that.children().removeClass("fas fa-user-tie").addClass('fa-cog fa-spin')
                    e.preventDefault()
                    $.get(that.attr('href'))
                    .done((data) => {
                    that.children().addClass("fas fa-user-tie").removeClass('fa-cog fa-spin')
                    $('#listeProfesseurs').html(data)
                    $('#manageProfesseurs').attr('action', that.attr('href'))
                    $('#editProfesseurs').modal('show')
                    })
                    .fail(() => {
                    that.children().addClass("fas fa-user-tie").removeClass('fa-cog fa-spin')
                    swallAlertServer()
                    })
                    })

                    e.preventDefault()
                    let that = $(e.currentTarget)
                    that.tooltip('hide')
                    that.children().removeClass("fas fa-user-tie").addClass('fa-cog fa-spin')
                    e.preventDefault()
                    $.get(that.attr('href'))
                        .done((data) => {
                            that.children().addClass("fas fa-user-tie").removeClass('fa-cog fa-spin')
                            $('#listeProfesseurs').html(data)
                            $('#manageProfesseurs').attr('action', that.attr('href'))
                            $('#editProfesseurs').modal('show')
                        })
                        .fail(() => {
                            that.children().addClass("fas fa-user-tie").removeClass('fa-cog fa-spin')
                            swallAlertServer()
                        })
                })

                $('#manageProfesseurs').submit((e) => {
                    e.preventDefault()
                    let that = $(e.currentTarget)
                    $.ajax({
                        method: 'put',
                        url: that.attr('action'),
                        data: that.serialize()
                    })
                        .done((data) => {
                            if(data === 'reload') {
                                location.reload();
                            } else {
                                $('#editProfesseurs').modal('hide')
                            }
                        })
                        .fail(() => {
                            swallAlertServer()
                        })
                })

                let memoStars = []

                $('.star-rating div').click((e) => {
                    @auth
                        let element = $(e.currentTarget)
                        let values = element.attr('id').split('.')
                        element.addClass('fa-spin')
                        $.ajax({
                            url: "{{ url('rating') }}" + '/' + values[0],
                            type: 'PUT',
                            data: {value: values[1]}
                        })
                        .done((data) => {
                            if (data.status === 'ok') {
                                let lecon = $('#' + data.id)
                                memoStars = []
                                lecon.children('div')
                                    .removeClass('star-yellow')
                                    .each(function (index, element) {
                                        if (data.value > 4 - index) {
                                            $(element).addClass('star-yellow')
                                            memoStars.push(true)
                                        }
                                        memoStars.push(false)
                                    })
                                    .end()
                                    .find('span.count-number')
                                    .text('(' + data.count + ')')
                                if(data.rate) {
                                    if(data.rate == values[1]) {
                                        title = '@lang("Vous avez déjà donné ce note !")'
                                    } else {
                                        title = '@lang("Votre vote a été modifié !")'
                                    }
                                } else {
                                    title = '@lang("Merci pour votre vote !")'
                                }
                                swal.fire({
                                    title: title,
                                    type: 'warning'
                                })
                            } else {
                                swal.fire({
                                    title: '@lang('Vous ne pouvez pas voter pour vos cours !')',
                                    type: 'error'
                                })
                            }
                            element.removeClass('fa-spin')
                        })
                        .fail(() => {
                            swallAlertServer()
                            element.removeClass('fa-spin')
                        })
                    @else
                        swal.fire({
                            title: '@lang('Vous devez être connecté pour pouvoir voter !')',
                            type: 'error'
                        })
                    @endauth
                })

                $('.star-rating').hover(
                    (e) => {
                        memoStars = []
                        $(e.currentTarget).children('div')
                            .each((index, element) => {
                                memoStars.push($(element).hasClass('star-yellow'))
                            })
                            .removeClass('star-yellow')
                 }, (e) => {
                    $.each(memoStars, (index, value) => {
                        if(value) {
                            $(e.currentTarget).children('div:eq(' + index + ')').addClass('star-yellow')
                        }
                    })
                })

                $('a.lecon-link').click((e) => {
                    e.preventDefault()
                    let that = $(e.currentTarget)
                    $.ajax({
                        method: 'patch',
                        url: that.attr('data-link')
                    }).done((data) => {
                        if(data.increment) {
                            let numberElement = that.siblings('div.card-footer').find('.lecon-click')
                            numberElement.text(parseInt(numberElement.text()) + 1)
                        }
                    })
                })

            })
    </script>
    @endsection
