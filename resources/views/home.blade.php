@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddMemberModal">
                Add New Member
              </button><br><br>
            <div class="card">
                <div class="card-header">{{ __('Members') }} <a style="float: right" href="{{ url('/books') }}">Books</a></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif




<div class="container">
    <div class="row">
        <table class="table" id="memberDataTable">
            <thead>
                <tr>

                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">AddIssu</th>

                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="memberDataTableBody">


            </tbody>
        </table>
    </div>
</div>




<div class="modal fade" id="AddMemberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <label>Name</label>
                        <input id="name" class="form-control" type="text">
                    </div>
                    <div class="col-md-12">
                        <label>Email</label>
                        <input id="email" class="form-control" type="email">
                    </div>
                    <div class="col-md-12">
                        <label>Phone</label>
                        <input id="phone" class="form-control" type="text">
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="confirm" type="button" class="btn btn-primary">Add member</button>
        </div>
      </div>
    </div>
  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="DeleteMemberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center p-3">
                <h5 class="mt-4">Do you want to Delete ??</h5>
                <span class="d-none" id="DeleteID"></span>
                <span class="d-none" id="imageURL"></span>
                <span class="d-none" id="image2URL"></span>
                <span class="d-none" id="image3URL"></span>
                <span class="d-none" id="image4URL"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">No</button>
                <button  id="DeleteConfirm" type="button" class="btn btn-danger">Yes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="EditMemberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Member Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <span class="d-none" id="MemberID"></span>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <label>Name</label>
                        <input id="e_name" class="form-control" type="text">
                    </div>
                    <div class="col-md-12">
                        <label>Email</label>
                        <input id="e_email" class="form-control" type="email">
                    </div>
                    <div class="col-md-12">
                        <label>Phone</label>
                        <input id="e_phone" class="form-control" type="text">
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="e_confirm_member" type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
DataList()

function DataList() {
    let URL = "/getMemberData";
    axios.get(URL).then(function(response) {
        if (response.status == 200) {
            console.log(response.data)

            $('#memberDataTableBody').empty();
            $.each(response.data, function(i, item) {
                let tableRow = "<tr>" +
                    "<td>" + item['name'] + "</td>" +
                    "<td>" + item['email'] + "</td>" +
                    "<td>" + item['phone'] + "</td>" +
                    "<td>"+"<a href='/issue/"+item['id']+"' >details</a>"+"</td>" +

                    "<td>" +
                    "<div class='dropdown'>" +
                    "<button class='btn btn-sm btn-dark  dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Dropdown button</button>" +
                    "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>" +
                        "<a class='dropdown-item editMember' data-id="+item['id']+" href='#'>Edit Member</a>"+
                    "<a class='dropdown-item deleteItem' data-id=" + item['id'] +
                    " href='#'>Delete</a>" +
                    "</div>" +
                    "</div>" +
                    "</td>" +
                    "</tr>";
                $('#memberDataTableBody').append(tableRow);
            });

            $('.deleteItem').on('click', function() {
                let id = $(this).data('id');
                $('#DeleteID').html(id);
                $('#DeleteMemberModal').modal('show');
            })

            $('.editMember').on('click',function () {
                let idEdit=$(this).data('id');
                $('#MemberID').html(idEdit);
                GetMemberNameEditData(idEdit);
                $('#EditMemberModal').modal('show');
            })




        } else {
            console.log("no")
        }

    }).catch(function(error) {
        console.log(error)
    });


}
// end getdata function


$('#confirm').on('click',function(){
    let name= $('#name').val();
    let email= $('#email').val();
    let phone= $('#phone').val();
    console.log(phone)
    let UploadFormData=new FormData();
        UploadFormData.append('name',name);
        UploadFormData.append('email',email);
        UploadFormData.append('phone',phone);
        let URL="/memberAdd";
        let AxiosHeaderConfig = {
            headers: { 'Content-Type': 'multipart/form-data' },

        };

        axios.post(URL,UploadFormData,AxiosHeaderConfig).then(function(response){
            if(response.status==200){

            $('#name').val("");
            $('#email').val("");
            $('#phone').val("");
            $('#AddMemberModal').modal('hide');
            DataList();

            }  else{
                 $('#AddMemberModal').modal('hide');
            }
        }).catch((erroe)=>{

        })


})

// end add member function

$('#DeleteConfirm').click(function(event) {
    let id = $('#DeleteID').html();
    console.log('khaise')
    let DeleteBtn = $('#DeleteConfirm');
    MemberDelete(id, DeleteBtn);
});
function MemberDelete(deleteID, DeleteBtn) {



let URL = "/memberDelete";
let AxiosConfig = {
    headers: {
        'Content-Type': 'application/json'
    }
};

axios.post(URL, {id: deleteID}, AxiosConfig).then(function(response) {



    if (response.data === 1) {

        $('#DeleteMemberModal').modal('hide');

        DataList();
    } else {
        $('#DeleteMemberModal').modal('hide');

    }

}).catch(function(error) {

    $('#DeleteMemberModal').modal('hide');

});
}

function GetMemberNameEditData(idDetails){

let URL="/GetMemberDetails";
let AxiosConfig = { headers: { 'Content-Type': 'application/json' } };
axios.post(URL,{id:idDetails},AxiosConfig).then(function (response) {

    if (response.status===200) {
        $('#EditMemberModal').modal('show');
        let EditData=response.data;

        $('#e_name').val(EditData[0]['name']);
        $('#e_email').val(EditData[0]['email']);
        $('#e_phone').val(EditData[0]['phone']);
    }
    else {
        $('#EditMemberModal').modal('hide');

    }

}).catch(function (error) {
    $('#EditMemberModal').modal('hide');

});
}


$('#e_confirm_member').on('click',function (){
            let MemberID= $('#MemberID').html();
            let e_name= $('#e_name').val();
            let e_email= $('#e_email').val();
            let e_phone= $('#e_phone').val();




                let UploadFormData=new FormData();
                UploadFormData.append('id',MemberID);
                UploadFormData.append('e_name',e_name);
                UploadFormData.append('e_email',e_email);
                UploadFormData.append('e_phone',e_phone);
                let URL="/MemberDetailUpdate";
                let AxiosHeaderConfig = {
                    headers: { 'Content-Type': 'multipart/form-data' }

                    }

                axios.post(URL,UploadFormData,AxiosHeaderConfig).then(function (response){



                    if(response.status==200){

                        $('#EditMemberModal').modal('hide');
                        DataList();

                    }
                    else{
                        $('#EditMemberModal').modal('hide');

                    }

                }).catch(function (error){

                });

        })
</script>
@endsection
