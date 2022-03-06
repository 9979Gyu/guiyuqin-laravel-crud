@extends('layouts.app')
@section('content')
<h1>Member Crud</h1>
@if ($msg = Session::get('success'))
    <div class="valid">
        {{ $msg }}
    </div>
@endif
@if ($msg = Session::get('error'))
    <div style="color:white; background-color:red;">
        {{ $msg }}
    </div>
@endif
<table id="memberTable" class="center">
    <thead>
        <th>#</th>
        <th>Member Name</th>
        <th>Age</th>
        <th>Member Role</th>
        <th>Action</th>
    </thead>

</table>
<br>
<div style="float: right;">
    <a href="{{route('member.create')}}"> create member</a>
</div>
@endsection

@section('script')
<script>     
        $( document ).ready(function() {
            fetch_data();
                
            $( "#memberTable" ).on('click', '#target', function() {
                var id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");
                
                var result = confirm("Delete this member?");

                if(result == true){
                    
                    $.ajax(
                    {
                        url: "member/"+id,
                        type: 'DELETE',
                        data: {
                            "id": id,
                            "_token": token,
                        },

                        success: function (){
                            alert("Member with id " + id + " is deleted");
                            location.reload();
                        }
                    });
                }
            });       

            function fetch_data(){
                console.log("test");
                
                $('#memberTable').DataTable({
                    ajax:{
                        url : "{{ route('member.table') }}",
                        type: 'get',
                        dataType : 'json'
                    },
                    searching : false,
                    columns : [{
                        data : "id",
                        name : "id"
                    },
                    {
                        data : "name",
                        name : "name",
                    },
                    {
                        data : "age",
                        name : "age"
                    },
                    {
                        data : "role",
                        name : "role"
                    },
                    {
                        data : "action",
                        name : "action"
                    }]
                });
            }

            
        });
    </script>
@show