@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Hesap Ayarları
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/account/settings') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="username">Kullanıcı Adı</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{ auth()->user()->username }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ auth()->user()->email }}" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Şifre</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <small class="form-text text-muted">Şifrenizi değiştirmek istemiyorsanız boş
                                    bırakın.</small>
                            </div>

                            <div class="form-group">
                                <label for="profile_photo">Profil Fotoğrafı</label>
                                @if (auth()->user()->profile_photo_path)
                                    <div class="mb-3">
                                        <img src="{{ Storage::url(auth()->user()->profile_photo_path) }}"
                                            alt="Profile Photo" class="img-thumbnail" width="150">
                                    </div>
                                @endif
                                <input type="file" class="form-control-file" id="profile_photo" name="profile_photo"
                                    accept="image/jpeg,image/png,image/jpg">
                            </div>
                            <button type="submit" class="btn btn-primary">Güncelle</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
