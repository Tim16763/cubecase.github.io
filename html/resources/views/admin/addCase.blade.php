@extends('admin.layout')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="wraper container">
                <div class="row">
                    <div class="col-lg-9 col-md-8">
                        <div class="card-box">
                            <form class="form-horizontal group-border-dashed" action="/admin/addCasePost" novalidate="">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Название кейса</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" placeholder="Кейс №1" name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Старая стоимость кейса</label>
                                    <div class="col-sm-6">
                                        <input type="number" value="0" class="form-control" required="" placeholder="20" name="oldp">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Стоимость кейса</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" required="" placeholder="20" name="price">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ссылка на изображение</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="" placeholder="/images/uploads/50.png" name="img">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Предметы в кейсе</label>
                                    <div class="col-sm-6">
                                        <select class="select2 select2-multiple" multiple="multiple" multiple name="items[]" data-placeholder="Выберите предметы ...">
                                            @foreach ($items as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9 m-t-15">
                                        <button type="submit" class="btn btn-primary">
                                            Создать
                                        </button>
                                        <button type="reset" class="btn btn-default m-l-5">
                                            Отмена
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection