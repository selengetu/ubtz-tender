<div class="modal fade" id="tenderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Тендер бүртгэл</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formSub" action={{ route('saveTender') }}>
                <div class="modal-body">
               
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Шалгаруулалтын төрөл</label>
                                <select class="form-control" name="tenderselectioncode" id="tenderselectioncode" >
                                @foreach ($tendertype as $item)
                                        <option value="{{ $item->contracttypecode }}">{{ $item->contracttypename }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Тендерийн №</label>
                                <input type="text" class="form-control" id="tenderno" name="tenderno" placeholder="Тендерийн №">
                                <input type="hidden" class="form-control" id="order_id" name="order_id" placeholder="Тендерийн №">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Төрөл</label>
                                <select class="form-control" name="tendertypecode" id="tendertypecode" >
                                @foreach ($type as $item)
                                        <option value="{{ $item->tendertypecode }}">{{ $item->tendertypename }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Зарлагдсан огноо</label>
                                <input type="date" class="form-control" id="tender_call_at" name="tender_call_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Батлагдсан төсөвт өртөг</label>
                                <input type="number" class="form-control" id="tender_budget" name="tender_budget" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Урилгын №</label>
                                <input type="text" class="form-control" id="tender_invitationcode" name="tender_invitationcode">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Урилгын огноо</label>
                                <input type="date" class="form-control" id="tender_invitation_at" name="tender_invitation_at" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Тендер нээх хугацаа</label>
                                <input type="date" class="form-control" id="tender_open_at" name="tender_open_at">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Хүчинтэй хугацаа</label>
                                <input type="date" class="form-control" id="tender_validdate" name="tender_validdate">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="jobname">Багцын тоо</label>
                                <input type="number" class="form-control" id="packcount" name="packcount">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Үнэлгээ</label>
                                <input type="text" class="form-control" id="assessment" name="assessment">
                            </div>
                        </div> 
                        <div class="col-8">
                            <div class="form-group">
                                <label for="jobname">Тендерт оролцогч</label>
                                <input type="text" class="form-control" id="tender_player" name="tender_player" placeholder="Тендерт оролцогч">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Тендерийн явц</label>
                                <select class="form-control" name="tender_state" id="tender_state" >
                                @foreach ($tenderstate as $item)
                                        <option value="{{ $item->state_id }}">{{ $item->state_name }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Үнэлгээ хийсэн огноо</label>
                                <input type="date" class="form-control" id="assessment_at" name="assessment_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Мэдэгдэл тараасан огноо</label>
                                <input type="date" class="form-control" id="statement_at" name="statement_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Гэрээ байгуулах эрх огноо</label>
                                <input type="date" class="form-control" id="contract_at" name="contract_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Түдгэлзүүлсэн огноо</label>
                                <input type="date" class="form-control" id="suspended_at" name="suspended_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Гомдол гаргасан огноо</label>
                                <input type="date" class="form-control" id="complaint_at" name="complaint_at" >
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Тайлбар</label>
                                <input type="text" class="form-control" id="tender_comment" name="tender_comment" placeholder="Тайлбар">
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