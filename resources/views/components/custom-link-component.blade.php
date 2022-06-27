<style type="text/css">input{
    margin-bottom: 5px;}
    .remove_node_btn_frm_field {
        width: 72px; height: 72px; margin-top: -38px;
    }
    .add_new_frm_field_btn{
        margin-bottom: 10px;
    }
</style>

<div class="container d-flex justify-content-center vh-100 align-items-center">                                    
    <div class="card">
        <div class="card text-center">
            <div class="card-header">
                Ajout de nouveaux liens
            </div>
            <div class="card-body">
                <div class="container py-1">
                    <div class="row">
                        <div class="col-md-12 p-0">
                            <div class="progress" id="progress" style="display:none;">
                              <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                          </div>
                          <form class="form">
                            @csrf
                            <div class="col-md-12 form_field_outer p-0">
                                <div class="row form_field_outer_row needs-validation">
                                    <p>
                                        <div class="form-group col-md-10">
                                            <div class="input-group has-validation">
                                                <input type="url" class="form-control w_90" name="url_destination[]" id="url_destination_0" placeholder="URL de l'article de destination" />
                                                <div class="invalid-feedback" id="url_destination_0_err"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <div class="input-group has-validation">
                                                <input type="text" class="form-control w_90" name="ancre[]" id="ancre_0" placeholder="Ancre du lien à ajouter" />
                                                <div class="invalid-feedback" id="ancre_0_err"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <div class="input-group has-validation">
                                                <input type="url" class="form-control w_90" name="url_ajout[]" id="url_ajout_0" placeholder="URL du lien à ajouter" />
                                                <div class="invalid-feedback" id="url_ajout_0_err"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2 add_del_btn_outer">
                                            <button class="btn btn-outline-secondary remove_node_btn_frm_field"  disabled>
                                                <i class="fas fa-trash-alt fa-lg"></i>
                                            </button>
                                        </div>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group col-md-12 ">
                                <button type="button" class="btn btn-outline-primary add_new_frm_field_btn d-grid pr-0" >Lien suplémentaire</button>
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-success" type="submit"> Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

<!--js code here-->
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("body").on("click",".add_new_frm_field_btn", function (){
            console.log("clicked");
            var index = $(".form_field_outer").find(".form_field_outer_row").length;
            $(".form_field_outer").append(`
                <div class="row form_field_outer_row needs-validation">
                <p>
                <div class="form-group col-md-10">
                <div class="input-group has-validation">
                <input type="url" class="form-control w_90" name="url_destination[]" id="url_destination_${index}" placeholder="URL de l'article de destination" />
                <div class="invalid-feedback" id="url_destination_${index}_err"></div>
                </div>
                </div>
                <div class="form-group col-md-5">
                <div class="input-group has-validation">
                <input type="text" class="form-control w_90" name="ancre[]" id="ancre_${index}" placeholder="Ancre du lien à ajouter" />
                <div class="invalid-feedback" id="ancre_${index}_err"></div>
                </div>
                </div>
                <div class="form-group col-md-5">
                <div class="input-group has-validation">
                <input type="url" class="form-control w_90" name="url_ajout[]" id="url_ajout_${index}" placeholder="URL du lien à ajouter" />
                <div class="invalid-feedback" id="url_ajout_${index}_err"></div>
                </div>
                </div>
                <div class="form-group col-md-2 add_del_btn_outer">
                <button class="btn btn-outline-danger remove_node_btn_frm_field" disabled>
                <i class="fas fa-trash-alt fa-lg"></i>
                </button>
                </div>
                </p>
                </div>
                `);

            $(".form_field_outer").find(".remove_node_btn_frm_field:not(:first)").prop("disabled", false);
            $(".form_field_outer").find(".remove_node_btn_frm_field").first().prop("disabled", true);
        });
    });

    $(document).ready(function(){
        $("body").on("click", ".remove_node_btn_frm_field", function () {
            $(this).closest(".form_field_outer_row").remove();
            console.log("success");
        });
    });

    $(document).ready(function(){

        var form = $('.form');
        var progress = $('#progress');
        form.on('submit', function(e) {
            e.preventDefault();
            progress.show();
            $.ajax({
                url: 'custom_links',
                type:'POST',
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data) {
                    form.trigger("reset");
                    progress.hide();
                    $('.invalid-feedback').text('');
                    $("#toast-success .toast-body").text(data.message); 
                    var toast_success = new bootstrap.Toast($("#toast-success"))
                    toast_success.show()
                },
                error: function(data){$('.invalid-feedback').text('');
                progress.hide();
                $.each( data.responseJSON.errors, function( key, value ) {
                    $('.invalid-feedback').text(''); 
                    $('#'+key.replace('.','_')+'_err').text(value).show();
                });
                $("#toast-error .toast-body").text('Erreur ! veuillez verifier les champs');
                var toast_error = new bootstrap.Toast($("#toast-error"))
                toast_error.show()
            }
        });

        });

    });
</script>
@endpush
