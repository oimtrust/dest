<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form method="POST" id="attachRole">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Choose Role to Attach User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="roles">Select Roles</label> <br/>
                        <select class="form-control @error('roles') is-invalid @enderror" id="roles" name="roles[]" multiple style="width: 100%">
                        </select>
                        @error('roles')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-rounded">Attach</button>
                </div>
            </form>
        </div>
    </div>
</div>


@section('scripts')
<script>

$( document ).ready(function() {

    var status = JSON.parse(localStorage.getItem('status'));
    var userId = 0;
    var roleId = 0;

    if (status != null) {
        var templateAlert = `
        <div class="alert alert-`+ status[0].type +` alert-dismissible show fade" role="alert">
            <div class="alert-body">
                <button class="close" id="clearStatus" data-dismiss="alert">
                <span>×</span>
                </button>
                `+ status[0].status +`
            </div>
            </button>
        </div>`
        document.getElementById('alertTarget').innerHTML = templateAlert;
    } else {
    }

    $("#clearStatus").on("click", () => {
        localStorage.removeItem('status')
    })


    $('#attachRole').submit(function(event) {
        event.preventDefault();

        var form = $(this);
        var url = "/userrole/attachRole/" + userId;
        var formData = $('#attachRole').serialize();

        if((userId == 1 && roleId == 1) && document.getElementById("roles").value != 1){
            var array = [{
                status : 'The admin role cannot be deleted',
                type: "danger"
            }];
        } else{
            var array = [{
                status : 'The Role has been selected',
                type: "success"
            }];
        }

        $.ajax({
            type: 'PUT',
            url: url,
            data : formData
        }).done(function() {
            localStorage.removeItem('status');
            localStorage.setItem('status', JSON.stringify(array));
            window.location.href = "{{ route('userrole.index') }}"
        });
    });

    $('.btn-role').on('click', function(e){
        userId  = $(this).attr('setid');

        var dataId = $(this).data('x');
        var $option = []
        var $selectedOption = []

        $('#create').modal("show");
        //setting value select2
        $.ajax({
            type: "get",
            url:  '/ajaxSearchRole',
            success: function (data) {
                $.each(data, function (key,value) {
                    $option.push({
                        id: value.id,
                        text: value.name
                    });
                });
                $("#roles").select2({
                    data: $option
                })
            }
        });

        //set selected value by data user in option select2
        $.ajax({
            type : "get",
            url : "/users/role/"+dataId,
            success: function(data){
                $.each(data, function (key,value) {
                    $selectedOption.push([value.id]);
                });
                $("#roles").val($selectedOption).trigger('change');
                roleId = document.getElementById("roles").value
            }
        });

    });

});
</script>
@endsection
