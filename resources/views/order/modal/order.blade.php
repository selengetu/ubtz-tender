<div class="modal fade" id="depModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Захиалга бүртгэл</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formSub" action={{ route('saveOrder') }}>
                <div class="modal-body">
               
                    <div class="row">
                       
                        <div class="col-12">
                            <div class="form-group">
                                 <label>Худалдан авах ажил, үйлчилгээний нэр</label>
                                <input type="text" class="form-control" id="order_name" name="order_name" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                 <label>Байгууллага</label>
                                <select class="form-control" name="order_dep" id="order_dep" >
                                @foreach ($deps as $item)
                                        <option value="{{ $item->dep_id }}">{{ $item->dep_name }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                 <label>Хэмжих нэгж</label>
                                <select class="form-control" name="order_unit" id="order_unit" >
                                @foreach ($unit as $item)
                                        <option value="{{ $item->unit_id }}">{{ $item->unit_name }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                 <label>Тоо хэмжээ</label>
                                <input type="number" class="form-control" id="order_count" name="order_count">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                 <label>Мөрдөх журам</label>
                                <select class="form-control" name="order_selection" id="order_selection" >
                                @foreach ($selection as $item)
                                        <option value="{{ $item->tenderselectioncode }}">{{ $item->tenderselectionabbr }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                 <label>Эх үүсвэр</label>
                                <select class="form-control" name="order_budget_source" id="order_budget_source" >
                                @foreach ($source as $item)
                                        <option value="{{ $item->source_id }}">{{ $item->source_name }}</option>
                                    @endforeach
                            </select>
                             
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Төсөвт өртөг</label>
                                <input type="text" class="form-control money" id="order_budget" name="order_budget">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Тухайн онд санхүүжих</label>
                                <input type="text" class="form-control money" id="order_thisyear" name="order_thisyear">
                            </div>
                        </div>
                     
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Захиалга өгсөн</label>
                                <input type="date" class="form-control" id="order_date" name="order_date" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Ажилтан</label>
                                <select class="form-control" name="order_employee" id="order_employee" >
                                @foreach ($employee as $item)
                                        <option value="{{ $item->id }}">{{ $item->fullname }}</option>
                                    @endforeach
                            </select>
                             
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Захиалга батлагдсан</label>
                                <input class="form-control" type="file" id="formFile">
                            </div>
                        </div>
                       
                        <div class="col-12">
                            <div class="form-group">
                                 <label>Тайлбар</label>
                                <input type="text" class="form-control" id="order_comment" name="order_comment" placeholder="Тайлбар">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="order_id" name="order_id" class="order_id">
                    @csrf
                    <button type="button" class="btn btn-danger" onclick="delOrder()">Устгах</button>
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>