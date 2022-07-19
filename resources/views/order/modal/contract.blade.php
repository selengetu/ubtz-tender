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
                                 <label>Гэрээний №</label>
                                <input type="text" class="form-control" id="contractno" name="contractno" placeholder="Гэрээний №">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Гэрээ байгуулсан огноо</label>
                                <input type="date" class="form-control" id="contract_date" name="contract_date" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Хүчинтэй хугацаа</label>
                                <input type="date" class="form-control" id="contract_duration_days" name="contract_duration_days" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Валют</label>
                                 <select class="form-control" name="currency" id="currency" >
                                @foreach ($currency as $item)
                                        <option value="{{ $item->currency_id }}">{{ $item->currency_abbr_name }}</option>
                                    @endforeach
                            </select>
        
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Гэрээний дүн</label>
                                <input type="number" class="form-control" id="contract_amount" name="contract_amount" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Төлбөрийн нөхцөл</label>
                                <input type="text" class="form-control" id="contract_condition" name="contract_condition">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Төлбөрийн огноо</label>
                                <input type="date" class="form-control" id="contract_payment_date" name="contract_payment_date">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Төлбөр хийх хугацаа</label>
                                <input type="number" class="form-control" id="contract_end_date" name="contract_end_date">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Нийлүүлэх нөхцөл</label>
                                <input type="text" class="form-control" id="supplier_condition" name="supplier_condition">
                            </div>
                        </div> 
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Нийлүүлэх хугацаа</label>
                                <input type="date" class="form-control" id="supplier_days" name="supplier_days" placeholder="q оролцогч">
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                 <label>Нийлүүлэгч</label>
                                <input type="text" class="form-control" id="supplier_name" name="supplier_name" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Алдангийн нөхцөл</label>
                                <input type="text" class="form-control" id="fine_condition" name="fine_condition" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Тодруулга</label>
                                <input type="text" class="form-control" id="fine_clarification" name="fine_clarification" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Дүгнэлт</label>
                                <input type="text" class="form-control" id="fine_conclusion" name="fine_conclusion" >
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                 <label>Санамж</label>
                                <input type="text" class="form-control" id="fine_reminder" name="fine_reminder" >
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