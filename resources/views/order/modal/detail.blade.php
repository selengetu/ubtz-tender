<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="detail-title" id="exampleModalLabel">Захиалгын дэлгэрэнгүй мэдээллийн бүртгэл</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formDetail" action={{ route('saveOrderDetail') }}>
                <div class="modal-body">
               
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Алба хэлтэс</label>
                                <select class="form-control" name="dep_id" id="dep_id" >
                                @foreach ($dep as $item)
                                        <option value="{{ $item->dep_id }}">{{ $item->executor_name }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Тоо хэмжээ</label>
                                <input type="text" class="form-control" id="dorder_count_detail" name="dorder_count_detail" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Төсөвт өртөг</label>
                                <input type="hidden" class="form-control" id="dorder_id" name="dorder_id" class="order_id">
                                <input type="text" class="form-control money" id="dorder_budget" name="dorder_budget">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Гүйцэтгэл</label>
                                <input type="text" class="form-control" id="dorder_performance" name="dorder_performance">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="detail_id" name="detail_id">
                    <button type="button" class="btn btn-danger" onclick="delDetail()">Устгах</button>
                    @csrf
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>