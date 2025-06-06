@extends("layouts.admin")

@section("styles")
    @include("includes.styles.datatables")
    
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet">
    <link href="{{asset('/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet">
    <link href="https://coderthemes.com/ubold/layouts/default/assets/css/config/default/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://coderthemes.com/ubold/layouts/default/assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
    <link href="https://coderthemes.com/ubold/layouts/default/assets/libs/mohithg-switchery/switchery.min.css" rel="stylesheet" type="text/css" />
    <link href="https://coderthemes.com/ubold/layouts/default/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    <style>
        .type{
            cursor:not-allowed;
        }
    </style>
@endsection

@section("page_title")
    Crete Form
@endsection

@section("title")
   Create Form
@endsection
@section("breadcrumbs")
    <li class="breadcrumb-item active">Form</li>
@endsection

@section("content")

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route("forms.store",['id'=>$id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input required autofocus type="text"  id="name" value="{{$form->name}}" name="name" class="form-control   @error('name') is-invalid @enderror">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3 ">
                        <label for="type">Form Type of User</label>
                        <select class="form-control" id="user-type" name="usertype">
                            @foreach(USER_TYPES as $type)
                            <option @if($form->user_type === $type) selected @endif value="{{ $type }}">{{ ucfirst($type) }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="type">Fields</label>
                        <table class="table datatable   dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>type</th>
                                    <th>Placeholder</th>
                                    <th>Enabled</th>
                                    <th>Required</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="table_body">
                                @foreach ($structsDefault as $ids => $struct)
                                    <tr >
                                            <td>
                                            {{ $struct->label }}   
                                            <input name="defaults_labels[]" type="text" style="visibility: hidden" value="{{$struct->label}}">
                                            </td> 
                                            <input name="defaults_struct[]" type="text" style="visibility: hidden" value="{{$struct->id}}">
                                            <td>
                                                <select   class=" prevent type form-control" id="user-type">
                                                    <option  >Select Type</option>
                                                    @foreach(FORMTYPES as $type=>$v)
                                                        <option @if($struct->type === $v) selected @endif value="{{ $v }}">{{ ucfirst($type) }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="defaults_placeholder[]" class="form-control"   >
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="defaults_enabled[]" checked  class="form-check-input " value="{{$ids}}">
                                                </div>  
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input checked  name="defaults_required[]" type="checkbox" class="form-check-input " value="{{$ids}}">
                                                </div>
                                            </td>
                                    </tr>
                                @endforeach
                                  
                                 
                                    
                                   
                                    
                                    
                            </tbody>
                        </table>
                    </div>
                    


                    <button class="btn btn-primary" id="add_feild">Add Field</button>
                    <button class="btn btn-primary"  type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section("scripts")

    <script src="https://coderthemes.com/ubold/layouts/default/assets/libs/mohithg-switchery/switchery.min.js"></script>
    <script src="https://coderthemes.com/ubold/layouts/default/assets/js/vendor.min.js"></script>
    <script src="https://coderthemes.com/ubold/layouts/default/assets/libs/multiselect/js/jquery.multi-select.js"></script>
    <script src="https://coderthemes.com/ubold/layouts/default/assets/libs/selectize/js/standalone/selectize.min.js"></script>
    <script src="https://coderthemes.com/ubold/layouts/default/assets/libs/select2/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".prevent").attr("disabled",true);
            $("form").on("submit",()=>{
                
                $(".prevent").attr("disabled",false);
            })
        });
        function initSelect(){
            $(".selectize-close-btn").selectize({plugins:["remove_button"],persist:!1,create:!0,render:{item:function(e,a){return'<div>"'+a(e.text)+'"</div>'}},onDelete:function(e){return confirm(1<e.length?"Are you sure you want to remove these "+e.length+" items?":'Are you sure you want to remove "'+e[0]+'"?')}})
        }    
        function changeType(e){
           let n =  $(this).data("index");
           let type =  $(this).val();
           console.log(type)
           if(type == "select"){
               console.log(type)
               $(".select-"+n).css('visibility', 'visible');;
               $(".ph-"+n).hide();
               
            }else{
                $(".ph-"+n).show();
                $(".select-"+n).css('visibility', 'hidden');;
           }
        }
        $("#add_feild").on("click",(e)=>{
            e.preventDefault();
            n = $(".test").length;

            tr =  `<tr class="test">
                    <td>
                        <input type="text" placeholder="Label" name="label[]" class="form-control"   >
                    </td> 
                    <td>
                        <select data-index="${n}" class="form-control formtype"  name="type[]">
                            @foreach(FORMTYPES as $type => $v)
                                <option value="{{ $v }}">{{ ucfirst($type) }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td >
                        <input placeholder="Placeholder Text..."  type="text" name="placeholder[]" class="form-control ph-${n}"   >
                        
                        <input  placeholder="Enter Options" type="text" name="options[]" class=" selectize-close-btn select-${n}" value="">
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input type="checkbox" value="${n}" name="enabled[]" checked  class="form-check-input" id="customSwitch1">
                        </div>  
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input checked value="${n}"   name="required[]" type="checkbox" class="form-check-input" id="customSwitch1">
                        </div>
                    </td>
                    <td>
                        <button data-toggle="tooltip" data-placement="top" data-id="" title="" data-original-title="Delete" class="btn btn-danger ml-1 delete"  type="submit"><i class="fas fa-trash-alt"></i></button>
                    </td> 
            </tr>`;
            $("#table_body").append(tr);
            $(".formtype").on("change",changeType);
            initSelect();
            $(".select-"+n).css('visibility', 'hidden');


        });
    </script>
@endsection
