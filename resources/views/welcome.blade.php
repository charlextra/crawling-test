<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web Evolution Crawler</title>
    <link rel="stylesheet" href={{ asset('css/app.css') }}>

    <!-- font awesome  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />

</head>
<body>
    <style type="text/css">input{
        margin-bottom: 5px;}
        .remove_node_btn_frm_field {
            width: 72px; height: 72px; margin-top: -38px;
        }
        .add_new_frm_field_btn{
            margin-left: -30px;
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
                                <div class="col-md-12 form_field_outer p-0">
                                    <div class="row form_field_outer_row">
                                        <p>
                                            <div class="form-group col-md-10">
                                                <input type="text" class="form-control w_90" name="url_destination[]" id="url_destination_1" placeholder="URL de l'article de destination" />
                                            </div>
                                            <div class="form-group col-md-5">
                                                <input type="text" class="form-control w_90" name="ancre_[]" id="ancre_1" placeholder="Ancre du lien à ajouter" />
                                            </div>
                                            <div class="form-group col-md-5">
                                                <input type="text" class="form-control w_90" name="url_ajout_[]" id="url_ajout_1" placeholder="URL du lien à ajouter" />
                                            </div>
                                            <div class="form-group col-md-2 add_del_btn_outer">
                                                <button class="btn btn-outline-secondary remove_node_btn_frm_field"  disabled>
                                                    <i class="fas fa-trash-alt fa-lg"></i>
                                                </button>
                                            </div>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group col-md-3 ">
                                    <button type="button" class="btn btn-outline-primary add_new_frm_field_btn" ><i class="fas fa-plus add_icon"></i> Lien suplémentaire</button>
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-outline-success" type="button"> Enregistrer</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("body").on("click",".add_new_frm_field_btn", function (){
                console.log("clicked");
                var index = $(".form_field_outer").find(".form_field_outer_row").length + 1;
                $(".form_field_outer").append(`<div class="row form_field_outer_row">
                    <p>
                        <div class="form-group col-md-10">
                            <input type="text" class="form-control w_90" name="url_destination[]" id="url_destination_${index}" placeholder="URL de l'article de destination" />
                            </div>
                        <div class="form-group col-md-5">
                            <input type="text" class="form-control w_90" name="ancre_[]" id="ancre_${index}" placeholder="Ancre du lien à ajouter" />
                            </div>
                        <div class="form-group col-md-5">
                            <input type="text" class="form-control w_90" name="url_ajout_[]" id="url_ajout_${index}" placeholder="URL du lien à ajouter" />
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
    </script>
</body>
</html>
