<div class="modal fade" id="packModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Багц бүртгэл</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formPack" action={{ route('savePack') }}>
                <div class="modal-body">
               
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Багцын нэр</label>
                                <input type="text" class="form-control" id="pack_name" name="pack_name">
                                <input type="hidden" class="form-control" id="pack_order_id" name="pack_order_id">
                                <input type="hidden" class="form-control" id="tender_list_id" name="tender_list_id" >
                            </div>
                        </div>
                    
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Огноо</label>
                                <input type="date" class="form-control" id="pack_date" name="pack_date" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Төсөвт өртөг</label>
                                <input type="text" class="form-control money" id="pack_budget" name="pack_budget" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                 <label>Гэрээ байгуулах эрх огноо</label>
                                <input type="date" class="form-control" id="pack_contract_at" name="pack_contract_at">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                 <label>Түдгэлзүүлсэн огноо</label>
                                <input type="date" class="form-control" id="pack_suspended_at" name="pack_suspended_at" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                 <label>Гомдол гаргасан огноо</label>
                                <input type="date" class="form-control" id="pack_complaint_at" name="pack_complaint_at">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="pack_id" name="pack_id">
                    @csrf
                    <button type="button" class="btn btn-danger" onclick="delPack()">Устгах</button>
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>