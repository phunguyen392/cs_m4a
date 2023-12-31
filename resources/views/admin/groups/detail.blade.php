@extends('admin.master')
@section('content')
    <main class="page-content">
        <div class="container">
            <section class="wrapper">
                <main id="main" class="main">
                    <div class="panel-panel-default">
                        <div class="market-updates">
                            <div class="container">
                               
                                <div class="page-section">
    
                                    <form method="post" action="{{ route('groups.group_details', $group->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="card">
                                            <div class="card-body">
                                        <h1 style="color: blue" class=" text-center">{{ __('language.po') }}</h1>
                                                
                                                <hr>
                                                <div class="form-group">
                                                    <label for="tf1">Tên Quyền:</label> {{ $group->name }}
                                                </div><br>
                                                <div class="form-group">

                                                    <input type="checkbox" id="checkAll" class="form-check-input"
                                                        value="Quyền hạn">
                                                    <label class="w3-button w3-blue">{{ __('Cấp toàn bộ quyền') }}
                                                        <div class="row">
                                                            @foreach ($group_names as $group_name => $roles)
                                                                <div class="col-lg-6">
                                                                    <div class="list-group-header"
                                                                        style="color:rgb(2, 6, 249) ;">
                                                                        <h5> Nhóm: {{ __($group_name) }}</h5>
                                                                    </div>
                                                                    @foreach ($roles as $role)
                                                                        <div
                                                                            class="list-group-item d-flex justify-content-between align-items-center">
                                                                            <span
                                                                                style="color: rgb(203, 25, 203) ;">{{ __($role['name']) }}</span>
                                                                            <!-- .switcher-control -->
                                                                            <label class="form-check form-switch ">
                                                                                <input type="checkbox"
                                                                                    @checked(in_array($role['id'], $userRoles))
                                                                                    name="roles[]"
                                                                                    class="checkItem form-check-input checkItem"
                                                                                    value="{{ $role['id'] }}">
                                                                                <span class="switcher-indicator"></span>
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                </div>

                                            </div>
                                        </div>
                                    <div class="form-actions">
                                        <button class="btn btn-success" type="submit">{{ __('language.au') }}</button>
                                        <a href="{{ route('groups.index') }}" class="btn btn-danger" type="submit">{{ __('language.back') }}</a>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>

                </main>
                <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
                <script>
                    $('#checkAll').click(function() {
                        $(':checkbox.checkItem').prop('checked', this.checked);
                    });
                </script>
            </section>
        </div>
        </div>
    </main>
@endsection
