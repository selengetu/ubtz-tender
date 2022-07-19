<div class="modal fade" id="tenderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Тендер бүртгэл</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formTender" action={{ route('saveTender') }}>
                <div class="modal-body">
               
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Шалгаруулалтын төрөл</label>
                                <select class="form-control" name="tenderselectioncode" id="tenderselectioncode" >
                                @foreach ($tendertype as $item)
                                        <option value="{{ $item->contracttypecode }}">{{ $item->contracttypename }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Тендерийн №</label>
                                <input type="text" class="form-control" id="tenderno" name="tenderno" placeholder="Тендерийн №">
                                <input type="hidden" class="form-control" id="torder_id" name="torder_id" class="order_id" placeholder="Тендерийн №">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Төрөл</label>
                                <select class="form-control" name="tendertypecode" id="tendertypecode" >
                                @foreach ($type as $item)
                                        <option value="{{ $item->tendertypecode }}">{{ $item->tendertypename }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Зарлагдсан огноо</label>
                                <input type="date" class="form-control" id="tender_call_at" name="tender_call_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Батлагдсан төсөвт өртөг</label>
                                <input type="text" class="form-control money" id="tender_budget" name="tender_budget" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Урилгын №</label>
                                <input type="text" class="form-control" id="tender_invitationcode" name="tender_invitationcode">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                 <label>Урилгын огноо</label>
                                <input type="date" class="form-control" id="tender_invitation_at" name="tender_invitation_at" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                 <label>Тендер нээх хугацаа</label>
                                <input type="date" class="form-control" id="tender_open_at" name="tender_open_at">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                 <label>Хүчинтэй хугацаа</label>
                                <input type="date" class="form-control" id="tender_validdate" name="tender_validdate">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                 <label>Багцын тоо</label>
                                <input type="number" class="form-control" id="packcount" name="packcount">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Үнэлгээ</label>
                                <input type="text" class="form-control" id="assessment" name="assessment">
                            </div>
                        </div> 
                       
                     
                       
                        <div class="col-8">
                            <div class="form-group">
                                 <label>Тайлбар</label>
                                <input type="text" class="form-control" id="tender_title" name="tender_title" placeholder="Тайлбар">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="tender_id" name="tender_id">
                    @csrf
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>