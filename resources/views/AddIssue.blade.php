@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddIssueModal">
                Add New Issue
              </button><br><br>
            <div class="card">
                <div class="card-header">{{ __('Add Issue') }} <a style="float: right" href="{{ url('/books') }}">Books</a></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif



            <div class="container">
                <div class="row">
                    <table class="table" id="issueDataTable">
                        <thead>
                            <tr>

                                <th scope="col">id</th>
                                <th scope="col">name</th>


                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="issueDataTableBody">


                        </tbody>
                    </table>
                </div>
            </div>





<div class="modal fade" id="AddIssueModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label>User Name</label>
                        <input id="u_name" class="form-control" type="text">
                    </div>
                    <div class="col-md-12">
                        <label>Book Name</label>
                        <select class="form-control"  name="" id="b_name_slesct">

                        </select>
                    </div>
                    <div class="col-md-12">
                        <label>Issue Date</label>
                        <input id="iss_date" class="form-control" type="date">
                    </div>
                    <div class="col-md-12">
                        <label>Return Date</label>
                        <input id="re_date" class="form-control" type="date">
                    </div>
                    <div class="col-md-12">
                        <label>Status</label>
                        <select name="" id="status" class="form-control">
                            <option value="Issue">Issue</option>
                            <option value="Return">Return</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="Issue_confirm" type="button" class="btn btn-primary">Add Issue</button>
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

DataListt()

function DataListt() {
    let URL = "/getBookData";
    axios.get(URL).then(function(response) {
        if (response.status == 200) {
            console.log(response.data)

            $('#book_name').empty();
            $.each(response.data, function(i, item) {
                let option ="<option>" + item['b_name'] + "</option>"
                $('#b_name_slesct').append(option);
            });

        } else {
            console.log("no")
        }

    }).catch(function(error) {
        console.log(error)
    });


}
UserDetails()
function UserDetails() {
    let id = slug = window.location.href.substring(
      window.location.href.lastIndexOf("/") + 1
    );

    let URL = "/getMemberData/"+id;
    axios.get(URL).then(function(response) {
        if (response.status == 200) {
            console.log(response.data)
            let EditData=response.data;

            $('#u_name').val(EditData['name']);


        } else {
            console.log("no")
        }

    }).catch(function(error) {
        console.log(error)
    });


}
// userdetails end function

DataLenList()
function DataLenList() {
    let URL = "/getLentData";
    axios.get(URL).then(function(response) {
        if (response.status == 200) {
            console.log(response.data)

            $('#issueDataTableBody').empty();
            $.each(response.data, function(i, item) {
                let tableRow = "<tr>" +
                    "<td>" + item['u_name'] + "</td>" +
                    "<td>" + item['b_name'] + "</td>" +
                    "<td>" + item['issue_date'] + "</td>" +
                    "<td>" + item['return_date'] + "</td>" +
                    "<td>" + item['status'] + "</td>" +


                    "<td>" +
                    "<div class='dropdown'>" +
                    "<button class='btn btn-sm btn-dark  dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Dropdown button</button>" +
                    "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>" +
                        "<a class='dropdown-item editBook' data-id="+item['id']+" href='#'>Edit Member</a>"+
                    "<a class='dropdown-item deleteItem' data-id=" + item['id'] +
                    " href='#'>Delete</a>" +
                    "</div>" +
                    "</div>" +
                    "</td>" +
                    "</tr>";
                $('#issueDataTableBody').append(tableRow);
            });

            $('.deleteItem').on('click', function() {
                let id = $(this).data('id');
                $('#DeleteID').html(id);
                $('#DeleteBookModal').modal('show');
            })

            $('.editBook').on('click',function () {
                let idEdit=$(this).data('id');
                $('#BookID').html(idEdit);
                GetBookNameEditData(idEdit);
                $('#EditBookModal').modal('show');
            })




        } else {
            console.log("no")
        }

    }).catch(function(error) {
        console.log(error)
    });


}




$('#Issue_confirm').on('click',function(){
    let u_name= $('#u_name').val();
    let b_name= $('#b_name_slesct').val();
    let issue_date= $('#iss_date').val();
    let return_date= $('#re_date').val();
    let status= $('#status').val();
    console.log(b_name)
    let UploadFormData=new FormData();
        UploadFormData.append('u_name',u_name);
        UploadFormData.append('b_name',b_name);
        UploadFormData.append('issue_date',issue_date);
        UploadFormData.append('return_date',return_date);
        UploadFormData.append('status',status);
        let URL="/issueAdd";
        let AxiosHeaderConfig = {
            headers: { 'Content-Type': 'multipart/form-data' },

        };

        axios.post(URL,UploadFormData,AxiosHeaderConfig).then(function(response){
            if(response.status==200){

            $('#u_name').val("");
            $('#b_name_slesct').val("");
            $('#issue_date').val("");
            $('#return_date').val("");
            $('#status').val("");
            $('#AddIssueModal').modal('hide');
            DataList();

            }  else{
                 $('#AddIssueModal').modal('hide');
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
