<div class="modal fade" id="depModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formSub" action={{ route('saveOrder') }}>
                <div class="modal-body">
               
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Байгууллага</label>
                                <select class="form-control" name="order_dep" id="order_dep" >
                                @foreach ($dep as $item)
                                        <option value="{{ $item->depid }}">{{ $item->department_abbr }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Хариуцсан ажилтан</label>
                                <input type="text" class="form-control" id="order_employee" name="order_employee" placeholder="Хариуцсан ажилтан">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Албан тушаал</label>
                                <input type="text" class="form-control" id="order_job" name="order_job" >
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Худалдан авах ажил, үйлчилгээний нэр</label>
                                <input type="text" class="form-control" id="order_name" name="order_name" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Хэмжих нэгж</label>
                                <select class="form-control" name="order_unit" id="order_unit" >
                                @foreach ($unit as $item)
                                        <option value="{{ $item->unit_id }}">{{ $item->unit_name }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Тоо хэмжээ</label>
                                <input type="number" class="form-control" id="order_count" name="order_count">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Мөрдөх журам</label>
                                <select class="form-control" name="order_selection" id="order_selection" >
                                @foreach ($selection as $item)
                                        <option value="{{ $item->tenderselectioncode }}">{{ $item->tenderselectionabbr }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Эх үүсвэр</label>
                                <input type="text" class="form-control" id="order_budget_source" name="order_budget_source">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Төсөвт өртөг</label>
                                <input type="text" class="form-control" id="order_budget" name="order_budget">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Тухайн онд санхүүжих</label>
                                <input type="text" class="form-control" id="order_thisyear" name="order_thisyear">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Төлөв</label>
                                <select class="form-control" name="order_state" id="order_state" >
                                @foreach ($mstate as $item)
                                        <option value="{{ $item->state_id }}">{{ $item->state_name }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div> 
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Захиалга өгсөн</label>
                                <input type="date" class="form-control" id="order_date" name="order_date" >
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <label for="jobname">Захиалга батлагдсан</label>
                                <input class="form-control" type="file" id="formFile">
                            </div>
                        </div>
                     
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Тайлбар</label>
                                <input type="text" class="form-control" id="order_comment" name="order_comment" placeholder="Тайлбар">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="hid" name="hid">
                    <input type="hidden"  id="flg" name="flg">
                    @csrf
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>