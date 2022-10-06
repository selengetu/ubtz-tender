<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<script>
   $(document).ready( function () {
   
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
     
        "</tr>";
            
        $("#tbody5").append(sHtml);
               
               
         });
        });
    }
   
</script>