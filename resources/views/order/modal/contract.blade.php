<div class="modal fade" id="contractModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Гэрээ бүртгэл</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formContract" action={{ route('saveContract') }}>
                <div class="modal-body">
               
                    <div class="row">
                        
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Гэрээний №</label>
                                <input type="text" class="form-control" id="tenderno" name="tenderno" placeholder="Тендерийн №">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Гэрээ байгуулсан огноо</label>
                                <input type="date" class="form-control" id="tender_call_at" name="tender_call_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Хүчинтэй хугацааг</label>
                                <input type="date" class="form-control" id="tender_budget" name="tender_budget" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Валют</label>
                                <input type="text" class="form-control" id="tender_invitationcode" name="tender_invitationcode">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Гэрээний дүн</label>
                                <input type="number" class="form-control" id="tender_invitation_at" name="tender_invitation_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Төлбөрийн нөхцөл</label>
                                <input type="text" class="form-control" id="tender_open_at" name="tender_open_at">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Төлбөрийн огноо</label>
                                <input type="date" class="form-control" id="tender_validdate" name="tender_validdate">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Төлбөр хийх хугацаа</label>
                                <input type="number" class="form-control" id="packcount" name="packcount">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Нийлүүлэх нөхцөл</label>
                                <input type="text" class="form-control" id="assessment" name="assessment">
                            </div>
                        </div> 
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Нийлүүлэх хугацаа</label>
                                <input type="date" class="form-control" id="tender_player" name="tender_player" placeholder="Тендерт оролцогч">
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <label for="jobname">Нийлүүлэгч</label>
                                <input type="text" class="form-control" id="assessment_at" name="assessment_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Алдангийн нөхцөл</label>
                                <input type="text" class="form-control" id="assessment_at" name="assessment_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Гэрээний хэрэгжилт</label>
                                <input type="text" class="form-control" id="statement_at" name="statement_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Тодруулга</label>
                                <input type="text" class="form-control" id="contract_at" name="contract_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Дүгнэлт</label>
                                <input type="text" class="form-control" id="suspended_at" name="suspended_at" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Санамж</label>
                                <input type="text" class="form-control" id="complaint_at" name="complaint_at" >
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jobname">Гэрээний төлөв</label>
                                <input type="text" class="form-control" id="tender_comment" name="tender_comment" placeholder="Тайлбар">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="contract_id" name="contract_id">
                    @csrf
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>