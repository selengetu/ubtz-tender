<div class="modal fade" id="contractprogressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Явцын мэдээлэл</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="formProgress" action={{ route('saveProgress') }}>
                <div class="modal-body">
               
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Огноо</label>
                                <input type="date" class="form-control" id="contract_progress_date" name="contract_progress_date" >
                                <input type="hidden" class="form-control" id="contract_progress_order" name="contract_progress_order" >
                                <input type="hidden" class="form-control" id="contract_progress_tender" name="contract_progress_tender" >
                            </div>
                        </div>
                       
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Тендерийн явц</label>
                                <select class="form-control" name="contract_progress_state" id="contract_progress_state" >
                                @foreach ($tenderstate as $item)
                                        <option value="{{ $item->state_id }}">{{ $item->state_name }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                      
                        <div class="col-12">
                            <div class="form-group">
                                 <label>Тайлбар</label>
                                <input type="text" class="form-control" id="contract_progress_comment" name="contract_progress_comment">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="contract_progress_id" name="contract_progress_id">
                    @csrf
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>