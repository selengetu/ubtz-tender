<div class="modal fade" id="progressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <input type="date" class="form-control" id="progress_date" name="progress_date" >
                                <input type="hidden" class="form-control" id="progress_order" name="progress_order" >
                                <input type="hidden" class="form-control" id="progress_tender" name="progress_tender" >
                            </div>
                        </div>
                       
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Тендерийн явц</label>
                                <select class="form-control" name="progress_state" id="progress_state" >
                                @foreach ($tenderstate as $item)
                                        <option value="{{ $item->state_id }}">{{ $item->state_name }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>
                      
                        <div class="col-12">
                            <div class="form-group">
                                 <label>Тайлбар</label>
                                <input type="text" class="form-control" id="progress_comment" name="progress_comment">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden"  id="progress_id" name="progress_id">
                    @csrf
                    <button type="button" class="btn btn-danger" onclick="delProgress()">Устгах</button>
                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                </div>
                </form>
            </div>
        </div>
        </div>