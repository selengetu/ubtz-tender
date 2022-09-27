<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<script>
   $(document).ready( function () {
    $('#myTable tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="' + title + ' хайх" />');
    });
    $('.money').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: 2,
        autoGroup: true,

        rightAlign: false,
        oncleared: function () { self.Value(''); }
    });
    $('#myTable').DataTable(
        {
            stateSave: true,
            "language": {
                "lengthMenu": " _MENU_ бичлэг",
                "zeroRecords": "Бичлэг олдсонгүй",
                "info": "_PAGE_ ээс _PAGES_ хуудас" ,
                "infoEmpty": "Бичлэг олдсонгүй",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Хайлт:",
                "paginate": {
                    "first":      "Эхнийх",
                    "last":       "Сүүлийнх",
                    "next":       "Дараагийнх",
                    "previous":   "Өмнөх"
                },
            },
            "pageLength": 25
        } 
    );
    $('#formTender').submit(function(event){
        var order = $('#torder_id').val();
        event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'saveTender',
                data: $('form#formTender').serialize(),
                success: function(){
                    alert('Амжилттай');
                   getTenders(order);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 500) {
                        alert('Internal error: ' + jqXHR.responseText);
                    } else {
                        alert('Unexpected error.');
                    }
                }
            })  
    });
    $('#formKomiss').submit(function(event){
        var tender = $('#komiss_tender').val();
        event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'saveKomiss',
                data: $('form#formKomiss').serialize(),
                success: function(){
                    alert('Амжилттай');
                    gettenderkomisses(tender);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 500) {
                        alert('Internal error: ' + jqXHR.responseText);
                    } else {
                        alert('Unexpected error.');
                    }
                }
            })  
    });
    $('#formContract').submit(function(event){
        var tender = $('#contract_tender').val();
        event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'saveContract',
                data: $('form#formContract').serialize(),
                success: function(){
                    alert('Амжилттай');
                    getContracts(tender);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 500) {
                        alert('Internal error: ' + jqXHR.responseText);
                    } else {
                        alert('Unexpected error.');
                    }
                }
            })  
    });
    $('#formPack').submit(function(event){
        var tender = $('#tender_list_id').val();
        event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'savePack',
                data: $('form#formPack').serialize(),
                success: function(){
                    alert('Амжилттай');
                    gettenderpacks(tender);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 500) {
                        alert('Internal error: ' + jqXHR.responseText);
                    } else {
                        alert('Unexpected error.');
                    }
                }
            })  
    });
    $('#formProgress').submit(function(event){
        var tender = $('#progress_tender').val();
        event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'saveProgress',
                data: $('form#formProgress').serialize(),
                success: function(){
                    alert('Амжилттай');
                    gettenderprogresses(tender);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 500) {
                        alert('Internal error: ' + jqXHR.responseText);
                    } else {
                        alert('Unexpected error.');
                    }
                }
            })  
    });
    $('#formComplaint').submit(function(event){
        var tender = $('#complaint_tender').val();
        event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'saveComplaint',
                data: $('form#formComplaint').serialize(),
                success: function(){
                    alert('Амжилттай');
                    gettendercomplaints(tender);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 500) {
                        alert('Internal error: ' + jqXHR.responseText);
                    } else {
                        alert('Unexpected error.');
                    }
                }
            })  
    });
    $('#formDetail').submit(function(event){
        var order = $('#dorder_id').val();
        event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'saveOrderDetail',
                data: $('form#formDetail').serialize(),
                success: function(){
                    alert('Амжилттай');
                    getorderdetails(order);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 500) {
                        alert('Internal error: ' + jqXHR.responseText);
                    } else {
                        alert('Unexpected error.');
                    }
                }
            })  
    });
    $('.btn-block').on('click',function(){
    $('.btn-block').removeClass('ButtonClicked');
    $('.card-list').hide();
    var id = ($('#tender_list_id').val());
    switch ($(this).attr('id')) {
        case 'btn_detail':
            $('#card_detail').show();
            $('#card_main').show();
            $(this).toggleClass('ButtonClicked');
            break;
        case 'btn_1':    
            $('#card_1').show();
            $(this).toggleClass('ButtonClicked');
            break;
        case 'btn_2':
            if(id){
                $('#card_2').show();
            }
           
            $(this).toggleClass('ButtonClicked');
            break;
        case 'btn_3':
            if(id){
                $('#card_3').show();
            }
     
            $(this).toggleClass('ButtonClicked');
            break;
        case 'btn_4':
            if(id){
                $('#card_4').show();
            }
            $(this).toggleClass('ButtonClicked');
            break;
        case 'btn_5':
            if(id){
                $('#card_5').show();
            }
            $(this).toggleClass('ButtonClicked');
            break;
        case 'btn_6':
            if(id){
                $('#card_6').show();
            }
            $(this).toggleClass('ButtonClicked');
            break;
        case 'btn_7':
            if(id){
                $('#card_7').show();
            }
            $(this).toggleClass('ButtonClicked');
            break;
            case 'btn_8':
            $('#card_8').show();
            $(this).toggleClass('ButtonClicked');
            break;
        }

  
});

} );
$('#home-tab').on('click',function(){
    $('#addorderbutton').show();
});

