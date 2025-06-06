@extends("layouts.admin")


@section('styles')
    @include("includes.styles.datatables")
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <style>
        #eventData .slugInp{
            width: 85%;
            border: 1px solid grey;
            height: calc(1.5rem+ 0.9rem+ 2px);
            padding: 0.45rem 0.9rem;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.2rem;
        }
        #event_link{
            font-weight: 700;
            white-space: nowrap;
        }
    </style>
@endsection
@section('page_title')
Frequently Asked Question(FAQ)  
@endsection

@section('title')
    FAQ
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active" ><a href="{{ route("eventee.faq",['id'=>$id]) }}">FAQ</a></li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title"><i class="fas fa-question-circle"></i>&nbsp;&nbsp;FAQs</h3>
                <div class="float-right"><a href="{{ route('eventee.faq.create',$id) }}" class="btn btn-success">Create FAQ</a></div>
            </div>
            <div class="card-body">
                <table class="table  ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Question</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @if(count($faqs)>0)
                            @foreach ($faqs as $key =>$faq)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $faq->question }}</td>
                                    <td><a href="{{ route('eventee.faq.edit',['id'=>$id,'faq_id'=>$faq->id]) }}" class="btn btn-warning" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                        <button onclick="deleteFaq(this)" data-id="{{ $faq->id }}" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button></td>
                                </tr>
                            @endforeach
                        @else
                                <tr>
                                    <td colspan="3"><center> No Data Available</center></td>
                                </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <span style="float: right">{{ $faqs->links() }}</span>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

    <script>
        function deleteFaq(e){
            var id = e.getAttribute('data-id');
            confirmDelete("Are you sure you want to DELETE FAQ?","Confirm FAQ Delete").then(confirmation=>{
                        if(confirmation){
                            $.ajax({
                                url:"{{ route('eventee.faq.delete') }}",
                                data: {
                                    "id":id,
                                },
                                method:"POST",
                                success: function(response){
                                    if(response.code == 200){
                                        e.closest("tr").remove();
                                    }
                                    else{
                                        alert("Something Went Wrong");
                                    }
                                   
                                }
                            })
                        }
                    });
        }
    </script>

@endsection
