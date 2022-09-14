@extends('templates.app')

@section('content')

    <div class="card p-4">
        <h4>Buscar hoteles</h4>
        <hr>
        <form action="/search" method="GET">
            <div class="row align-items-center g-3">
                <div class="col-auto">
                    <label for="destination">Destino:</label>
                    <input type="text" class="form-control" id="destination" placeholder="Buenos Aires..."
                           value="{{ old('destination', $data) }}"
                           name="destination">
                </div>
                <div class="col-auto">
                    <label for="checkin">Desde:</label>
                    <input type="date" class="form-control" id="checkin" placeholder="Desde"
                           value="{{ old('checkin', $data) }}"
                           name="checkin">
                </div>
                <div class="col-auto">
                    <label for="checkout">Hasta:</label>
                    <input type="date" class="form-control" id="checkout" placeholder="Hasta"
                           value="{{ old('checkout', $data) }}"
                           name="checkout">
                </div>
                <div class="col-auto">
                    <label for="guests">Viajeros:</label>
                    <select class="form-select" aria-label="Select de Aerolíneas" id="guests" name="guests">
                        @for($i = 1; $i <= 4; $i++)
                            <option value="{{ $i }}"
                                    @if(old('guests', $data) == $i) selected @endif>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <br>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-5">
        @if($data["results"])
            @if(count($data['results']) > 0)
                <div class="card p-4">
                    @foreach($data['results'] as $hotel)
                        <div class="">
                            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                <div class="col-auto d-none d-lg-block" style="height: 15rem">
                                    <img src="https:{{ $hotel->image }}" style="width: auto; height: 100%" alt="{{ $hotel->name }}">
                                </div>
                                <div class="col p-4 d-flex flex-column position-static">
                                    <strong class="d-inline-block mb-2 text-primary">{{ $hotel->location->description }}</strong>
                                    <h3 class="mb-0">{{ $hotel->name }}</h3>
                                    <div class="mb-1 text-muted">{{ $hotel->location->city }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center p-5">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item @if($data['pagination']['page'] == 1) disabled @endif">
                                <a class="page-link" @if($data['pagination']['page'] > 1) href="{{ paginationUrl($data['pagination'], $data['pagination']['page'] -1) }}" @endif>Anterior</a>
                            </li>
                            @for($i = 1; $i <= $data['pagination']['total']; $i++)
                                <li class="page-item @if($data['pagination']['page'] == $i) active @endif">
                                    <a class="page-link" href="{{ paginationUrl($data['pagination'], $i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item @if($data['pagination']['page'] == $data['pagination']['total']) disabled @endif">
                                <a class="page-link"
                                   @if($data['pagination']['page'] < $data['pagination']['total'])
                                    href="{{ paginationUrl($data['pagination'], $data['pagination']['page'] +1) }}"
                                    @endif>Siguiente</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            @else
                <div class="card p-4 text-center">
                    <h4>No se encontraron resultados</h4>
                </div>
            @endif
        @else
            <div class="card p-4 text-center text-muted text-">
                <h4>Realice una búsqueda</h4>
            </div>
        @endif
    </div>

@endsection