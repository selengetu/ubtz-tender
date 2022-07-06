@extends('layouts.app')

@section('style')
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Тохиргоо мэдээлэл</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Нүүр хуудас</a></li>
                    <li class="breadcrumb-item active">Тохиргоо мэдээлэл</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                          
                                src="{{ asset('/img/user.png')}}"
                          
                                alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">{{ $info->last_name }} {{ $info->first_name }}</h3>

                        <p class="text-muted text-center">{{ $info->jobname }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                          
                            <li class="list-group-item">
                                <b>Утас № </b> <a class="float-right">{{ $info->phone }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Хэрэглэгчийн эрх </b> <a class="float-right">{{ $info->jobname }}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab"> <i
                                        class="fa fa-gear"> </i> Тохиргоо мэдээлэл</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">

                            <div class="tab-pane active show" id="settings">
                                    @if(Session::has('message'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('message') }}
                                    </div>
                                    @endif
                                <form class="form-horizontal" action='passw' method="POST">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Нэр</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="{{ Auth::user()->first_name }}"
                                                id="inputName" placeholder="Нэр">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Нэвтрэх нэр</label>
                                        <div class="col-sm-10">
                                            <input type="email" readonly value="{{ Auth::user()->email }}"
                                                class="form-control" id="inputEmail" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Нууц үг:</label>
                                        <div class="col-sm-10">
                                            <input type="password" required class="form-control" id="pass1" required name="pass1" aria-describedby="emailHelp" placeholder="Одоогийн нууц үг">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label style="color:red" class="col-sm-8 control-label">Таны нууц үг 8-аас багагүй урттай. Мөн дор хаяж 1 том үсэг, 1 жижиг үсэг, тоо, тусгай тэмдэгт агуулсан байх ёстой.</label>
                                        <label for="inputEmail" class="col-sm-4 control-label">Шинэ нууц үг:</label>
                                        <div class="col-sm-8">
                                            <input type="password" min="8" required class="form-control" id="pass2" required name="pass2" aria-describedby="emailHelp" placeholder="Шинэ нууц үг">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-4 control-label">Нууц үг / давтах /:</label>
                                        <div class="col-sm-8">
                                            <input type="password" min="8" required class="form-control" id="pass3" required name="pass3" aria-describedby="emailHelp" placeholder="Шинэ нууц үг давтах">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                                {{  @csrf_field() }}
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i>
                                                Хадгалах</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    <div>
    </div>
</section>
<!-- /.content -->


@endsection

@section('script')

<script>

</script>

@endsection
