<!-- Modal -->
<div class="modal fade modal-data" id="create" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" id="attachRole">
                @csrf
                <input type="hidden" name="_method" value="PUT">

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
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
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
<script src="{{ asset('plugins/selectjs-4.0.7/js/select2.min.js') }}"></script>
<script>

$( document ).ready(function() {

    var status = JSON.parse(localStorage.getItem('status'));

    if (status != null) {
        var templateAlert = `
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            `+ status[0].status +`
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span id="clearStatus" aria-hidden="true">&times;</span>
            </button>
        </div>`
        document.getElementById('alertTarget').innerHTML = templateAlert;
    } else {
    }

    $("#clearStatus").on("click", () => {
        localStorage.removeItem('status')
    })

    var userId = 0;

    $('#attachRole').submit(function(event) {
        event.preventDefault();

        var form = $(this);
        var url = "/userrole/attachRole/" + userId;
        var formData = $('#attachRole').serialize();

        $.ajax({
            type: 'POST',
            url: url,
            data : formData
        }).done(function() {
            var array = [{
                status : 'The Role has been selected'
            }];
            localStorage.setItem('status', JSON.stringify(array));
            window.location.href = "{{ route('userrole.index') }}"
        });
    });

    $('.btn-role').on('click', function(e){
        userId  = $(this).attr('setid');

        var dataId = $(this).data('x');

        $('#create').modal("show");
        var $option = [];
        var $selectedOption = [];
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
            }
        });
    });

});
</script>
@endsection