$('.orderinformation').on('click',function(){
    var itag=$(this).attr('tag');
    $('#torder_id').val(itag);
    $('#addorderbutton').hide();
    $('#order_id').val(itag);
    $('#pack_order_id').val(itag)
    $('#progress_order').val(itag);
    $('#complaint_order').val(itag);
    $("#infonews tbody").empty();    
    $("#infotender tbody").empty();   
    $("#infodetails tbody").empty();  
    $("#infopack tbody").empty();   
    $("#tbody3").empty();
    $("#tbody4").empty();
                $('#tender_list_id').val('');
                $('#progress_tender').val('');
                $('#complaint_tender').val('');
                $('#t_tender_id').text('');
                $('#t_tender_no').text('');
                $('#t_tender_selection').text('');
                $('#t_tender_type').text('');
                $('#t_tender_called_at').text('');
                $('#t_tender_budget').text('');
                $('#t_tender_invitation').text('');
                $('#t_tender_invitation_at').text('');
                $('#t_tender_validdate').text('');
                $('#t_tender_open_at').text('');
                $('#t_tender_packcount').text('');
                $('#t_tender_assessment').text('');
                    $('#tender_list_id1').val('');
                    $('#progress_tender1').val('');
                    $('#complaint_tender1').val('');
                    $('#t_tender_id1').text('');
                    $('#t_tender_no1').text('');
                    $('#t_tender_selection1').text('');
                    $('#t_tender_type1').text('');
                    $('#t_tender_called_at1').text('');
                    $('#t_tender_budget1').text('');
                    $('#t_tender_invitation1').text('');
                    $('#t_tender_invitation_at1').text('');
                    $('#t_tender_validdate1').text('');
                    $('#t_tender_open_at1').text('');
                    $('#t_tender_packcount1').text('');
                    $('#t_tender_assessment1').text('');
                
    $( ".menuli1" ).removeClass("disabled disabledTab");
    $.get('getorder/' + itag, function (data) {
                $('#t_order_name').text(data[0].order_name);
                $('#t_order_unit').text(data[0].unit_name);
                $('#t_order_count').text(data[0].order_count);
                $('#t_order_budget_source').text(data[0].order_budget_source_name);
                $('#t_order_selection').text(data[0].tenderselectionabbr);
                $('#t_order_budget').text(data[0].order_budget);
                $('#t_order_thisyear').text(data[0].order_thisyear);
                $('#t_order_date').text(data[0].order_date);
                $('#t_order_comment').text(data[0].order_comment);
                $('#dorder_id').val(data[0].order_id);
                $('#hid').val(data[0].order_id);
                $('#flg').val(1);
                document.getElementById("exampleModalLabel").innerHTML="Захиалгын мэдээллийг засварлах";
            });

            getorderdetails(itag);
        getTenders(itag);
  
      
    
    });
    function getorderdetails(itag){
        $("#infodetails tbody").empty();
        $.get('getorderdetails/'+itag,function(data){
        $.each(data,function(i,qwe){
            var sHtml = "<tr>" +
        "   <td class='m3'>" + qwe.executor_abbr + "</td>" +
         "   <td class='m3'>" + qwe.order_count + "</td>" +
        "   <td class='m3'>" + qwe.order_budget + "</td>" +
        "   <td class='m3'>" + qwe.order_performance + "</td>" +
         "   <td class='m3'> <button class='btn btn-primary btn-xs' data-toggle='modal' onclick='orderdetailEdit("+ qwe.order_detail_id +")' data-target='#detailModal'><i class='fa fa-pen'></i></button> <button class='btn btn-danger btn-xs' onclick='delDetail("+ qwe.order_detail_id +")'><i class='fa fa-trash'></i></button></td>"+
        "</tr>";

        $("#infodetails tbody").append(sHtml);
               
               
         });
        });
    }

    function gettenderinfo(hid){
        $(".tendr").removeClass('highlight');
        $("#"+hid+"").toggleClass('highlight');
        $("#tbody2").empty();
        $("#tbody3").empty();
        $("#tbody4").empty();
        
        $.get('getTender/' + hid, function (data) {
                $('#tender_list_id').val(data[0].tenderid);
                $('#progress_tender').val(data[0].tenderid);
                $('#complaint_tender').val(data[0].tenderid);
                $('#komiss_tender').val(data[0].tenderid);
                $('#contract_tender').val(data[0].tenderid);
                $('#t_tender_id').text(data[0].tenderid);
                $('#t_tender_no').text(data[0].tenderno);
                $('#t_tender_selection').text(data[0].contracttypename);
                $('#t_tender_type').text(data[0].tendertypename);
                $('#t_tender_called_at').text(data[0].tender_call_at);
                $('#t_tender_budget').text(data[0].tender_budget);
                $('#t_tender_invitation').text(data[0].tender_invitationcode);
                $('#t_tender_invitation_at').text(data[0].tender_invitation_at);
                $('#t_tender_validdate').text(data[0].tender_validdate);
                $('#t_tender_open_at').text(data[0].tender_open_at);
                $('#t_tender_packcount').text(data[0].packcount);
                $('#t_tender_assessment').text(data[0].assessment);
                    $('#tender_list_id1').val(data[0].tenderid);
                    $('#progress_tender1').val(data[0].tenderid);
                    $('#complaint_tender1').val(data[0].tenderid);
                    $('#komiss_tender1').val(data[0].tenderid);
                    $('#t_tender_id1').text(data[0].tenderid);
                    $('#t_tender_no1').text(data[0].tenderno);
                    $('#t_tender_selection1').text(data[0].contracttypename);
                    $('#t_tender_type1').text(data[0].tendertypename);
                    $('#t_tender_called_at1').text(data[0].tender_call_at);
                    $('#t_tender_budget1').text(data[0].tender_budget);
                    $('#t_tender_invitation1').text(data[0].tender_invitationcode);
                    $('#t_tender_invitation_at1').text(data[0].tender_invitation_at);
                    $('#t_tender_validdate1').text(data[0].tender_validdate);
                    $('#t_tender_open_at1').text(data[0].tender_open_at);
                    $('#t_tender_packcount1').text(data[0].packcount);
                    $('#t_tender_assessment1').text(data[0].assessment);
            });
           if(hid){

           }
            gettenderpacks(hid);
            gettenderprogresses(hid);
            gettendercomplaints(hid);
            gettenderkomisses(hid);
            getContracts(hid);
    }
    function getTenders(itag){
        $("#infotender tbody").empty();    
        $.get('getTenders/'+itag,function(data){
           if(data[0]){
            gettenderinfo(data[0].tenderid);
           }
           
        $.each(data,function(i,qwe){
        var sHtml = "<tr  onclick=gettenderinfo("+ qwe.tenderid +") tag='"+ qwe.tenderid +"' id='"+ qwe.tenderid +"' class='tendr'>" +
        "   <td> <button class='btn btn-primary btn-xs' data-toggle='modal' onclick='tenderEdit("+ qwe.tenderid +")' data-target='#tenderModal'><i class='fa fa-pen'></i></button></td>"+
        "   <td>" + qwe.contracttypename + "</td>" +
        "   <td><b style='color:#007bff'><u>" + qwe.tenderno + "</u></b></td>" +
        "   <td>" + qwe.tendertypename + "</td>" +
        "   <td>" + qwe.tender_call_at + "</td>"+
        "   <td>" + qwe.tender_budget + "</td>" +
        "   <td>" + qwe.tender_invitationcode + "</td>" +
        "   <td>" + qwe.tender_invitation_at + "</td>" +
        "   <td>" + qwe.tender_open_at + "</td>" +
        "   <td>" + qwe.tender_validdate + "</td>" +
        "   <td>" + qwe.packcount + "</td>"+
        "   <td>" + qwe.assessment + "</td>" +
        "   <td>" + qwe.tendertitle + "</td>" +   
        "</tr>";

        $("#infotender tbody").append(sHtml);    
         });
 
        });
    }
    function getContracts(itag){
        $("#infocontract tbody").empty();    

        $.get('getContracts/'+itag,function(data){
           
        $.each(data,function(i,qwe){
            var sHtml = "<tr  onclick=getcontractinfo("+ qwe.contractid +") tag='"+ qwe.contractid +"' id='"+ qwe.contractid +"'>" +
        "   <td> <button class='btn btn-primary btn-xs' data-toggle='modal' onclick='contractEdit("+ qwe.contractid +")' data-target='#contractModal'><i class='fa fa-pen'></i></button></td>"+
        "   <td>" + qwe.contractno + "</td>" +
        "   <td>" + qwe.contract_date + "</td>" +
        "   <td>" + qwe.contract_duration_days + "</td>"+
        "   <td>" + qwe.currency + "</td>" +
        "   <td>" + qwe.contract_amount + "</td>" +
        "   <td>" + qwe.contract_condition + "</td>" +
        "   <td>" + qwe.contract_payment_date + "</td>" +
        "   <td>" + qwe.supplier_condition + "</td>" +
        "   <td>" + qwe.supplier_days + "</td>" +
        "   <td>" + qwe.supplier_name + "</td>" +
        "   <td>" + qwe.fine_condition + "</td>" +
        "   <td>" + qwe.performance_percent + "</td>" +
        "   <td>" + qwe.contract_condition + "</td>" +
        "   <td>" + qwe.contract_clarification + "</td>" +
        "   <td>" + qwe.contract_conclusion + "</td>" +
        "   <td>" + qwe.contract_reminder + "</td>" +
        "</tr>";

        $("#infocontract tbody").append(sHtml);    
         });
 
        });
    }
    function gettenderpacks(hid){
        $("#tbody2").empty();
        $.get('getpacks/'+hid,function(data){
        $.each(data,function(i,qwe){
            var sHtml = "<tr>" +
        "   <td class='m3'>" + qwe.pack_name + "</td>" +
        "   <td class='m3'>" + qwe.pack_date + "</td>" +
        "   <td class='m3'>" + qwe.pack_budget + "</td>" +
        "   <td class='m3'>" + qwe.pack_contract_at + "</td>" +
        "   <td class='m3'>" + qwe.pack_suspended_at + "</td>" +
        "   <td class='m3'>" + qwe.pack_complaint_at + "</td>" +
        "   <td class='m3'> <button class='btn btn-primary btn-xs' data-toggle='modal' onclick='packEdit("+ qwe.pack_id +")' data-target='#packModal'><i class='fa fa-pen'></i></button></td>"+
        "</tr>";
            
        $("#tbody2").append(sHtml);
               
               
         });
        });
    }
    function gettenderprogresses(hid){
        $("#tbody3").empty();
        $.get('getprogresses/'+hid,function(data){
        $.each(data,function(i,qwe){
            var sHtml = "<tr>" +
        "   <td class='m3'>" + qwe.progress_date + "</td>" +
        "   <td class='m3'>" + qwe.tender_state + "</td>" +
        "   <td class='m3'>" + qwe.progress_comment + "</td>" +
        "   <td class='m3'>" + qwe.progress_employee + "</td>" +
        "   <td class='m3'> <button class='btn btn-primary btn-xs' data-toggle='modal' onclick='progressEdit("+ qwe.progress_id +")' data-target='#progressModal'><i class='fa fa-pen'></i></button></td>"+
        "</tr>";
            
        $("#tbody3").append(sHtml);
               
               
         });
        });
    }
    function getcontractprogresses(hid){
        $("#tbody3").empty();
        $.get('getcontractprogresses/'+hid,function(data){
        $.each(data,function(i,qwe){
            var sHtml = "<tr>" +
        "   <td class='m3'>" + qwe.contract_progress_date + "</td>" +
        "   <td class='m3'>" + qwe.contract_state + "</td>" +
        "   <td class='m3'>" + qwe.contract__comment + "</td>" +
        "   <td class='m3'>" + qwe.contract_employee + "</td>" +
        "   <td class='m3'> <button class='btn btn-primary btn-xs' data-toggle='modal' onclick='progressEdit("+ qwe.progress_id +")' data-target='#progressModal'><i class='fa fa-pen'></i></button></td>"+
        "</tr>";
            
        $("#tbody3").append(sHtml);
               
               
         });
        });
    }
    
    function gettendercomplaints(hid){
        $("#tbody4").empty();
    $.get('getcomplaints/'+hid,function(data){
        $.each(data,function(i,qwe){
            var sHtml = "<tr>" +
        "   <td class='m3'>" + qwe.complaint_date + "</td>" +
        "   <td class='m3'>" + qwe.complaint_comment+ "</td>" +
        "   <td class='m3'> <button class='btn btn-primary btn-xs' data-toggle='modal' onclick='complaintEdit("+ qwe.complaint_id +")' data-target='#complaintModal'><i class='fa fa-pen'></i></button></td>"+
        "</tr>";
            
        $("#tbody4").append(sHtml);
               
               
         });
        });
    }
    function gettenderkomisses(hid){
        $("#tbody5").empty();
    $.get('getkomisses/'+hid,function(data){
        $.each(data,function(i,qwe){
            var sHtml = "<tr>" +
        "   <td class='m3'>" + qwe.komiss_employee + "</td>" +
        "   <td class='m3'>" + qwe.komiss_job + "</td>" +
        "   <td class='m3'>" + qwe.komiss_date + "</td>" +
        "   <td class='m3'>" + qwe.komiss_comment + "</td>" +
        "   <td class='m3'> <button class='btn btn-primary btn-xs' data-toggle='modal' onclick='komissEdit("+ qwe.komiss_id +")' data-target='#komissModal'><i class='fa fa-pen'></i></button></td>"+
        "</tr>";
            
        $("#tbody5").append(sHtml);
               
               
         });
        });
    }
    function orderEdit(hid){
        if(hid){
            $.get('getorder/' + hid, function (data) {
                $('#order_employee').val(data[0].order_employee).trigger('change');
                $('#order_name').val(data[0].order_name);
                $('#order_unit').val(data[0].order_unit);
                $('#order_count').val(data[0].order_count);
                $('#order_budget_source').val(data[0].order_budget_source).trigger('change');
                $('#order_selection').val(data[0].order_selection).trigger('change');
                $('#order_budget').val(data[0].order_budget);
                $('#order_thisyear').val(data[0].order_thisyear);
                $('#order_state').val(data[0].order_state).trigger('change');
                $('#order_date').val(data[0].order_date);
                $('#order_comment').val(data[0].order_comment);
                $('.order_id').val(data[0].order_id);
                document.getElementById("exampleModalLabel").innerHTML="Захиалгын мэдээллийг засварлах";
            });
        } else {
               
                $('#order_employee').val('48');
                $('#order_job').val('');
                $('#order_name').val('');
                $('#order_unit').val('1');
                $('#order_count').val('');
                $('#order_budget').val('');
                $('#order_thisyear').val('');
                $('#order_date').val('');
                $('#order_comment').val('');
                $('#order_id').val('');
                document.getElementById("exampleModalLabel").innerHTML="Шинээр захиалга нэмэх";
        }
    }
    function orderdetailEdit(hid){
        if(hid){
            $.get('getorderdetail/' + hid, function (data) {
                $('#dep_id').val(data[0].dep_id).trigger('change');
                $('#dorder_id').val(data[0].order_id);
                $('#dorder_count_detail').val(data[0].order_count);
                $('#dorder_budget').val(data[0].order_budget);
                $('#dorder_performance').val(data[0].order_performance);
                $('#detail_id').val(data[0].order_detail_id);
                document.getElementById("exampleModalLabel").innerHTML="Захиалгын мэдээллийг засварлах";
            });
        } else {
               
                $('#dep_id').val('40').trigger('change');
                $('#dorder_count_detail').val('');
                $('#dorder_budget').val('');
                $('#dorder_performance').val('');
                $('#detail_id').val('');
                document.getElementById("exampleModalLabel").innerHTML="Шинээр захиалга нэмэх";
        }
    }
    function packEdit(hid){
        if(hid){
            $.get('getpack/' + hid, function (data) {
                $('#pack_name').val(data[0].pack_name);
                $('#pack_date').val(data[0].pack_date);
                $('#pack_budget').val(data[0].pack_budget);
                $('#pack_contract_at').val(data[0].pack_contract_at);
                $('#pack_suspended_at').val(data[0].pack_suspended_at);
                $('#pack_complaint_at').val(data[0].pack_complaint_at);
                $('#pack_id').val(data[0].pack_id);
                document.getElementById("exampleModalLabel").innerHTML="Захиалгын мэдээллийг засварлах";
            });
        } else {
               
                $('#pack_name').val('');
                $('#pack_date').val('');
                $('#pack_budget').val('');
                $('#pack_contract_at').val('');
                $('#pack_suspended_at').val('');
                $('#pack_complaint_at').val('');
                $('#pack_id').val('');
                document.getElementById("exampleModalLabel").innerHTML="Шинээр захиалга нэмэх";
        }
    }
    function komissEdit(hid){
        if(hid){
            $.get('getkomiss/' + hid, function (data) {
                $('#komiss_employee').val(data[0].komiss_employee);
                $('#komiss_job').val(data[0].komiss_job);
                $('#komiss_date').val(data[0].komiss_date);
                $('#komiss_comment').val(data[0].komiss_comment);
                $('#komiss_id').val(data[0].komiss_id);

            });
        } else {
                ('#komiss_employee').val('');
                $('#komiss_job').val('');
                $('#komiss_date').val('');
                $('#komiss_comment').val('');
                $('#komiss_id').val('');

        }
    }
    function contractEdit(hid){
        if(hid){
            $.get('getcontract/' + hid, function (data) {
                $('#contractno').val(data[0].contractno);
                $('#contract_date').val(data[0].contract_date);
                $('#contract_duration_days').val(data[0].contract_duration_days);
                $('#currency').val(data[0].currency);
                $('#contract_amount').val(data[0].contract_amount);
                $('#contract_condition').val(data[0].contract_condition);
                $('#contract_payment_date').val(data[0].contract_payment_date);
                $('#contract_end_date').val(data[0].contract_end_date);
                $('#supplier_condition').val(data[0].supplier_condition);
                $('#supplier_days').val(data[0].supplier_days);
                $('#supplier_name').val(data[0].supplier_name);
                $('#fine_condition').val(data[0].fine_condition);
                $('#contract_clarification').val(data[0].contract_clarification);
                $('#contract_condition').val(data[0].contract_condition);
                $('#contract_conclusion').val(data[0].contract_conclusion);
                $('#contract_reminder').val(data[0].contract_reminder);
                $('#contractid').val(data[0].contractid);

            });
        } else {
                $('#contractno').val('');
                $('#contract_date').val('');
                $('#contract_duration_days').val('');
                $('#currency').val('');
                $('#contract_amount').val('');
                $('#contract_condition').val('');
                $('#contract_payment_date').val('');
                $('#contract_end_date').val('');
                $('#supplier_condition').val('');
                $('#supplier_days').val('');
                $('#supplier_name').val('');
                $('#fine_condition').val('');
                $('#contract_condition').val('');
                $('#contract_clarification').val('');
                $('#contract_conclusion').val('');
                $('#contract_reminder').val('');
                $('#contract_id').val('');
        }
    }
    function progressEdit(hid){
        if(hid){
            $.get('getprogress/' + hid, function (data) {
                $('#progress_date').val(data[0].progress_date);
                $('#progress_state').val(data[0].progress_state);
                $('#progress_comment').val(data[0].progress_comment);
                $('#progress_employee').val(data[0].progress_employee);
                $('#progress_id').val(data[0].progress_id);
              
            });
        } else {
               
                $('#progress_date').val('');
                $('#progress_state').val('1');
                $('#progress_comment').val('');
                $('#progress_employee').val('');
                $('#progress_id').val('');
        }
    }
    function complaintEdit(hid){
        if(hid){
            $.get('getcomplaint/' + hid, function (data) {
                $('#complaint_date').val(data[0].complaint_date);
                $('#complaint_state').val(data[0].complaint_state);
                $('#complaint_comment').val(data[0].complaint_comment);
                $('#complaint_id').val(data[0].complaint_id);
           
            });
        } else {
               
                $('#complaint_date').val('');
                $('#complaint_state').val('');
                $('#complaint_comment').val('');
                $('#complaint_id').val('');

        }
    }
    function tenderEdit(hid){
        if(hid){
            $.get('getTender/' + hid, function (data) {
                $('#tenderno').val(data[0].tenderno);
                $('#tendertypecode').val(data[0].tendertypecode).trigger('change');
                $('#tenderselectioncode').val(data[0].tenderselectioncode).trigger('change');
                $('#tender_call_at').val(data[0].tender_call_at);
                $('#tender_open_at').val(data[0].tender_open_at);
                $('#tender_budget').val(data[0].tender_budget);
                $('#tender_budget_source').val(data[0].tender_budget_source).trigger('change');
                $('#tendertitle').val(data[0].tendertitle);
                $('#tender_invitationcode').val(data[0].tender_invitationcode);
                $('#tender_invitation_at').val(data[0].tender_invitation_at);
                $('#tender_validdate').val(data[0].tender_validdate);
                $('#packcount').val(data[0].packcount);
                $('#assessment').val(data[0].assessment);
                $('#tender_state').val(data[0].tender_state).trigger('change');
                $('#assessment_at').val(data[0].assessment_at);
                $('#tender_comment').val(data[0].tender_comment);
                $('#order_id').val(data[0].order_id);
                $('#tender_id').val(data[0].tenderid);
                document.getElementById("exampleModalLabel").innerHTML="Захиалгын мэдээллийг засварлах";
            });
        } else {
                $('#tenderno').val('');
                $('#tender_call_at').val('');
                $('#tender_open_at').val('');
                $('#tender_budget').val('');
                $('#tendertitle').val('');
                $('#tender_invitationcode').val('');
                $('#tender_invitation_at').val('');
                $('#tender_validdate').val('');
                $('#packcount').val('');
                $('#assessment').val('');
                $('#assessment_at').val('');
                $('#tender_comment').val('');
                $('#order_id').val('');
                $('#tender_id').val(0);
                document.getElementById("exampleModalLabel").innerHTML="Шинээр захиалга нэмэх";
        }
    }

    function depDel(hid,dname){
        if(confirm(dname+' нэртэй захиалгыг устгах уу?'))
        {
           $.get('{{ route("delDep") }}/'+hid , function (data) 
            {
                if(data==1)
                {
                    location.reload();
                }
            }); 
        }

    }
    function delDetail(hid){
        if(confirm('Захиалгын дэлгэрэнгүй мэдээллийг устгах уу?'))
        {
           $.get('{{ route("delDetail") }}/'+hid , function (data) 
            {
                if(data==1)
                {
                    location.reload();
                }
            }); 
        }

    }
    function delOrder(){
        var tag = $('#order_id').val();
        if(confirm('Захиалгыг устгах уу?'))
        {
           $.get('{{ route("delOrder") }}/'+tag , function (data) 
            {
                if(data==1)
                {
                    location.reload();
                }
            }); 
        }

    }
</script>