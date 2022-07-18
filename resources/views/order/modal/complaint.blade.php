<div class="modal fade" id="complaintModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Мэдэгдэл/Үнэлгээ бүртгэл</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formComplaint" action={{ route('saveComplaint') }}>
                <div class="modal-body">
               
                    <div class="row">
                        
                    <div class="col-4">
                            <div class="form-group">
                                <label for="jobname">Огноо</label>
                                <input type="date" class="form-control" id="complaint_date" name="complaint_date" >
                            </div>
                        </div>
                      
                        <div class="col-8">
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="complaint_tender" name="complaint_tender" >
                                <input type="hidden" class="form-control" id="complaint_order" name="complaint_order" >
                                <label for="jobname">Тайлбар</label>
                                <input type="text" class="form-control" id="complaint_comment" name="complaint_comment">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="complaint_id" name="complaint_id">
                    @csrf
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>