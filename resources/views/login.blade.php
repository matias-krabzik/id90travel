@extends('templates.template')

@section('styles')
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
@endsection

@section('content')
    <main class="form-signin w-100 m-auto">
        <form action="/login" method="POST">
            <h1 class="h3 mb-3 fw-normal">Login</h1>

            <div class="dropdown my-3">
                <select class="form-select" aria-label="Select de Aerolíneas" name="airline">
                    <option @if(is_null(old('airline', $data))) selected @endif>Seleccione una Aerolínea</option>
                    @foreach($data['airlines'] as $airline)
                        <option value="{{ $airline->code }}"
                                @if(old('airline', $data) == $airline->code) selected @endif>
                            {{ $airline->display_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-floating">
                <input name="username" type="text" class="form-control" id="floatingInput" placeholder="Usuario"
                       value="{{ old('username', $data) }}">
                <label for="floatingInput">Usuario</label>
            </div>
            <div class="form-floating">
                <input name="password" type="password" class="form-control" id="floatingPassword"
                       placeholder="Contraseña">
                <label for="floatingPassword">Contraseña</label>
            </div>

            @if(isset($data['error']))
                <p class="mt-3 text-danger">{{ $data['error'] }}</p>
            @endif

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me" name="remember_me"
                           @if(old('remember_me', $data)) checked @endif> Recordarme
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Ingresar</button>
        </form>
    </main>

@endsection
