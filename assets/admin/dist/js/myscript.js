//Hapus data proses
$('#hapusProses').on('show.bs.modal', function(e){
    var data = $(e.relatedTarget).data('id');
    var modal = $(this);

    modal.find(".modal-body input").val(data);
});

//Hapus data reason
$('#hapusReason').on('show.bs.modal', function(e){
    var data = $(e.relatedTarget).data('id');
    var modal = $(this);

    modal.find(".modal-body input").val(data);
});

//Hapus data user
$('#hapusUser').on('show.bs.modal', function(e){
    var data = $(e.relatedTarget).data('id');
    var modal = $(this);

    modal.find(".modal-body input").val(data);
});

//Hapus data transaksi
$('#hapusTransaksi').on('show.bs.modal', function(e){
    var data = $(e.relatedTarget).data('id');
    var modal = $(this);

    modal.find(".modal-body input").val(data);
});

//Memperoleh MO (FBillNo)
$(document).ready(function(){
    $('#proses').change(function(){
        var FItemID= $(this).val();
        $.ajax({
            url : "getMo",
            method : "POST",
            data : {FItemID: FItemID},
            async : true,
            dataType : 'json',
            success: function(data){
                 
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].FBillNo+'>'+data[i].FBillNo+'</option>';
                }
                $('#mo').html(html);

            }
        });
        return false;
    }); 
     
});

//Pilih MO (FBillNo)
$(document).ready(function(){
    $('#mo').change(function(){ 
      var id = $(this).val();
    // alert(id);
      $.ajax({
          url : "getDataMo",
          method : "POST",
          data : {id: id},
          async : true,
          dataType : "json",
          success: function(data){
              $('#batch').val(data.lot);
              $('#planed').val(data.tanggal);
              $('#part').val(data.FNumber);
              $('#qty_planed').val(data.qty);
              $('#capacity').val(data.shiftcapacity);
              $('#machine').val(data.mesin);
          },
          error: function(data){
              console.log('Error', data);
          }
      });
      return false;
  });    
});

//Menghitung theoretic WH
function hasil()
{
    var data1 = $('#qty_qualified').val();
    var data2 = $('#capacity').val();
    var process = $('#proses').val();
    if(process == '135') 
    {
        var result = (data1/data2) * 8;
        result = result.toFixed(2);
        $('#theoretic').val(result);
    }
    else if(process == '2886')
    {
        var result = (data1/data2) * 7;
        result = result.toFixed(2);
        $('#theoretic').val(result);
    }
    else if(process == '136')
    {
        var result = (data1/data2) * 7;
        result = result.toFixed(2);
        $('#theoretic').val(result);
    }       
}

function resultWorking()
{
    var data1 = $('#theoretic').val();
    var data2 = $('#actual').val();
    var result;

    result = data2 - data1;
    // alert(result);
    if(result > 0){
        $.ajax({
            url : "getReason",
            method : "POST",
            // data : {FItemID: FItemID},
            async : true,
            dataType : 'json',
            success: function(data){
                 
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].id+'>'+data[i].deskripsi+'</option>';
                }
                $('#reason').html(html);
            }
        });
    }
    else
    {
        var html = '';
        html += '<option>-- TIDAK ADA REASON --</option>';
        $('#reason').html(html);
    }
}
