<div class="modal fade" id="komissModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="detail-title" id="exampleModalLabel">Тендерийн комиссийн мэдээллийн бүртгэл</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formKomiss" action={{ route('saveKomiss') }}>
                <div class="modal-body">
               
                    <div class="row">
                        
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Ажилтаны нэр</label>
                                <input type="text" class="form-control" id="komiss_employee" name="komiss_employee" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Албан тушаал</label>
                                <input type="hidden" class="form-control" id="komiss_tender" name="komiss_tender">
                                <input type="text" class="form-control" id="komiss_job" name="komiss_job">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Огноо</label>
                                <input type="text" class="form-control" id="komiss_date" name="komiss_date">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Тайлбар</label>
                                <input type="text" class="form-control" id="komiss_comment" name="komiss_comment">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="komiss_id" name="komiss_id">
                    @csrf
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>