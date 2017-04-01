<div id="detailModal" class="modal container fade modal-info" tabindex="-1" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">详细信息</h4>
        </div>
        <div class="modal-body">
            123
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <button type="button" class="btn btn-danger verify" value="3">审核拒绝</button>
            <button type="button" class="btn btn-primary verify" value="2">审核通过</button>
        </div>
    </div>
</div>

<script src="/backstage/plugins/jQuery/jquery-2.2.3.min.js"></script>

<script>
    $(document).ready(function() {
        $('.btn-primary').click( function () {
            alert('111');
//                table.row('.selected').remove().draw( false );
        });

        var table = $('#users-table').DataTable();
        $('#users-table tbody').on( 'click', 'tr', function () {

            var id = table.row( this ).data().id;
            $('#detailModal').modal({
                'remote': '/modal/'+ id
            });
            $('.verify').click( function () {
                if(confirm(this.innerHTML+', 请确认')){
                    $.ajax({
                        url:'/update/'+id,
                        type:'POST',
                        dataType:'json',
                        data:{
                            'status':this.value
                        },
                        success: function(){
                            alert('ok');
                        }
                    });
                }
            });
        });
        $("#detailModal").on("hidden.bs.modal", function() {
            $(this).removeData("bs.modal");
        });
    } );
</script>


